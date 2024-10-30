<!-- views/IngresoForm.php -->

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
</head>
<body>
    <h1>Registrar Ingreso</h1>
    <form action="index.php?controller=Ingreso&action=create" method="post">
        <label>Código:</label><input type="text" name="codigo" required><br>
        <label>Nombre:</label><input type="text" name="nombre" required><br>
        <label>Programa:</label><input type="text" name="programa" required><br>
        <label>Sala:</label><input type="text" name="sala" required><br>
        <label>Registrador:</label><input type="text" name="registrador" required><br>
        <button type="submit">Registrar</button>
    </form>
</body>
</html>
