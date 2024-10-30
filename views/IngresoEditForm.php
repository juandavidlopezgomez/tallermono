<!-- views/IngresoEditForm.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Ingreso</title>
</head>
<body>
    <h1>Editar Ingreso</h1>
    <form action="index.php?controller=Ingreso&action=edit&id=<?= $ingreso['id'] ?>" method="post">
        <label>Código:</label><input type="text" name="codigo" value="<?= $ingreso['codigo'] ?>" required><br>
        <label>Nombre:</label><input type="text" name="nombre" value="<?= $ingreso['nombre'] ?>" required><br>
        <button type="submit">Guardar Cambios</button>
    </form>
</body>
</html>
