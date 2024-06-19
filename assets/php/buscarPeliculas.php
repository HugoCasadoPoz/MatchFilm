<?php
header('Content-Type: application/json');

$api_key = 'eyJhbGciOiJIUzI1NiJ9.eyJhdWQiOiI1Y2EzMWVkZGFiNjE0OGVhNWM1ODY1YWQ5NWZmMWQ4MSIsInN1YiI6IjY1ZTRlNDcyMjBlNmE1MDE2MzUxZjQzOCIsInNjb3BlcyI6WyJhcGlfcmVhZCJdLCJ2ZXJzaW9uIjoxfQ.6IRKLCdBV7SK2KvzvVrlIPar4DjLApqE4RboCW99658';

if (!isset($_GET['query']) || empty($_GET['query'])) {
    http_response_code(400);
    echo json_encode(['error' => 'No se proporcionó una consulta de búsqueda']);
    exit();
}

$query = urlencode($_GET['query']);
$url = "https://api.themoviedb.org/3/search/movie?query=$query&include_adult=false&language=es-ES&page=1";

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
