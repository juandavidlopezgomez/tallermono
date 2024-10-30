<!-- views/IngresoView.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Ingresos</title>
</head>
<body>
    <h1>Registro de Ingresos</h1>
    <a href="index.php?controller=Ingreso&action=create">Registrar Ingreso</a>

    <table border="1">
        <tr>
            <th>Código</th>
            <th>Nombre</th>
            <th>Programa</th>
            <th>Sala</th>
            <th>Registrador</th>
            <th>Fecha Ingreso</th>
            <th>Acciones</th>
        </tr>
        <?php foreach ($ingresos as $ingreso): ?>
            <tr>
                <td><?= $ingreso['codigo'] ?></td>
                <td><?= $ingreso['nombre'] ?></td>
                <td><?= $ingreso['programa'] ?></td>
                <td><?= $ingreso['sala'] ?></td>
                <td><?= $ingreso['registrador'] ?></td>
                <td><?= $ingreso['fecha_ingreso'] ?></td>
                <td>
                    <a href="index.php?controller=Ingreso&action=edit&id=<?= $ingreso['id'] ?>">Editar</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </table>
</body>
</html>
