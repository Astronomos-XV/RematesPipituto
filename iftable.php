<?php
include 'db.php';

if (!$conn) {
    die("Error al conectar a la base de datos: " . pg_last_error());
}


$query = "
    CREATE TABLE IF NOT EXISTS productos (
        id SERIAL PRIMARY KEY,
        nombre VARCHAR(100) NOT NULL,
        precio DECIMAL(10,2) NOT NULL,
        cantidad INTEGER NOT NULL
    );
";



?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>

<?php

$result = pg_query($conn, $query);  

if (!$result) {
    die("Error al crear la tabla: " . pg_last_error($conn));
} else {
    $mensaje = '<div class="warning-message">⚠️Tabla creada, ya puede crear, editar, eliminar y ver con tranquilidad ⚠️</div>';
}
?>


<div class="centered-container">  
    <div class="warning-message"><?php echo $mensaje; ?></div>  
    <button class="btn-app" onclick="window.location.href='index.php';">ABRIR APP</button>  
</div>  
</body>
</html>

