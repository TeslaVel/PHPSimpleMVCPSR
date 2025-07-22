<?php

// require_once "concerns/ini.php";
// require_once "relation/ini.php";
// require_once "validators/ini.php";
// require_once "models/autoload.php";


namespace App\Core\Models;

use App\Core\Database\Connection;

class BaseModel {
  use Validators\Validator;
  use Concerns\FieldsConcern;
  use Concerns\Errors;
  use Concerns\Collection;
  use Relations\BelongsTo;
  use Relations\HasMany;
  use Relations\HasOne;

  private $fillables;
  private $tableName;
  protected $object;
  protected $db;

  public function __construct() {
    $this->tableName = strtolower(get_class($this)::$name);
    $this->fillables = get_class($this)::$fillableFields;

    $this->db = Connection::getInstance();
  }

  public function __get($property) {
    if (array_key_exists($property, $this->object)) {
      return $this->object[$property];
    }
    return null;
  }

  private function execValidations($data, $rules = null) {
    $validations = $rules ? $rules : get_class($this)::$validations;

    if (isset($validations)) {
      $this->addErrors($this->validate($data, $validations));
    }
  }

  public function fails() {
    return count($this->errors) > 0;
  }

  public function save($data, $rules = null) {
    $tableName = $this->tableName;
    list($columns, $values, $filteredData) = $this->bindToInsert($this->fillables, $data);
    $this->execValidations($filteredData, $rules);
    $sql = "INSERT INTO $tableName ($columns) VALUES ($values)";

    $stmt = $this->db->prepare($sql);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    try {
      $stmt->execute();
      $id = $this->db->lastInsertId();
      $this->find($id);
      return $this;
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function find($id) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $id, \PDO::PARAM_INT);
    try {
      $stmt->execute();
      $this->object = $stmt->fetch(\PDO::FETCH_ASSOC);
      return $this;
      // return new (get_class($this))($data);
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function update($data, $rules = null) {
    $tableName = $this->tableName;
    list($preparedFields, $filteredData) = $this->bindToUpdate($this->fillables, $data);
    $this->execValidations($filteredData, $rules);

    $sql = "UPDATE $tableName SET " . implode(', ', $preparedFields) . " WHERE id = :id";

    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

    foreach ($filteredData as $key => $value) {
      $stmt->bindValue(':' . $key, $value);
    }

    try {
      $stmt->execute();
      $this->find($this->id);
      return $this;
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function delete() {
    $tableName = $this->tableName;
    $sql = "DELETE FROM $tableName WHERE id = :id";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':id', $this->id, \PDO::PARAM_INT);

    try {
      $stmt->execute();
      return $stmt->rowCount();
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function findAll() {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName";

    $stmt = $this->db->prepare($sql);
    try {
      $stmt->execute();
      $this->collect(
        $stmt->fetchAll(\PDO::FETCH_ASSOC)
      );
      return $this;
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function findBy($field, $value) {
    $tableName = $this->tableName;
    $sql = "SELECT * FROM $tableName WHERE $field = :value";
    $stmt = $this->db->prepare($sql);
    $stmt->bindValue(':value', $value);

    try {
      $stmt->execute();
      $this->collect(
        $stmt->fetchAll(\PDO::FETCH_ASSOC)
      );
      return $this;
    } catch(PDOException $e) {
      throw new \Exception("Error de conexión: " . $e);
    }
  }

  public function count() {
    return $this->countCollection();
  }
  public function first() {
    return $this->firstCollection();
  }

  public function last() {
    return $this->lastCollection();
  }
}
