<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>MatchFilm - Likes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/perfil.css">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/header.css">
</head>
<body>
<header>
    <div id="logotipos" class="d-flex justify-content-between p-2">
        <a href="http://localhost/matchfilm/pages/index.php" class="logo">
            <img src="http://localhost/matchfilm/assets/img/logo.png" alt="Logo de perfil" width="45px" height="45px">
        </a>
        <a href="http://localhost/matchfilm/pages/likes.php" class="like">
            <img src="http://localhost/matchfilm/assets/img/likes.png" alt="Logo de perfil" width="45px" height="45px">
        </a>
    </div>    
</header>
<div id="alert"></div>
<main class="container">  
    <div class="row perfilUsu">           
        <h3>Perfil</h3>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <h3 id="nombreUser">Nombre de usuario:</h3>
                    <button class='btn btn-danger' id="editarUsuario">Editar Perfil</button>
                    <button class='btn btn-danger' id="cerrarSesión">Cerrar Sesión</button>
                    <button class='btn btn-primary' id="peliculasVistas" onclick="location.href='http://localhost/matchfilm/pages/peliculasVistas.php'">Películas Vistas</button>
                </div>
            </div>
        </div>
    </div>  
    <div class="row amigo mt-3">
        <h3>Pareja:</h3>
        <div id="amigo" class="col-12"></div>
    </div>
    <div class="row notificaciones mt-3">
        <h3>Notificaciones:</h3>
        <div id="notificaciones" class="col-12"></div>
    </div>
</main>

<!-- Modal editar perfil -->
<div class="modal fade" id="editarUsuarioModal" tabindex="-1" aria-labelledby="editarUsuarioModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="alertModal"></div>
            <div class="modal-header">
                <h5 class="modal-title" id="editarUsuarioModalLabel">Editar Usuario</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="mb-3">
                        <label for="nombreUsuario" class="form-label">Nombre de Usuario</label>
                        <input type="text" class="form-control" id="nombreUsuario" placeholder="Nombre de Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailUsuario" class="form-label">Email</label>
                        <input type="email" class="form-control" id="emailUsuario" placeholder="Email del Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="contrasenaUsuario" class="form-label">Contraseña</label>
                        <input type="password" class="form-control" id="contrasenaUsuario" placeholder="Contraseña del Usuario" required>
                    </div>
                    <div class="mb-3">
                        <label for="imagenUsuario" class="form-label">Imagen de Perfil</label>
                        <input type="file" class="form-control" id="imagenUsuario" accept="image/png, image/jpeg, image/jpg, image/webp">
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                <button type="button" class="btn btn-primary" id="btnEditarUsuario">Guardar Cambios</button>
            </div>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
<script src="http://localhost/matchfilm/assets/js/header.js"></script>
<script src="http://localhost/matchfilm/assets/js/perfil.js"></script>
</body>
</html>
