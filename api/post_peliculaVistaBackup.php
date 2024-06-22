<?php

require_once('./conexion.php');

$con = new Conexion();
require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $headers = getallheaders();

    $authHeader = $headers['Authorization'];
    $jwt = str_replace('Bearer ', '', $authHeader);
    $key = 'MatchFilm';
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
    $movie_id = $_POST['movie_id'];
    // $movie_id = $pelicula->movie_id;

    $sql = "INSERT INTO `peliculasVistas` (`username`, `movie_id`) VALUES ('$username', '$movie_id')";

    try {
        $con->query($sql);
        if ($con->affected_rows > 0) {
            echo json_encode($con->insert_id);
            header("HTTP/1.1 201 Created");
        } else {
            header("HTTP/1.1 400 Bad BAd ",$con->affected_rows);
            echo json_encode($movie_id);            
        }
    } catch (mysqli_sql_exception $e) {
        header("HTTP/1.1 400 Bad Request");
        echo json_encode(array("error" => "Error: ".$e->getMessage(), "sql" => $sql));
    }
    exit;
}
header("HTTP/1.1 400 Bad Request");
?>
