<?php
namespace models;

use mysqli;

// Incluir el archivo de configuración de la base de datos
require_once __DIR__ . '/../basededatos/config.php';

class Ingreso {
    public static function getIngresosHoy() {
        $conn = getDBConnection();
        // Cambia 'fechaIngreso' si el nombre de la columna es diferente en la tabla `ingresos`
        $result = $conn->query("SELECT * FROM ingresos WHERE DATE(fechaIngreso) = CURDATE()");
        
        // Verificar si la consulta tuvo éxito
        if (!$result) {
            die("Error en la consulta: " . $conn->error);
        }
        
        $ingresos = $result->fetch_all(MYSQLI_ASSOC);
        $conn->close();
        return $ingresos;
    }

    public static function registrarIngreso($codigo, $nombre, $programa, $sala, $responsable) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, idSala, idResponsable, fechaIngreso, horaIngreso) VALUES (?, ?, ?, ?, ?, CURDATE(), CURTIME())");
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt->bind_param("ssiii", $codigo, $nombre, $programa, $sala, $responsable);
        $stmt->execute();
        
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }

    public static function actualizarIngreso($id, $codigo, $nombre) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("UPDATE ingresos SET codigoEstudiante = ?, nombreEstudiante = ?, updated_at = NOW() WHERE id = ?");
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt->bind_param("ssi", $codigo, $nombre, $id);
        $stmt->execute();
        
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }

        $stmt->close();
        $conn->close();
    }

    public static function getIngresoById($id) {
        $conn = getDBConnection();
        $stmt = $conn->prepare("SELECT * FROM ingresos WHERE id = ?");
        
        if (!$stmt) {
            die("Error en la preparación de la consulta: " . $conn->error);
        }
        
        $stmt->bind_param("i", $id);
        $stmt->execute();
        
        if ($stmt->error) {
            die("Error en la ejecución de la consulta: " . $stmt->error);
        }
        
        $result = $stmt->get_result();
        $ingreso = $result->fetch_assoc();
        
        $stmt->close();
        $conn->close();
        return $ingreso;
    }
}
