<?php

require_once('./../vendor/autoload.php');
use Firebase\JWT\JWT;
use Firebase\JWT\Key;

// Comprobar si se recibió el token en las cabeceras
$headers = getallheaders();
if (!isset($headers['Authorization'])) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(["error" => "Token no proporcionado"]);
    exit;
}

// Obtener el token y verificar su validez
$jwt = str_replace('Bearer ', '', $headers['Authorization']);
$key = 'MatchFilm';

try {
    // Decodificar el token
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    // Datos del token decodificado
    $username = $_GET['username'];

    // Generar un nuevo token con el nombre de usuario actualizado
    $exp_time = time() + (60 * 60); // 1 hora de expiración (ajustar según necesidades)
    $token_data = [
        'username' => $username,
        'exp' => $exp_time,
    ];

    $new_jwt = JWT::encode($token_data, $key, 'HS256');

    // Devolver el nuevo token como respuesta JSON
    header('Content-Type: application/json');
    echo json_encode(["token" => $new_jwt]);

} catch (Exception $e) {
    header('HTTP/1.1 401 Unauthorized');
    echo json_encode(["error" => "Token inválido o expirado"]);
    exit;
}
?>
