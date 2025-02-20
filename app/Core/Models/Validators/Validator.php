<?php
namespace App\Core\Models\Validators;

# Nota, ver como incluir las {Clase}Rule

trait Validator {
  public function validate($data, $rules) {
    $errors = [];

    foreach ($rules as $field => $rule) {
      $ruleSet = explode('|', $rule);
      $isString = in_array('string', $ruleSet);

      if (!in_array($field, array_keys($data))) {
        continue;
      }

      foreach ($ruleSet as $ruleItem) {
        // Divide la regla en partes y obtiene el nombre de la regla y el valor opcional
        $ruleParts = explode(':', $ruleItem);
        $ruleName = $ruleParts[0];
        $ruleValue = isset($ruleParts[1]) ? $ruleParts[1] : null;

        // Verifica si existe una clase para la regla de validación
        if (class_exists(ucfirst($ruleName) . 'Rule')) {
          // Ejecuta la regla de validación
          $isValid = call_user_func([$ruleName . 'Rule', 'validate'], $data[$field], $ruleValue, $isString);

          // Si la validación falla, agrega un error al campo correspondiente
          if (!$isValid) {
            $errors[$field][] = ucfirst($field) . ' ' . self::getErrorMessage($ruleName, $ruleValue);
          }
        }
      }
    }

    return $errors;
  }
  private function getErrorMessage($ruleName, $ruleValue) {
    switch ($ruleName) {
      case 'required':
        return 'is required';
      case 'string':
        return 'must be string';
      case 'min':
        return 'must be at least ' . $ruleValue;
      case 'max':
        return 'must be at most ' . $ruleValue;
      case 'email':
        return 'must be a valid email address';
      case 'unique':
        return 'must be unique';
      default:
        return 'is invalid';
    }
  }
}
