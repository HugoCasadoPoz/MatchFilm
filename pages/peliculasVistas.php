<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFilm - Películas Vistas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/likes.css">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/header.css">
    <style>
        .search-bar {
            position: absolute;
            top: 60px;
            left: 10px;
            width: 300px;
            display: none;
            z-index: 999;
            border-radius: 10px;
        }

        .search-bar input {
            display: inline-block;
            width: calc(100% - 40px);
        }

        #resultadosBusqueda {
            max-height: 300px;
            overflow-y: auto;
            margin-top: 10px;
        }

        .result-item {
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 10px;
            border-bottom: 1px solid #ccc;
        }

        .result-item h5 {
            margin: 0;
            flex-grow: 1;
        }
    </style>
</head>

<body>
    <?php
    include('./header.html');
    ?>
    <!-- Barra de búsqueda desplegable -->
    <div class="position-relative">
        <button class="btn btn-secondary" id="searchButton">
            <i class="bi bi-search" style="font-size: 1.5rem;"></i>
        </button>
        <div class="search-bar bg-light border p-2">
            <div class="d-flex">
                <input type="text" class="form-control" id="searchInput" placeholder="Buscar películas...">
                <button class="btn btn-secondary" id="searchActionButton">
                    <i class="bi bi-search"></i>
                </button>
            </div>
            <div id="resultadosBusqueda" class="bg-white border p-2"></div>
            <button class="btn btn-primary mt-2" id="addMovieButton">Agregar a vistas</button>
        </div>
    </div>

    <div id="resultados">
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="http://localhost/matchfilm/assets/js/peliculasVistas.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css">
</body>

</html>