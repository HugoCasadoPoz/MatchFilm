<!DOCTYPE html>
<html lang="en">
<head>
    <title>MatchFilm - Likes</title>
    <link rel="stylesheet" href="./assets/css/likes.css">
    <link rel="stylesheet" href="./assets/css/header.css">
</head>
<body>
    <?php
        include ('./pages/header.html');
    ?>
    <main>
        <button class='botones' id="cerrarSesión">Cerrar Sesión</button>
       
    </main>
    <div id="resultados">
    </div>
    <script>
    if(localStorage.getItem('username')){
        document.getElementById('cerrarSesión').addEventListener('click', cerrarSesion)
        function cerrarSesion(){
            localStorage.clear();
            window.location.href = './index.php';
        }
    }else{
        localStorage.removeItem('token');        
        localStorage.removeItem('username');        
        alert ('Necesita iniciar sesion');
        location.href="./login.php";
    }
        
    </script>
</body>
</html>