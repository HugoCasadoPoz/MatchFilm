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

$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $usuario  = json_decode($json);

    $username = $usuario->username;
    $email = $usuario->email;
    $password = password_hash($usuario->password, PASSWORD_BCRYPT);

    $sql = "INSERT INTO `usuarios` (`username`,`email`, `password`) VALUES ('$username', '$email', '$password');";

    try {
        $con->query($sql);
        header("HTTP/1.1 201 Created"); 
        echo json_encode($con->insert_id);
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
        echo ($e);
    }
    $con->close();
    exit;
}
header("HTTP/1.1 400 Bad Request");
?>