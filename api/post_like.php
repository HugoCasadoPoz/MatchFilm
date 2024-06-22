<?php

require_once('./conexion.php');

$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
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
    $pelicula  = json_decode($json);

    $username = $decoded->username;
    $movie_id = $pelicula->movie_id;
    $like = $pelicula->like;
    
    if($like == true){
        $sql = "INSERT INTO `movie_likes` (`username`,`movie_id`, `like`) VALUES ('$username', '$movie_id', '1');";
    }else{
        $sql = "INSERT INTO `movie_likes` (`username`,`movie_id`, `like`) VALUES ('$username', '$movie_id', '0');";
    }

    try {
        $con->query($sql);
        echo json_encode($con->insert_id);
        header("HTTP/1.1 201 Like"); 
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
    }
    exit;
}else if ($_SERVER['REQUEST_METHOD'] == 'DELETE') {
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
    $pelicula  = json_decode($json);

    $username = $decoded->username;
    $movie_id = $pelicula->movie_id;
    $like = $pelicula->like;
    $sql = "DELETE FROM movie_likes WHERE username = '$username' AND movie_id = '$movie_id' AND `like` = 1";    

    try {
        $con->query($sql);
        echo json_encode($con->insert_id);
        header("HTTP/1.1 201 Like Remove"); 
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
    }
    exit;
}
header("HTTP/1.1 400 Bad Request");