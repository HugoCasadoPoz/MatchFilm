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
$json =  json_decode(file_get_contents("php://input"), true);
$con = new Conexion();

if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    $username = $_GET['nombre_usuario'];
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