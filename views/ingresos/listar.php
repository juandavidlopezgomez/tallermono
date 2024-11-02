<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Ingresos</title>
</head>
<body>
    <h2>Listado de Ingresos del Día</h2>
    <?php if (!empty($ingresosDelDia)): ?>
        <table border="1">
            <tr>
                <th>Código Estudiante</th>
                <th>Nombre Estudiante</th>
                <th>Programa</th>
                <th>Sala</th>
                <th>Responsable</th>
                <th>Hora de Entrada</th>
            </tr>
            <?php foreach ($ingresosDelDia as $ingreso): ?>
                <tr>
                    <td><?php echo htmlspecialchars($ingreso['codigoEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombreEstudiante']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_programa']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_sala']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['nombre_responsable']); ?></td>
                    <td><?php echo htmlspecialchars($ingreso['fechaIngreso']); ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?php else: ?>
        <p>No hay ingresos registrados para el día de hoy.</p>
    <?php endif; ?>

    <br>
    <a href="?controller=ingresos&action=crear">Registrar Nuevo Ingreso</a>
</body>
</html>