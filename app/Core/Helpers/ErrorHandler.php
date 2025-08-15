<?php

namespace App\Core\Helpers;

class ErrorHandler
{
    public static function register()
    {
        set_exception_handler([self::class, 'handleException']);
        set_error_handler([self::class, 'handleError']);
    }

    public static function handleException($exception)
    {
        // Puedes registrar el error en un log si quieres
        error_log($exception);

        // Mostrar una página de error bonita
        http_response_code(500);
        self::renderFriendlyError($exception);
        exit;
    }

    public static function handleError($errno, $errstr, $errfile, $errline)
    {
        throw new \ErrorException($errstr, 0, $errno, $errfile, $errline);
    }

    private static function renderFriendlyError($exception)
    {
        ?>
        <!DOCTYPE html>
        <html lang="es">
        <head>
            <meta charset="UTF-8">
            <title>¡Ups! Ocurrió un error</title>
            <style>
                body { font-family: Arial, sans-serif; background: #f8f9fa; color: #333; }
                .error-container {
                    max-width: 500px;
                    margin: 80px auto;
                    background: #fff;
                    border-radius: 8px;
                    box-shadow: 0 2px 8px rgba(0,0,0,0.1);
                    padding: 40px 30px;
                    text-align: center;
                }
                h1 { color: #e74c3c; }
                .details { margin-top: 20px; color: #888; font-size: 0.95em; }
            </style>
        </head>
        <body>
            <div class="error-container">
                <h1>¡Ups! Algo salió mal</h1>
                <p>Ha ocurrido un error inesperado.<br>Por favor, intenta más tarde.</p>
                <div class="details"><?= htmlspecialchars($exception) ?></div>
            </div>
        </body>
        </html>
        <?php
    }
}