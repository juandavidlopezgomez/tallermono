<?php
// controllers/IngresoController.php

namespace controllers;

use models\Ingreso;
use models\Horario;

class IngresoController {
    public function index() {
        // Mostrar ingresos del día actual
        $ingresos = Ingreso::getIngresosHoy();
        require_once __DIR__ . '/../views/IngresoView.php';
    }

    public function create() {
        // Registrar nuevo ingreso
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];
            $programa = $_POST['programa'];
            $sala = $_POST['sala'];
            $registrador = $_POST['registrador'];
            
            Ingreso::registrarIngreso($codigo, $nombre, $programa, $sala, $registrador);
            header('Location: index.php?controller=Ingreso&action=index');
        } else {
            require_once __DIR__ . '/../views/IngresoForm.php';
        }
    }

    public function edit($id) {
        // Editar ingreso
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $codigo = $_POST['codigo'];
            $nombre = $_POST['nombre'];

            Ingreso::actualizarIngreso($id, $codigo, $nombre);
            header('Location: index.php?controller=Ingreso&action=index');
        } else {
            $ingreso = Ingreso::getIngresoById($id);
            require_once __DIR__ . '/../views/IngresoEditForm.php';
        }
    }
}
