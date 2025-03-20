<?php

/* Si tienes una base de datos, usuario, y contraseña diferente CAMBIAR sino no te va agarrar*/
$host = "localhost";
$port = "5432";
$dbname = "remates_pipituto";
$user = "postgres";
$password = "admin";

$conn = pg_connect("host=$host port=$port dbname=$dbname user=$user password=$password");

if (!$conn) {
    die("Error de conexión: " . pg_last_error());
}


/*
Nota importante en php.ini descomente estos 2 (Quite los ;) y tambien como recordatorio ponga la contraseña, nombre de usuario en postgre, y nombre de la base de datos, en esa base de datos se almacenara la tabla productos
;extension=pgsql
;extension=pdo_pgsql

*/ 
?>

