<?php

namespace App\Core\Models\Concerns;

trait Collection {

  protected $collection = [];

  public function add($item) {
    $this->collection[] = $item;
  }

  public function countCollection() {
    return count($this->collection);
  }

  public function remove($item) {
    unset($this->collection[$item]);
  }

  public function removeAll($item) {
    unset($this->collection);
  }

  public function get() {
    return $this->collection;
  }

  public function firstCollection($number = 1) {
    if ($number > 1) {
      return array_slice($this->collection, 0, $number);
    }
    return $this->collection[0];
  }

  public function lastCollection($number = 1) {
    if ($number > 1) {
      return array_slice($this->collection, -1 * $number, $number);
    }

    return end($this->collection);
  }

  public function all() {
    return $this->collection;
  }

  public function collect($array) {
    array_walk($array, function ($arr, $index) {
      $className = get_called_class();
      $obj = $index === 0 ? $this : new $className();
      $obj->object = $arr;
      self::add($obj);
    });

    return $this;
  }
}