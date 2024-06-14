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
    $username = $decoded->username;
    $sql = "SELECT * FROM movie_likes WHERE  `like` = 1 AND `username` = '$username' ";
    try {
        $resultado = $con->query($sql);
        if ($resultado->num_rows>0){
            $peliculas=array();
        while ($fila = $resultado->fetch_assoc()) {
            $peliculas[] = $fila;
        }
        $peliculasJSON=json_encode($peliculas);
        header ('HTTP/1.1 200 OK');
        echo $peliculasJSON;
        }else{
        header('HTTP/1.1 400 Películas no encontradas');
        }
    } catch (mysqli_sql_exception $e) {
        header(`HTTP/1.1 400 $e`);
    }
    exit;
}