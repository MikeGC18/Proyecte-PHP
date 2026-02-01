<?php
require_once __DIR__ . "/../auth/auth.php";
require_once __DIR__ . "/../config/connexio.php";

$userId = $_SESSION['usuari_id'];

// Obtenim informació del usuari amb consulta sql
$stmt = $conn->prepare("SELECT username, password, ultima_sessio FROM usuaris WHERE id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
$user = $result->fetch_assoc();

if (!$user) {
    die("Usuari no trobat");
}

$mensaje = '';
$mensajeColor = 'green';

// comprovació de canvi de contrasenya
if ($_POST) {
    $passActual = $_POST['actual'] ?? '';
    $passNova = $_POST['nova'] ?? '';

    if (!password_verify($passActual, $user['password'])) {
        $mensaje = "Contrasenya actual incorrecte.";
        $mensajeColor = 'red';
    } elseif (strlen($passNova) < 8) {
        $mensaje = "La nova contrasenya ha de tenir com a mínim 8 caràcters.";
        $mensajeColor = 'red';
    } else {
        $passHash = password_hash($passNova, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuaris SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $passHash, $userId);
        if ($stmt->execute()) {
            $mensaje = "Contrasenya actualitzada correctament!";
            $user['password'] = $passHash; // Mantener sesión
            $mensajeColor = 'green';
        } else {
            $mensaje = "Error al actualizar la contrasenya: " . $stmt->error;
            $mensajeColor = 'red';
        }
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Informació de l'usuari</title>
    <link rel="stylesheet" href="CSS/verinformacio.css">
</head>
<body>
<div class="container">
    <h2>Informació de l'usuari</h2>

    <div class="info">
        <p><strong>Usuari:</strong> <?= htmlspecialchars($user['username']) ?></p>
        <p><strong>Contrasenya (hash):</strong> <?= htmlspecialchars($user['password']) ?></p>
        <p><strong>Última sessió:</strong> <?= $user['ultima_sessio'] ?? 'No registrat' ?></p>
    </div>

    <h3>Canviar contrasenya</h3>
    <form method="post" class="password-form">
        <label>Contrasenya actual:</label>
        <input type="password" name="actual" required>

        <label>Nova contrasenya:</label>
        <input type="password" name="nova" required>

        <button type="submit">Canviar contrasenya</button>
    </form>

    <?php if($mensaje): ?>
        <p class="mensaje" style="color: <?= $mensajeColor ?>;"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <a href="dashboard.php" class="back">⬅ Tornar al Dashboard</a>
</div>
</body>
</html>


