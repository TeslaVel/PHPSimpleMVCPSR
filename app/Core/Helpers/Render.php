<?php

namespace App\Core\Helpers;

use App\Core\Helpers\URL;
use App\Core\Helpers\Auth;
use App\Core\Helpers\Flashify;

class Render {
  public static function view($path, $params = []) {
    extract($params);

    // Construye la ruta absoluta de la vista
    $viewPath = self::getViewPath($path);
    $layoutPath = self::getViewPath('layout');

    // Verifica si la vista existe antes de incluirla
    if (!file_exists($viewPath)) {
        throw new \Exception("View not found: $viewPath");
    }

    if (!file_exists($viewPath)) {
      throw new \Exception("Layout not found: $layoutPath");
    }

    // Incluye los helpers globales en el contexto de la vista
    extract([
      'url_helper' => new URL,
      'auth_helper' => new Auth,
      'flashify_helper' => new Flashify,
    ]);

    require_once __DIR__ . '/../Components/Component.php';
    // Incluye la vista principal
    ob_start();
    require_once $viewPath;
    $content = ob_get_clean();
    require_once $layoutPath;
  }

  private static function getViewPath(string $path): string {
      // Define la carpeta base de las vistas
      $basePath = __DIR__ . '/../../views/';

      // Construye la ruta completa
      return $basePath . str_replace('.', '/', $path) . '.php';
  }
}