<?php
require_once __DIR__ . '/../models/Ingreso.php';

class IngresosController {
    public function crear() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $ingreso = new Ingreso();

            $datos = [
                ':codigoEstudiante' => trim($_POST['codigo']),
                ':nombreEstudiante' => trim($_POST['nombre']),
                ':idPrograma' => trim($_POST['idPrograma']),
                ':idSala' => trim($_POST['idSala']),
                ':idResponsable' => trim($_POST['idResponsable'])
            ];

            if ($ingreso->registrarIngreso($datos)) {
                echo "Ingreso registrado exitosamente.";
            } else {
                echo "Error al registrar el ingreso. Verifica que los IDs de programa, sala y responsable sean correctos.";
            }
        } else {
            require __DIR__ . '/../views/ingresos/crear.php';
        }
    }

    public function listar() {
        $ingreso = new Ingreso();
        $ingresosDelDia = $ingreso->obtenerIngresosDelDia();

        require __DIR__ . '/../views/ingresos/listar.php';
    }

    public function registrarSalida() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
            $ingreso = new Ingreso();
            if ($ingreso->registrarSalida($_POST['id'])) {
                echo "Salida registrada correctamente.";
            } else {
                echo "Error al registrar la salida.";
            }
        }
        $this->listar();
    }
}
?>
