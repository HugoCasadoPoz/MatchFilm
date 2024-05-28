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
    <div id="alert"></div>
    <main>  
        <div class="perfilUsu">           
            <h3>Perfil</h3>
            <div>
                <div class="card">
                    <div class="card-body">
                        <h3 id="nombreUser">Nombre de usuario:</h3>
                        <button class='btn btn-danger' id="cerrarSesión">Cerrar Sesión</button></br>
                    </div>
                </div>
            </div>
        </div>  
        <div class="amigo">
            <h3>Pareja:</h3>
            <div id="amigo"></div>
        </div>
        <div class="notificaciones">
            <h3>Notificaciones:</h3>
            <div id="notificaciones"></div>
        </div>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./assets/js/perfil.js"></script>

</body>
</html>
