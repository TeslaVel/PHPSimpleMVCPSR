<?php

namespace App\Core\Models\Concerns;

trait Errors {
    public $errors = [];


    public function errors() {
      return $this->errors;
    }

    protected function addError($error) {
      array_push($this->errors, $error);
    }

    public function addErrors($errors) {
      array_walk($errors, function ($err, $index) {
        self::addError($err);
      });
    }
    protected function cleanErrors($item) {
      unset($this->errors);
    }

    public function getErrorMessages()
    {
      $errorValues = array_map(function ($error) {
        return $error[0];
      }, $this->errors);
      return $errorValues;
    }

    public function getErrorsWithKeys()
    {
      $errorsWithKeys = [];
      foreach ($this->errors as $key => $errors) {
        foreach ($errors as $errorMessage) {
          $errorsWithKeys[] = "$key: $errorMessage";
        }
      }
      return $errorsWithKeys;
    }

}