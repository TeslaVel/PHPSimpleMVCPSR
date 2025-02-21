<?php
namespace App\Core\Cache;

use App\Core\Interfaces\CacheInterface;

class FileCache implements CacheInterface {
    private $cacheDir;

    public function __construct($cacheDir) {
        $this->cacheDir = $cacheDir;
    }

    public function get($key, $default = null) {
        $filePath = $this->cacheDir . '/' . md5($key) . '.cache';
        if (file_exists($filePath)) {
            return unserialize(file_get_contents($filePath));
        }
        return $default;
    }

    public function set($key, $value, $ttl = null) {
        $filePath = $this->cacheDir . '/' . md5($key) . '.cache';
        file_put_contents($filePath, serialize($value));
    }

    public function delete($key) {
        $filePath = $this->cacheDir . '/' . md5($key) . '.cache';
        if (file_exists($filePath)) {
            unlink($filePath);
        }
    }

    public function clear() {
        foreach (glob($this->cacheDir . '/*.cache') as $file) {
            unlink($file);
        }
    }

    public function has($key) {
        $filePath = $this->cacheDir . '/' . md5($key) . '.cache';
        return file_exists($filePath);
    }
}