<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/register.css">

</head>
<body>
    <?php
        include ('./pages/header.html');
    ?>
    <h1>Registrate</h1>

    <form method="POST">
        <label for="username">Username:</label></br>
        <input type="text" name="username" id="username" minlength="5" required>
        <p id="usernameError" style="color:#bb3535"></p>

        <label for="email">Email:</label></br>
        <input type="email" name="email" id="email" minlength="8" required>
        <p id="emailError" style="color:#bb3535"></p>

        <label for="password">Password:</label></br>
        <input type="password" name="password" id="password" required>
        <p id="passwordError" style="color:#bb3535"></p>

        <input type="reset" value="Cancel" id="cancel">
    </form>
    <button id="registerBtn">Register</button>

    <script src="./assets/js/register.js"></script>
</body>
</html>