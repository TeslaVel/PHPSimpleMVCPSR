<?php
namespace App\Core\Loggers;

use FileLogger;

class ActionLogger {
    private static $instance;

    public static function getInstance(): FileLogger {
        if (!self::$instance) {
            self::$instance = new FileLogger('../logs/app.log');
        }
        return self::$instance;
    }
}