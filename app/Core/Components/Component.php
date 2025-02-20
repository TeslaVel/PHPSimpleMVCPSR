<?php
use App\Components;

class Component {
    public static function render($componentName = null, ...$args) {

        if ($componentName == null ) return '';
        // Construye el nombre completo del component con su namespace
        $className = "App\\Components\\" . ucfirst($componentName);

        // Verifica si existe la clase
        if (!class_exists($className)) {
            throw new \Exception("Component not found: {$componentName}");
        }

        // Obtiene el método render del componente
        $renderMethod = [$className, 'render'];
        // Verifica si el método render existe
        if (!is_callable($renderMethod)) {
            throw new \Exception("Render method not found in component: {$componentName}");
        }

        // Llama al método render y le pasa los argumentos
        return call_user_func_array($renderMethod, ...$args);
    }
}