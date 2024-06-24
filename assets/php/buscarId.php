<?php
header('Content-Type: application/json');

$api_key = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1Y2EzMWVkZGFiNjE0OGVhNWM1ODY1YWQ5NWZmMWQ4MSIsInN1YiI6IjY1ZTRlNDcyMjBlNmE1MDE2MzUxZjQzOCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6IRKLCdBV7SK2KvzvVrlIPar4DjLApqE4RboCW99658'; // Reemplaza con tu API key de TMDb
$id = $_GET['id'];
$url = "https://api.themoviedb.org/3/movie/$id?api_key=$api_key";

$options = [
    "http" => [
        "method" => "GET",
        "header" => "Accept: application/json\r\nAuthorization: Bearer $api_key\r\n"
    ]
];

$context = stream_context_create($options);
$response = file_get_contents($url, false, $context);

if ($response === FALSE) {
    http_response_code(500);
    echo json_encode(['error' => 'Error al obtener los datos']);
    exit();
}

echo $response;
?>
