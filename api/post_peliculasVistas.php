<?php

require_once('./conexion.php');

$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $headers = getallheaders();

    if (!isset($headers['Authorization'])) {
        http_response_code(400);
        echo json_encode(array("mensaje" => "Falta el token de autorización"));
        exit();
    }

    $jwt = str_replace('Bearer ', '', $headers['Authorization']);
    $key = 'MatchFilm';

    try {
        $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
        
        // Verificar si el token está expirado
        if ($decoded->exp < time()) {
            http_response_code(401);
            echo json_encode(array("mensaje" => "Token expirado"));
            exit();
        }

        $json = file_get_contents('php://input');
        $pelicula = json_decode($json);

        $username = $decoded->username;
        $movie_id = $pelicula->movie_id;
        
        $checkSql = "SELECT * FROM movie_likes WHERE username = '$username' AND movie_id = '$movie_id'";
        $result = $con->query($checkSql);
    
        if ($result->num_rows > 0) {
            $sql = "UPDATE movie_likes SET vista = 1 WHERE username = '$username' AND movie_id = '$movie_id'";
        } else {
            $sql = "INSERT INTO movie_likes (username, movie_id, vista) VALUES ('$username', '$movie_id', 1)";
        }
        try {
            $con->query($sql);
            echo json_encode(array("id" => $con->insert_id));
            header("HTTP/1.1 201 Created"); 
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 Bad Request");
            echo json_encode(array("mensaje" => "Error al insertar en la base de datos"));
        }

    } catch (Exception $e) {
        http_response_code(401);
        echo json_encode(array("mensaje" => "Token no válido"));
    }

    exit();
}

header("HTTP/1.1 400 Bad Request");
?>
