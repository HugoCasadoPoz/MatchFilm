<?php

require_once('./conexion.php');

$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

$headers = getallheaders();
    
    $jwt = $headers['Authorization'];
    $key = 'MatchFilm';
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    // Verificar si el token está expirado
    if ($decoded->exp < time()) {
        http_response_code(401);
        echo json_encode(array("mensaje" => "Token expirado"));
        exit();
    }
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $notificaciones  = json_decode($json);

    $nombre_usuario = $decoded->username;
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
}elseif ($_SERVER['REQUEST_METHOD'] == 'GET') {
    if (isset($decoded->username)) {
        $nombreUsuario = $decoded->username;
        $sql = "SELECT * FROM notificaciones WHERE nombre_usuario = '$nombreUsuario' OR nombre_amigo = '$nombreUsuario'";
        $result = $con->query($sql);
        
        if ($result && $result->num_rows > 0) {
            $data = array();
            while ($row = $result->fetch_assoc()) {
                // Agregar el campo 'username' al objeto de cada fila
                $row['username'] = $nombreUsuario;
                $data[] = $row;
            }
            echo json_encode($data);
        } else {
            echo json_encode(array()); // Devolver un array vacío si no hay resultados
        }
        exit;
    } else {
        header("HTTP/1.1 400 Bad Request");
        exit;
    }
}elseif($_SERVER['REQUEST_METHOD'] == 'DELETE'){
    $json = file_get_contents('php://input');
    $notificaciones  = json_decode($json);

    $nombre_usuario = $decoded->username;
    $nombre_amigo = $notificaciones->nombre_amigo;
    $notificacion = $notificaciones->notificacion;

    $sql = "DELETE FROM notificaciones WHERE nombre_usuario = $nombre_usuario AND nombre_amigo = $nombre_amigo AND notificacion = $notificacion";

    try {
        $con->query($sql);
        header("HTTP/1.1 201 Delete");
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
    }
    exit;
}
header("HTTP/1.1 400 Bad mal");
?>