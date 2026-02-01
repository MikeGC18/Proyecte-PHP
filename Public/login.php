<?php session_start(); ?>
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Login</title>
    <link rel="stylesheet" href="CSS/login.css">
</head>
<body>

<div class="login-box">
    <h2>Iniciar sessió</h2>

    <?php
    // Verificació del login
    if (isset($_SESSION['login_error'])) {
        echo "<p class='error-message'>".$_SESSION['login_error']."</p>";
        unset($_SESSION['login_error']); 
    }
    ?>

    <form method="post" action="verificar_login.php">
        <input type="text" name="username" placeholder="Usuari" required>
        <input type="password" name="password" placeholder="Contrasenya" required>
        <button type="submit">Entrar</button>
    </form>

    <p class="small-text">
        <a href="crear_usuari.php">Crear usuari</a>
    </p>

    <div class="login-footer">
        Panell de gestió · Projecte PHP
    </div>
</div>

</body>
</html>


