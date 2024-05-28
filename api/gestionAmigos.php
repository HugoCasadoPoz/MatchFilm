<?php
if (
    (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'],'http:127.0.0.1:5500/')===false) &&
    (!isset($_SERVER['HTTP_ORIGIN']) || $_SERVER(['HTTP_ORIGIN'] !== 'http:127.0.0.1:5500/')===false)
){
    http_response_code(403);
    echo json_encode(array("mensaje" => "Acceso denegado/No tienes autorización"));
    exit();
}
require_once('./conexion.php');
$json =  json_decode(file_get_contents("php://input"), true);
$con = new Conexion();
$json = file_get_contents('php://input');
$amigos  = json_decode($json);
$nombreUsuario = $amigos->nombre_usuario;
$nombreAmigo = $amigos->nombre_amigo;
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $sql = "INSERT INTO `amigos` (`nombre_usuario`, `nombre_amigo`) VALUES ('$nombreUsuario', '$nombreAmigo')";
        try {
        $con->query($sql);
        echo json_encode($con->insert_id);
        header("HTTP/1.1 201 Amigo agregado"); 
    } catch (mysqli_sql_exception $e) {
        header(`HTTP/1.1 400 $e`);
    }
    exit;
}elseif ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
    $sql = "DELETE FROM amigos WHERE nombre_usuario = '$nombreUsuario' AND nombre_amigo = '$nombreAmigo' OR nombre_usuario = '$nombreAmigo' AND nombre_amigo = '$nombreUsuario'";  
    try {
        $con->query($sql);
        header('HTTP/1.1 201 Delete');
    } catch (mysqli_sql_exception $e) {
        header('HTTP/1.1 400 Bad Request');
    }
}