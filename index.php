<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio</title>
    <link rel="stylesheet" href="./assets/css/index.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>
<body>
    <?php
        include ('./pages/header.html');
    ?>
    <main id="main">
            <div id="movie">
                <img id="linkImagen"/>

                <div id="movie-info">
                    <h3 id="titulo"></h3>
                    <span id="nota" class=""></span>
                </div>
                <div id="overview">
                    <h3>Descripción:</h3>
                    <p id="descripcion"></p>
                </div>
            </div>
            <div id="acciones">
                <button id="dislike" style="margin-right: 10px;"><img src="./assets/img/boton-x.png" alt="X" width="50px" height="50px"></button>
                <button id="like" style="margin-left: 10px;"><img src="./assets/img/heart.png" alt="Tick" width="50px" height="50px"></button>        
            </div>
            
    </main>
    <script src="./assets/js/index.js"></script>
</body>
</html>