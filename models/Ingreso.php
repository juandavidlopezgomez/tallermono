<?php
require_once __DIR__ . '/../config/conexion.php';

class Ingreso {
    private $db;

    public function __construct() {
        $conexion = new Conexion();
        $this->db = $conexion->getConnection();
    }

    public function registrarIngreso($datos) {
        if (!$this->validarClavesForaneas($datos[':idPrograma'], $datos[':idSala'], $datos[':idResponsable'])) {
            echo "Error: Una de las claves foráneas no es válida.<br>";
            echo "Verifica los siguientes detalles:<br>";
            echo "ID Programa: {$datos[':idPrograma']}<br>";
            echo "ID Sala: {$datos[':idSala']}<br>";
            echo "ID Responsable: {$datos[':idResponsable']}<br>";
            return false;
        }

        $sql = "INSERT INTO ingresos (codigoEstudiante, nombreEstudiante, idPrograma, idSala, idResponsable, fechaIngreso)
                VALUES (:codigoEstudiante, :nombreEstudiante, :idPrograma, :idSala, :idResponsable, NOW())";
        $stmt = $this->db->prepare($sql);
        return $stmt->execute($datos);
    }

    private function validarClavesForaneas($idPrograma, $idSala, $idResponsable) {
        $validPrograma = $this->existeEnTabla('programas', 'id', $idPrograma);
        $validSala = $this->existeEnTabla('salas', 'id', $idSala);
        $validResponsable = $this->existeEnTabla('responsables', 'id', $idResponsable);

        if (!$validPrograma) {
            echo "Error: El ID Programa {$idPrograma} no existe en la tabla programas.<br>";
        }
        if (!$validSala) {
            echo "Error: El ID Sala {$idSala} no existe en la tabla salas.<br>";
        }
        if (!$validResponsable) {
            echo "Error: El ID Responsable {$idResponsable} no existe en la tabla responsables.<br>";
        }

        return $validPrograma && $validSala && $validResponsable;
    }

    private function existeEnTabla($tabla, $columna, $valor) {
        $sql = "SELECT COUNT(*) FROM $tabla WHERE $columna = :valor";
        $stmt = $this->db->prepare($sql);
        $stmt->execute([':valor' => $valor]);
        return $stmt->fetchColumn() > 0;
    }

   
    public function obtenerIngresosDelDia() {
        $sql = "SELECT i.*, 
                p.nombre as nombre_programa,
                s.nombre as nombre_sala,
                r.nombre as nombre_responsable
                FROM ingresos i
                LEFT JOIN programas p ON i.idPrograma = p.id
                LEFT JOIN salas s ON i.idSala = s.id
                LEFT JOIN responsables r ON i.idResponsable = r.id
                WHERE DATE(i.fechaIngreso) = CURDATE() 
                ORDER BY i.fechaIngreso DESC";
        
        $stmt = $this->db->prepare($sql);
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>