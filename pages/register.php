<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="http://localhost/matchfilm/assets/css/register.css">
</head>
<body>
    
    <div class="container center-container">
      <div class="register-form">
        <div id="alert"></div>
        <h1 class="text-center">Regístrate</h1>
        <!-- <form> -->
          <div>
            <input type="text" name="username" id="username" class="form-control" minlength="5" placeholder="Usuario" required>
            <p id="usernameError" class="text-danger"></p>
          </div>
          <div>
            <input type="email" name="email" id="email" class="form-control" minlength="8" placeholder="Email" required>
            <p id="emailError" class="text-danger"></p>
          </div>
          <div>
            <input type="password" name="password" id="password" class="form-control" placeholder="Contraseña" required>
            <p id="passwordError" class="text-danger"></p>
          </div>
          <div style="text-align: center;">
            <label for="profilePicture" class="form-label">Foto de perfil</label><br>
            <input accept="image/png, image/jpeg, image/jpg, image/webp" type="file" id="image" name="imagen"/>
            <p id="profilePictureError" class="text-danger"></p>
          </div>
          <div class="d-flex justify-content-between mt-3">
            <button id="registerBtn" class="btn btn-primary">Register</button>
            <input type="reset" value="Reset" id="cancel" class="btn btn-danger">
          </div>
        <!-- </form> -->
        <div class="text-center mt-3">
          <a href="./login.php">¿Ya tienes una cuenta? Inicia sesión</a>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="http://localhost/matchfilm/assets/js/register.js"></script>
</body>
</html>