<?php

require_once('./conexion.php');
$json =  json_decode(file_get_contents("php://input"), true);
$con = new Conexion();

require ("./../vendor/autoload.php");
use Firebase\JWT\JWT;
use Firebase\JWT\Key;
$headers = getallheaders();

    $jwt = $headers['Authorization'];
    $jwt = str_replace('Bearer ', '', $jwt);
    $key = 'MatchFilm';
    $decoded = JWT::decode($jwt, new Key($key, 'HS256'));

    // Verificar si el token está expirado
    if ($decoded->exp < time()) {
        http_response_code(401);
        echo json_encode(array("mensaje" => "Token expirado"));
        exit();
    }
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    

    $username = $decoded->username;
    $sql = "SELECT * FROM usuarios WHERE `username` = '$username' ";
    try {
        $resultado = $con->query($sql);
        if ($resultado->num_rows>0){
            $fila = $resultado->fetch_assoc();
            $usuarioJSON=json_encode($fila);
            header ('HTTP/1.1 200 OK');
            echo $usuarioJSON;
        }else{
        header('HTTP/1.1 400 Usuario no encontrado');
        }
    } catch (mysqli_sql_exception $e) {
        header(`HTTP/1.1 400 $e`);
    }
    exit;
}elseif ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Capturar los datos del formulario
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

    if (isset($_FILES['image']) && $_FILES['image']['tmp_name'] !== '') {
        $imagen_base64 = base64_encode(file_get_contents($_FILES['image']['tmp_name']));
    }

    if (empty($username) || empty($email) || empty($password)) {
        header('Content-Type: application/json');
        header('HTTP/1.1 400 Bad Request');
        echo json_encode(["error" => "Todos los campos son requeridos"]);
        exit;
    }

    // Hash de la contraseña
    $password_hash = password_hash($password, PASSWORD_BCRYPT);

    // Conexión a la base de datos
    require_once('./conexion.php');
    $con = new Conexion();

    // Obtener el usuario antiguo del token decodificado
    $antiguo_username = $decoded->username;

    // Actualizar tabla usuarios con prepared statement
    $stmt = $con->prepare("UPDATE usuarios SET email = ?, password = ?, username = ?, image = ? WHERE username = ?");
    $stmt->bind_param("sssss", $email, $password_hash, $username, $imagen_base64, $antiguo_username);

    // Actualizar otras tablas relacionadas si es necesario
    $sql_amigos_nombre_usuario = "UPDATE amigos SET nombre_usuario = '$username' WHERE nombre_usuario = '$antiguo_username'";
    $sql_amigos_nombre_amigo = "UPDATE amigos SET nombre_amigo = '$username' WHERE nombre_amigo = '$antiguo_username'";
    $sql_notificaciones_nombre_usuario = "UPDATE notificaciones SET nombre_usuario = '$username' WHERE nombre_usuario = '$antiguo_username'";
    $sql_notificaciones_nombre_amigo = "UPDATE notificaciones SET nombre_amigo = '$username' WHERE nombre_amigo = '$antiguo_username'";
    $sql_movie_likes = "UPDATE movie_likes SET username = '$username' WHERE username = '$antiguo_username'";

    try {
        $stmt->execute();
        $con->query($sql_amigos_nombre_usuario);
        $con->query($sql_amigos_nombre_amigo);
        $con->query($sql_notificaciones_nombre_usuario);
        $con->query($sql_notificaciones_nombre_amigo);
        $con->query($sql_movie_likes);

        header('HTTP/1.1 200 OK');
        echo json_encode(["message" => "Usuario actualizado correctamente", "username" => $username]);
    } catch (mysqli_sql_exception $e) {
        header('HTTP/1.1 500 Internal Server Error');
        echo json_encode(["error" => $e->getMessage()]);
    }

    exit;
}
