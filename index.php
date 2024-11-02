<?php
// index.php

// Incluir la configuración de la base de datos
require_once __DIR__ . '/basededatos/config.php';



// Autocarga de clases
spl_autoload_register(function ($class) {
    $classPath = __DIR__ . '/' . str_replace('\\', '/', $class) . '.php';
    if (file_exists($classPath)) {
        require_once $classPath;
    }
});

// Controladores y acciones por defecto
$controllerName = $_GET['controller'] ?? 'Ingreso';
$action = $_GET['action'] ?? 'index';

// Construcción del nombre del controlador y verificación de su existencia
$controllerClass = 'controllers\\' . ucfirst($controllerName) . 'Controller';
if (class_exists($controllerClass)) {
    $controller = new $controllerClass();
    if (method_exists($controller, $action)) {
        $controller->$action();
    } else {
        echo "Acción '$action' no encontrada en el controlador '$controllerName'.";
    }
} else {
    echo "Controlador '$controllerName' no encontrado.";
}
