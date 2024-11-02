
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registrar Ingreso</title>
</head>
<body>
    <h2>Registrar Ingreso a la Sala</h2>
    <?php
     
        $db = new Conexion();
        $conn = $db->getConnection();
        
        $programas = $conn->query("SELECT id, nombre FROM programas")->fetchAll();
        $salas = $conn->query("SELECT id, nombre FROM salas")->fetchAll();
        $responsables = $conn->query("SELECT id, nombre FROM responsables")->fetchAll();
    ?>
    
    <form method="POST" action="?controller=ingresos&action=crear">
        <label>Código Estudiante: <input type="text" name="codigo" required></label><br>
        <label>Nombre Estudiante: <input type="text" name="nombre" required></label><br>
        
        <label>Programa: 
            <select name="idPrograma" required>
                <?php foreach($programas as $programa): ?>
                    <option value="<?= $programa['id'] ?>"><?= $programa['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        
        <label>Sala: 
            <select name="idSala" required>
                <?php foreach($salas as $sala): ?>
                    <option value="<?= $sala['id'] ?>"><?= $sala['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        
        <label>Responsable: 
            <select name="idResponsable" required>
                <?php foreach($responsables as $responsable): ?>
                    <option value="<?= $responsable['id'] ?>"><?= $responsable['nombre'] ?></option>
                <?php endforeach; ?>
            </select>
        </label><br>
        
        <button type="submit">Registrar</button>
    </form>
    
    <a href="?controller=ingresos&action=listar">Ver Ingresos del Día</a>
</body>
</html>