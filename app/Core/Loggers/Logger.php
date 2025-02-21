<?php
namespace App\Core\Loggers;

use App\Core\Loggers\FileLogger;

class Logger {
    private static $instance;

    public static function getInstance(): FileLogger {
        if (!self::$instance) {
            self::$instance = new FileLogger('../logs/app.log');
        }
        return self::$instance;
    }
}