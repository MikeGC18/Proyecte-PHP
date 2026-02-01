<?php
require_once "../config/connexio.php";

$mensaje = '';

if ($_POST) {
    $username = trim($_POST['username']);
    $password = $_POST['password'];

    if (!empty($username) && !empty($password)) {

        // Verificació de 8 caracters com a minim per la contrasenya
        if (strlen($password) < 8) {
            $mensaje = "Contrasenya invàlida: ha de tenir almenys 8 caràcters";
        } else {

            // Verificació de usuari existent
            $stmt = $conn->prepare("SELECT id FROM usuaris WHERE username = ?");
            $stmt->bind_param("s", $username);
            $stmt->execute();
            $result = $stmt->get_result();

            if ($result->num_rows > 0) {
                $mensaje = "Aquest usuari ja existeix";
            } else {
                // Insertar nou usuari amb el hash de la seva contrasenya
                $hash = password_hash($password, PASSWORD_DEFAULT);
                $stmt = $conn->prepare("INSERT INTO usuaris (username, password) VALUES (?, ?)");
                $stmt->bind_param("ss", $username, $hash);
                $stmt->execute();

                $mensaje = "Usuari creat correctament! <a href='login.php'>Iniciar sessió</a>";
            }

        }

    } else {
        $mensaje = "Omple tots els camps";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Crear Usuari</title>
    <link rel="stylesheet" href="CSS/crear_usuari.css">
</head>
<body>

<div class="login-box">
    <h2>Crear Usuari</h2>

    <?php if($mensaje) echo "<p style='color: green; text-align: center;'>$mensaje</p>"; ?>

    <form method="post">
        <input type="text" name="username" placeholder="Nom d'usuari" required>
        <input type="password" name="password" placeholder="Contrasenya (mínim 8 caràcters)" required>
        <button type="submit">Registrar</button>
    </form>

    <p class="small-text">
        <a href="login.php">Tornar al login</a>
    </p>
</div>

</body>
</html>

