<?php
namespace App\Core\Interfaces;

interface LoggerInterface {
    public function log(string $message, string $level = 'info'): void;
    public function info(string $message): void;
    public function error(string $message): void;
    public function debug(string $message): void;
}