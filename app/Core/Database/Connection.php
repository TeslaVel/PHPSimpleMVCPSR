<?php

namespace App\Core\Database;

use App\Config\Database;

class Connection {
  private static $instance = null;
  private $connection;

  private function __construct() {
    try {
        $this->connection = new \PDO("mysql:host=" . Database::$host . ";dbname=" . Database::$name, Database::$user, Database::$password);
        $this->connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
    } catch (\PDOException $e) {
        echo "Error de conexión: " . $e->getMessage();
        exit;
    }
  }

  public static function getInstance() {
    if (self::$instance === null) {
        self::$instance = new Connection();
    }
    return self::$instance->getConnection();
  }

  public function getConnection() {
      return $this->connection;
  }
}