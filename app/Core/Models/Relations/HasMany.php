<?php

namespace App\Core\Models\Relations;

trait HasMany {
  public function hasMany($relatedModel, $foreignKey, $pk) {
    return (new $relatedModel())->findBy($foreignKey, $this->$pk);
  }
}
