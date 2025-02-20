<?php
namespace App\Core\Loggers;

use App\Core\Interfaces\LoggerInterface;

class FileLogger implements LoggerInterface {
    private $logFile;

    public function __construct(string $logFile) {
        $this->logFile = $logFile;
    }

    public function log(string $message, string $level = 'info'): void {
        $timestamp = date('Y-m-d H:i:s');
        $entry = "[$timestamp] [$level] $message\n";
        file_put_contents($this->logFile, $entry, FILE_APPEND);
    }

    public function info(string $message): void {
        $this->log($message, 'info');
    }

    public function error(string $message): void {
        $this->log($message, 'error');
    }

    public function debug(string $message): void {
        $this->log($message, 'debug');
    }
}