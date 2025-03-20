<?php
include 'db.php';

// Crud Create = Crea, Delete = Eliminar, $query se encarga de guardar la setencia SQL.
//$result procesa el resultado de $query, obviamente el $conn se le añade para asegurarse con la conexion con la base de datos 
//$conn viene de db.php


if (isset($_POST['create'])) {  
    $nombre = trim($_POST['nombre']);  
    $precio = floatval($_POST['precio']);  
    $cantidad = intval($_POST['cantidad']); 
    if (!empty($nombre) && $precio > 0 && $cantidad > 0) {  
        
        $nombre = pg_escape_string($conn, $nombre);  
        $query = "INSERT INTO productos (nombre, precio, cantidad) VALUES ('$nombre', $precio, $cantidad)";  
        

        if (pg_query($conn, $query)) {  
            header('Location: index.php');  
            exit;  
        } else {  
            echo '<div class="error-message">¡Error en la insercion!' . pg_last_error($conn . '</div>');  
        }  
    } else {  
    echo '<div class="warning-message">⚠️ Por favor, completa todos los campos correctamente. ⚠️</div>';
    }  
}  


if (isset($_GET['delete'])) {
    $id = $_GET['delete'];
    $query = "DELETE FROM productos WHERE id = $id";
    pg_query($conn, $query);
}


$query = "SELECT * FROM productos";
$result = pg_query($conn, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Remates Pipituto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="waterfall-left">
        <div class="drop"></div>
        <div class="drop"></div>
        <div class="drop"></div>
        <div class="drop"></div>
    </div>
    <div class="waterfall-right">
        <div class="drop"></div>
        <div class="drop"></div>
        <div class="drop"></div>
        <div class="drop"></div>
    </div>
    <div class="container">
        <h1>REMATES PIPITUTO</h1>
        
        
        <form method="POST" class="form-create">
            <h2>Agregar Producto</h2>
            <input type="text" name="nombre" placeholder="Nombre">
            <input type="number" name="precio" placeholder="Precio (Bs.)" step="0.01">
            <input type="number" name="cantidad" placeholder="Cantidad">
            <button type="submit" name="create">Agregar</button>
        </form>

        
        <div class="product-list">
            <h2>Productos Disponibles</h2>
            <table>
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre</th>
                        <th>Precio (Bs.)</th>
                        <th>Cantidad</th>
                        <th>Acciones</th>
                   <!-- <th>debug</th>-->
                    </tr>
                </thead>
                <tbody>
                    <?php
                    function assocResultado($result){
                        $filas = [];
                        while (($row = pg_fetch_assoc($result) )){
                            $filas[] = $row;
                        
                        }
                        return $filas;

                    }
                    
                
                    $filas = assocResultado($result);
                    
                    
                    foreach ($filas as $row) { ?>
                        <tr>
                            <td><?php echo $row['id']; ?></td>
                            <td><?php echo $row['nombre']; ?></td>
                            <td><?php echo number_format($row['precio'], 2); ?></td>
                            <td><?php echo $row['cantidad']; ?></td>
                            <td>
                                <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn-edit">Editar</a>
                                <a href="?delete=<?php echo $row['id']; ?>" class="btn-delete" onclick="return confirm('¿Seguro?')">Eliminar</a>
                            </td>
                   <!-- <td><?php/* print_r($row) */?></td>-->
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>


</body>
</html>