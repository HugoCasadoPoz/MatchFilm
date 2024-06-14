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
        $usuario = $decoded->username;
        $amigo = $pelicula->amigo;

        $sql = "SELECT movie_id
                FROM movie_likes
                WHERE (username = ? OR username = ?) AND `like` = 1
                GROUP BY movie_id
                HAVING COUNT(DISTINCT username) = 2";

        try {
            $stmt = $con->prepare($sql);
            
            $stmt->bind_param("ss", $usuario, $amigo);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                $peliculas = $result->fetch_all(MYSQLI_ASSOC);
                $peliculasJSON = json_encode($peliculas);
                echo $peliculasJSON;
                header('HTTP/1.1 200 OK');
            } else {
                header('HTTP/1.1 400 Películas no encontradas');
            }
            $stmt->close();
        } catch (mysqli_sql_exception $e) {
            header("HTTP/1.1 400 " . $e);
        }
    
    // Cerrar la conexión a la base de datos
    $con->close();
}
?>
