<?php
require_once('./conexion.php');

$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $notificaciones  = json_decode($json);

    $nombre_usuario = $notificaciones->nombre_usuario;
    $nombre_amigo = $notificaciones->nombre_amigo;
    $notificacion = $notificaciones->notificacion;

    $sql = "INSERT INTO `notificaciones` (`nombre_usuario`, `nombre_amigo`, `notificacion`) VALUES ('$nombre_usuario', '$nombre_amigo', '$notificacion');";

    try {
        $con->query($sql);
        header("HTTP/1.1 201 Send It"); 
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
    }
    exit;
}
header("HTTP/1.1 400 Bad mal");
?>