<?php
namespace App\Helpers;

class ValidatorHelper
{
    public static function validate($data, $rules)
    {
        $errors = [];

        foreach ($rules as $field => $rule) {
            $ruleSet = explode('|', $rule);

            foreach ($ruleSet as $ruleItem) {
                $ruleParts = explode(':', $ruleItem);
                $ruleName = $ruleParts[0];
                $ruleValue = $ruleParts[1] ?? null;

                // Validaciones básicas
                if ($ruleName === 'required' && empty($data[$field])) {
                    $errors[$field][] = "El campo $field es obligatorio.";
                }
                if ($ruleName === 'email' && !filter_var($data[$field], FILTER_VALIDATE_EMAIL)) {
                    $errors[$field][] = "El campo $field debe ser un email válido.";
                }
                if ($ruleName === 'min' && strlen($data[$field]) < $ruleValue) {
                    $errors[$field][] = "El campo $field debe tener al menos $ruleValue caracteres.";
                }
                // Puedes agregar más reglas aquí...
            }
        }

        return $errors;
    }
}