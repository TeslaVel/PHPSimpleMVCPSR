<?php

namespace App\Core\Models\Concerns;

trait FieldsConcern {
  public function filteredFields($fillableFields, $data)
  {
    if(empty($fillableFields)) return null;
    if(empty($data)) return null;

    $dataArray = $data;
    $allowed = $fillableFields;

    # If data comes as a list, then it is converted to an associative array.
    if(array_is_list($data)) {
      $dataArray = array_combine(array_values($data), array_keys($data));
    }

    # Check for empty "password" key and remove it from $allowed
    if (isset($dataArray['password']) && $dataArray['password'] === '') {
      unset($allowed[array_search('password', $allowed)]);
    }

    # This function is to filter and leave only the allowed fields
    $filteredData = array_filter($dataArray, function ($key) use ($allowed) {
      return in_array($key, $allowed);
    }, ARRAY_FILTER_USE_KEY);

    return $filteredData;
  }

  public function bindToUpdate($fillableFields, $data)
  {
    if(empty($fillableFields)) return null;
    if(empty($data)) return null;

    $fields = array_merge($data, ['updated_at' => time()]);

    $newFilteredData = $this->filteredFields($fillableFields, $fields);

    $columns = [];

    foreach ($newFilteredData as $key => $value) {
      $columns[] = "$key = :$key";
    }

    return [$columns, $newFilteredData];
  }

  public function bindToInsert($fillableFields, $data)
  {
    if(empty($fillableFields)) return null;
    if(empty($data)) return null;

    $fields = array_merge($data, ['created_at' => time(), 'updated_at' => time()]);

    $newFilteredData = $this->filteredFields(array_values($fillableFields), $fields);

    $columns = implode(',', array_keys($newFilteredData));
    $values = ':' . implode(', :', array_keys($newFilteredData));

    return [$columns, $values, $newFilteredData];
  }
}