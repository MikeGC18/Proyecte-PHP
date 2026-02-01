<?php
session_start();
require_once __DIR__ . "/../config/connexio.php";

// Verificació del login d'usuari comprovant el seu usuari i contraseña corresponent
if (!empty($_POST['username']) && !empty($_POST['password'])) {

    $username = $_POST['username'];
    $password = $_POST['password'];

    $stmt = $conn->prepare("SELECT id, username, password FROM usuaris WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 1) {
        $usuari = $result->fetch_assoc();

        if (password_verify($password, $usuari['password'])) {

            // Actualizar última sessió
            $stmt2 = $conn->prepare("UPDATE usuaris SET ultima_sessio = NOW() WHERE id = ?");
            $stmt2->bind_param("i", $usuari['id']);
            $stmt2->execute();

            $_SESSION['usuari_id'] = $usuari['id'];
            $_SESSION['usuari'] = $usuari['username'];

            header("Location: dashboard.php");
            exit();
        } else {
            $_SESSION['login_error'] = "Usuari o contrasenya incorrectes";
            header("Location: login.php");
            exit();
        }
    } else {
        $_SESSION['login_error'] = "Usuari o contrasenya incorrectes";
        header("Location: login.php");
        exit();
    }
} else {
    $_SESSION['login_error'] = "Omple tots els camps";
    header("Location: login.php");
    exit();
}


