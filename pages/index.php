<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MatchFilm - Descubre películas</title>
    <!-- <title>AaAaAAAAaaAAAa</title> -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/header.css">
    <link rel="stylesheet" href="../assets/css/index.css">
</head>
<body>
    <?php
        include ('./header.html');
    ?>
    
    <div class="main-container">
        <div id="alert" class="alert-container"></div>
        
        <main id="main">
            <div class="card-container">
                <div id="movie" class="movie-card">
                    <div class="movie-poster">
                        <img id="linkImagen" alt="Poster de la película" />
                        <div class="movie-rating">
                            <span id="nota" class=""></span>
                        </div>
                    </div>
                    
                    <div id="movie-info" class="movie-info">
                        <h3 id="titulo" class="movie-title"></h3>
                    </div>
                    
                    <div id="overview" class="movie-overview">
                        <h4>Descripción:</h4>
                        <p id="descripcion"></p>
                    </div>
                </div>
                
                <div id="acciones" class="action-buttons">
                    <button id="dislike" class="action-btn dislike">
                        <i class="fas fa-times"></i>
                    </button>
                    <button id="like" class="action-btn like">
                        <i class="fas fa-heart"></i>
                    </button>
                </div>
            </div>
            
            <div class="instructions">
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-info-circle"></i>
                    </div>
                    <p>Desliza hacia arriba para ver la descripción completa</p>
                </div>
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-heart"></i>
                    </div>
                    <p>Da like a las películas que quieras ver con tu amigo</p>
                </div>
                <div class="instruction-item">
                    <div class="instruction-icon">
                        <i class="fas fa-bell"></i>
                    </div>
                    <p>Recibirás una notificación cuando haya un match</p>
                </div>
            </div>
        </main>
    </div>
    
    <!-- Match Modal -->
    <div class="match-modal" id="matchModal">
        <div class="match-content">
            <div class="match-header">
                <h2><i class="fas fa-heart"></i> ¡MATCH!</h2>
                <p>Tú y <span id="matchUsername"></span> queréis ver esta película</p>
            </div>
            <div class="match-movie">
                <img id="matchMovieImage" alt="Poster de la película" />
                <h3 id="matchMovieTitle"></h3>
            </div>
            <div class="match-actions">
                <button id="continueBtn" class="btn-continue">Seguir explorando</button>
                <button id="viewMatchesBtn" class="btn-view-matches">Ver mis matches</button>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/index.js"></script>
</body>
</html>
