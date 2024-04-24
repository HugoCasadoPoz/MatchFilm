<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="./assets/css/header.css">
    <link rel="stylesheet" href="./assets/css/login.css">

</head>
<body>
    <?php
        include ('./pages/header.html');
    ?>
    <h1>Login</h1>

    <form method="POST">
        <label for="username">Username:</label></br>
        <input type="text" name="username" id="username" minlength="5" required>
        <p id="usernameError" style="color:#bb3535"></p>

        <label for="password">Password:</label></br>
        <input type="password" name="password" id="password" required>
        <p id="passwordError" style="color:#bb3535"></p>

        <input type="reset" value="Cancel" id="cancel">
    </form>
    <button id="loginBtn">Login</button>

    <script src="./assets/js/login.js"></script>
</body>
</html>
