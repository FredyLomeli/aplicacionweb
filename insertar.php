<?php
$servidor = "localhost";
$usuario = "root";
$contrasena = "";
$basedatos = "mipagina";

$conexion = new mysqli($servidor, $usuario, $contrasena, $basedatos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = isset($_POST["nombre"]) ? trim($_POST["nombre"]) : "";
    $giro = isset($_POST["giro"]) ? trim($_POST["giro"]) : "";
    $razon_social = isset($_POST["razon_social"]) ? trim($_POST["razon_social"]) : "";
    $domicilio = isset($_POST["domicilio"]) ? trim($_POST["domicilio"]) : "";
    
    if (empty($nombre) || empty($giro) || empty($razon_social) || empty($domicilio)) {
        echo "Error: Todos los campos deben ser llenados";
    } else {
        $nombre = $conexion->real_escape_string($nombre);
        $giro = $conexion->real_escape_string($giro);
        $razon_social = $conexion->real_escape_string($razon_social);
        $domicilio = $conexion->real_escape_string($domicilio);
        
        $sql = "INSERT INTO empresas (nombre, giro, razon_social, domicilio) 
                VALUES ('$nombre', '$giro', '$razon_social', '$domicilio')";
        
        if ($conexion->query($sql) === TRUE) {
            echo "Registro correcto";
        } else {
            echo "Error en la inserción: " . $conexion->error;
        }
    }
}

$conexion->close();
?>