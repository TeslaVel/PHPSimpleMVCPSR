<?php

namespace App\Core\Models\Validators;

class UniqueRule {
  public static function validate($value, $tableName, $columnName) {
    // Aquí deberías realizar la verificación en la base de datos
    // Devuelve true si el valor es único, false si ya existe en la base de datos
    // Por simplicidad, asumimos que siempre es único en esta implementación
    return true;
  }
}