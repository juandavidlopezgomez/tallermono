<?php
require_once __DIR__ . '/../controllers/IngresosController.php';


ini_set('display_errors', 1);
error_reporting(E_ALL);

// Enrutador simple
$controller = $_GET['controller'] ?? 'ingresos';
$action = $_GET['action'] ?? 'listar';

if ($controller === 'ingresos') {
    $controllerObj = new IngresosController();
    if (method_exists($controllerObj, $action)) {
   
        $controllerObj->$action();
    } else {
        echo "Acción no encontrada: " . htmlspecialchars($action);
    }
} else {
    echo "Controlador no encontrado: " . htmlspecialchars($controller);
}
?>
