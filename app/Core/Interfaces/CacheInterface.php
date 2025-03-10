<?php
namespace App\Core\Interfaces;

interface CacheInterface {
    public function get($key, $default = null);
    public function set($key, $value, $ttl = null);
    public function delete($key);
    public function clear();
    public function has($key);
}