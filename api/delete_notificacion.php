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
    if($_SERVER['REQUEST_METHOD'] == 'POST'){
        $json = file_get_contents('php://input');
        $notificaciones  = json_decode($json);

        $nombre_usuario = $notificaciones->nombre_usuario;
        $nombre_amigo = $notificaciones->nombre_amigo;
        $notificacion = $notificaciones->notificacion;

        $sql = "DELETE FROM notificaciones WHERE nombre_usuario = '$nombre_usuario' AND nombre_amigo = '$nombre_amigo' AND notificacion = '$notificacion'";

        try {
            $con->query($sql);
            header("HTTP/1.1 201 Delete");
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 Bad Request");
        }
        exit;
    }
?>