<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <title>Login</title>
    <link rel="stylesheet" href="css/login.css">
</head>
<body>

<div class="login-container">
    <h2>Login</h2>

    <form id="loginForm">
        <div class="input-group">
            <input type="text" id="username" placeholder="Username">
        </div>

        <div class="input-group password-group">
            <input type="password" id="password" placeholder="Password">
            <i class="fa-solid fa-eye toggle-password" onclick="togglePassword()"></i>
        </div>

        <button type="submit">Login</button>
    </form>
</div>

<script src="js/script.js"></script>
</body>
</html>
