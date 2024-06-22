<?php
require_once('./conexion.php');
$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $headers = getallheaders();

    // Verifica si el encabezado de autorización está presente
    if (!isset($headers['Authorization'])) {
        http_response_code(400);
        echo json_encode(array("mensaje" => "Falta el token de autorización"));
        exit();
    }

    // $jwt = $headers['Authorization'];
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

        $username = $decoded->username;
        $sql = "SELECT * FROM movie_likes WHERE `username` = '$username' AND `vista` IS NOT NULL ";

        $resultado = $con->query($sql);

        if ($resultado === false) {
            throw new Exception("Error en la consulta SQL: " . $con->error);
        }

        if ($resultado->num_rows > 0) {
            $peliculas = array();
            while ($fila = $resultado->fetch_assoc()) {
                $peliculas[] = $fila;
            }
            $peliculasJSON = json_encode($peliculas);
            header('HTTP/1.1 200 OK');
            echo $peliculasJSON;
        } else {
            header('HTTP/1.1 404 No Content');
            echo json_encode(array("mensaje" => "Películas no encontradas"));
        }
    } catch (Exception $e) {
        http_response_code(400);
        echo json_encode(array("mensaje" => "Error: " . $e->getMessage()));
    }

    exit();
}

header("HTTP/1.1 400 Bad Request");
?>
