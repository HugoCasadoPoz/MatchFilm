<?php
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
        echo json_encode($con->insert_id);
        header("HTTP/1.1 201 Created"); 
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
    }
    exit;
}
header("HTTP/1.1 400 Bad mal");
?>