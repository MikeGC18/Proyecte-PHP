<?php
require_once '../auth/auth.php';
?>

<!-- Es mostra el panell d'opcion de Gestionar productes, verure informació i tancar sessió -->
<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Dashboard</title>
    <link rel="stylesheet" href="CSS/dashboard.css">

</head>
<body>

<div class="dashboard">
    <h2>Benvingut, <?= htmlspecialchars($_SESSION['usuari']) ?></h2>

    <ul>
        <li><a href="productes.php">Gestionar productes</a></li>
        <li><a href="verinformacio.php">Veure informació</a></li>
        <li><a href="logout.php" class="logout">Tancar sessió</a></li>
    </ul>
</div>

</body>

</html>
