<?php
include 'db.php';

$id = $_GET['id'];

if (isset($_POST['update'])) {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $cantidad = $_POST['cantidad'];
    
    $query = "UPDATE productos SET nombre='$nombre', precio=$precio, cantidad=$cantidad WHERE id=$id";
    pg_query($conn, $query);
    header("Location: index.php");
}

// Obtiene los datos del producto en base al id
$query = "SELECT * FROM productos WHERE id=$id";
$result = pg_query($conn, $query);
$product = pg_fetch_assoc($result);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Editar Producto - Remates Pipituto</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Editar Producto</h1>
        <form method="POST" class="form-create">
            <input type="text" name="nombre" value="<?php echo $product['nombre']; ?>" required>
            <input type="number" name="precio" value="<?php echo $product['precio']; ?>" step="0.01" required>
            <input type="number" name="cantidad" value="<?php echo $product['cantidad']; ?>" required>
            <button type="submit" name="update">Actualizar</button>
            <a href="index.php" class="btn-back">Volver</a>
        </form>
    </div>
</body>
</html>