<!DOCTYPE html>
<html lang="en">
<head>
    <title>MatchFilm - Likes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="./assets/css/perfil.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>
<body>
    <?php
        include ('./pages/header.html');
    ?>
    <main>
        <h1>Perfil</h1><br>

        <button class='botones' id="cerrarSesión">Cerrar Sesión</button></br>
        <!-- <h1>Amigo:</h1> -->
        <!-- <input type="text" id="nombreAmigo" placeholder="Nombre de usuario">
        <button class="botones" onclick="agregarAmigo()">Agregar Amigo</button> -->
        <h1>Amigo:</h1>
        <ul id="amigo">
        </div>  
    </main>
    <div id="resultados">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./assets/js/perfil.js"></script>

</body>
</html>