<?php
require_once __DIR__ . "/../auth/auth.php";
require_once __DIR__ . "/../config/connexio.php";

$user_id = $_SESSION['usuari_id'];

// Obtenim informació de l'usuari amb la consulta sql
$stmt = $conn->prepare("SELECT username, password, ultima_sessio FROM usuaris WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$usuari = $result->fetch_assoc();

if (!$usuari) {
    die("Usuari no trobat");
}

// Opció canviar contrasenya
$mensaje = '';
if ($_POST) {
    $actual = $_POST['actual'] ?? '';
    $nova = $_POST['nova'] ?? '';

    if (password_verify($actual, $usuari['password'])) {
        $nova_hash = password_hash($nova, PASSWORD_DEFAULT);
        $stmt = $conn->prepare("UPDATE usuaris SET password = ? WHERE id = ?");
        $stmt->bind_param("si", $nova_hash, $user_id);
        $stmt->execute();

        $mensaje = "Contrasenya actualitzada correctament!";
        $usuari['password'] = $nova_hash;
    } else {
        $mensaje = "Contrasenya actual incorrecta.";
    }
}
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Informació Usuari</title>
    <link rel="stylesheet" href="CSS/verinformacio.css">
</head>
<body>

<div class="container">

    <h2>Informació de l'usuari</h2>

    <div class="info">
        <p><strong>Usuari:</strong> <?= htmlspecialchars($usuari['username']) ?></p>
        <p><strong>Contrasenya (hash):</strong> <?= htmlspecialchars($usuari['password']) ?></p>
        <p><strong>Última sessió:</strong> <?= $usuari['ultima_sessio'] ?? 'No registrat' ?></p>
    </div>

    <hr>

    <h3>Canviar contrasenya</h3>
    <form method="post" class="password-form">
        <label>Contrasenya actual:</label>
        <input type="password" name="actual" required>

        <label>Nova contrasenya:</label>
        <input type="password" name="nova" required>

        <button type="submit">Canviar contrasenya</button>
    </form>

    <?php if ($mensaje): ?>
        <p class="mensaje"><?= htmlspecialchars($mensaje) ?></p>
    <?php endif; ?>

    <a href="dashboard.php" class="back">⬅ Tornar al Dashboard</a>

</div>

</body>
</html>
