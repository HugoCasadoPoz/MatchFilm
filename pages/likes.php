<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFilm- Likes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/likes.css">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/header.css">
</head>
<body>
    <?php
        include ('./header.html');
    ?>
    <div class="d-flex justify-content-end p-2">
        <button class="btn btn-primary" onclick="location.href='http://localhost/matchfilm/pages/peliculasVistas.php'">
            <img src="http://localhost/matchfilm/assets/img/vistas.png" alt="Películas Vistas" width="30px" height="30px">
        </button>
    </div>
    <main id="main">
        <button class='botones' id="matches">Matches</button>
        <button class='botones' id="like">Likes</button>
    </main>
    <!-- <div id="alert"></div> -->
    <div id="resultados">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="http://localhost/matchfilm/assets/js/likes.js"></script>
</body>
</html>
