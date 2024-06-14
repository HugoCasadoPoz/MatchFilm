<?php

require_once('./conexion.php');
$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
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

    if(isset($decoded->username)) {
        $nombreUsuario = $decoded->username;
        $sql = "SELECT * FROM amigos WHERE (nombre_usuario = '$nombreUsuario' OR nombre_amigo = '$nombreUsuario')";
        try {
            $resultado = $con->query($sql);
            if ($resultado->num_rows > 0) {  
                $amigos = $resultado->fetch_all(MYSQLI_ASSOC);
                header('HTTP/1.1 200 Tiene Amigo');
                echo json_encode($amigos);
            } else {
                header('HTTP/1.1 400 Amigos no encontrados');
            }
        } catch (mysqli_sql_exception $e) {
            header('HTTP/1.1 400 Error en la consulta: ' . $e->getMessage());
        }
    } else {
        header('HTTP/1.1 400 Parametro "nombre_usuario" faltante');
    }
    exit;
}
?>
