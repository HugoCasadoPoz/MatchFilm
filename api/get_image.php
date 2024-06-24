<?php
 require ("./../vendor/autoload.php");

use Firebase\JWT\ExpiredException;
use Firebase\JWT\JWT;
 use Firebase\JWT\Key;

 require_once('./conexion.php');

 $con = new Conexion();
 if($_SERVER['REQUEST_METHOD'] == 'GET'){
     $headers = getallheaders();
 
     $jwt = $headers['Authorization'];
     $key = 'MatchFilm';
     try {
     $decoded = JWT::decode($jwt, new Key($key, 'HS256'));
 
     // Verificar si el token está expirado
     if ($decoded->exp < time()) {
         http_response_code(401);
         echo json_encode(array("mensaje" => "Token expirado"));
         exit();
     }
     $nombre_usuario = $decoded->username;
     
     $sql = "SELECT image FROM usuarios WHERE username = '$nombre_usuario'";

        $resultado = $con->query($sql);
        if ($resultado->num_rows>0){
            $fila = $resultado->fetch_assoc();
            $usuarioJSON=json_encode($fila);
            header ('HTTP/1.1 200 OK');
            echo $usuarioJSON;
        }else{
        header('HTTP/1.1 404 Usuario no encontrado');
        }
    } catch (mysqli_sql_exception $e) {
        header(`HTTP/1.1 400 $e`);
    } catch (ExpiredException){
        header('HTTP/1.1 401 Token expirado');
    }
     exit;
 }