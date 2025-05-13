<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión - MatchFilm</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link rel="stylesheet" href="../assets/css/login.css">
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark fixed-top">
        <div class="container">
            <a class="navbar-brand" href="../landing.php">
                <i class="fas fa-film me-2"></i>MatchFilm
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="../landing.php">Inicio</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link btn-register" href="./register.php">Registrarse</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Login Section -->
    <section class="login-section">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-6">
                    <div class="login-card">
                        <div class="login-header text-center">
                            <div class="icon-circle">
                                <i class="fas fa-sign-in-alt"></i>
                            </div>
                            <h1>Iniciar Sesión</h1>
                            <p>Accede a tu cuenta y encuentra películas para ver con tus amigos</p>
                        </div>
                        
                        <div id="alert" class="my-3"></div>
                        
                        <div class="login-form">
                            <div class="form-group mb-3">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-user"></i></span>
                                    <input type="text" name="username" id="username" class="form-control" placeholder="Usuario" minlength="5" required>
                                </div>
                                <p id="usernameError" class="error-message"></p>
                            </div>
                            
                            <div class="form-group mb-4">
                                <div class="input-group">
                                    <span class="input-group-text"><i class="fas fa-lock"></i></span>
                                    <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
                                    <button type="button" class="btn btn-outline-secondary" id="togglePassword">
                                        <i class="fas fa-eye"></i>
                                    </button>
                                </div>
                                <p id="passwordError" class="error-message"></p>
                            </div>
                            
                            <div class="form-group">
                                <button id="loginBtn" class="btn btn-primary btn-lg w-100">
                                    Iniciar Sesión
                                </button>
                                <button type="reset" id="cancel" class="btn btn-outline-secondary btn-lg w-100 mt-2">
                                    Reiniciar
                                </button>
                            </div>
                        </div>
                        
                        <div class="login-footer text-center mt-4">
                            <p>¿No tienes una cuenta? <a href="./register.php">Regístrate</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="login-wave">
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
                <path fill="#ffffff" fill-opacity="1" d="M0,96L48,112C96,128,192,160,288,160C384,160,480,128,576,122.7C672,117,768,139,864,149.3C960,160,1056,160,1152,138.7C1248,117,1344,75,1392,53.3L1440,32L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z"></path>
            </svg>
        </div>
    </section>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="../assets/js/login.js"></script>
</body>
</html>
