<?php

require_once('./conexion.php');
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
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
    $json = file_get_contents('php://input');
    $usuarios  = json_decode($json);

    $usuario = $decoded->username;
    $amigo = $usuarios->amigo;

    $query = "SELECT * FROM movie_likes WHERE  movie_id NOT IN (SELECT movie_id FROM movie_likes WHERE username = '$usuario') AND movie_id IN (SELECT movie_id FROM movie_likes WHERE username = '$amigo' AND `like` = 1)";
    $result = $con->query($query);

    if ($result && $result->num_rows > 0) {
        // Películas encontradas
        $peliculas = array();
        while ($row = $result->fetch_assoc()) {
            $peliculas[] = $row;
        }
        header("HTTP/1.1 200 Películas encontradas"); 
        echo json_encode($peliculas);
    } else {
        header("HTTP/1.1 401 Películas no encontradas"); 
        echo json_encode(array("message" => "$query"));
    }
}