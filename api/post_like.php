<?php
if (
    (!isset($_SERVER['HTTP_REFERER']) || strpos($_SERVER['HTTP_REFERER'],'http:127.0.0.1:5500/')===false) &&
    (!isset($_SERVER['HTTP_ORIGIN']) || $_SERVER(['HTTP_ORIGIN'] !== 'http:127.0.0.1:5500/')===false)
){
    http_response_code(403);
    echo json_encode(array("mensaje" => "Acceso denegado/No tienes autorización"));
    exit();
}
require_once('./conexion.php');

$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $json = file_get_contents('php://input');
    $pelicula  = json_decode($json);

    $username = $pelicula->username;
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
}
header("HTTP/1.1 400 Bad Request");