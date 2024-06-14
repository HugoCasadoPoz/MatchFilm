<?php
require_once('./conexion.php');

$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $usuario  = json_decode($json);

    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($password = $_POST['password'], PASSWORD_BCRYPT);
    $imagen_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));


    $sql = "INSERT INTO `usuarios` (`username`,`email`, `password`, `image`) VALUES ('$username', '$email', '$password', '$imagen_base64');";

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