<?php
require_once '../auth/auth.php';
require_once '../config/connexio.php';

// Consulta amb mysqli 
$sql = "SELECT p.id, p.nom, p.preu, p.empresa, p.fecha_publicacion, p.origen, u.username
        FROM productes p
        JOIN usuaris u ON p.usuari_id = u.id
        WHERE u.id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $_SESSION['usuari_id']); 
$stmt->execute();

$result = $stmt->get_result(); 
?>

<!DOCTYPE html>
<html lang="ca">
<head>
    <meta charset="UTF-8">
    <title>Productes</title>
    <link rel="stylesheet" href="css/productes.css">
</head>
<body>

<div class="container">

    <h2>Productes</h2>

    <div class="actions">
        <a href="afegir_producte.php">+ Afegir producte</a>
        <a href="dashboard.php">⬅ Tornar</a>
    </div>

    <table>
        <tr>
            <th>Nom</th>
            <th>Preu</th>
            <th>Empresa</th>
            <th>Data publicació</th>
            <th>Origen</th>
            <th>Usuari</th>
            <th>Accions</th>
        </tr>

        <?php 
        // Codi mer mostrar al crud de productes les seves columnes y dades
        while ($row = $result->fetch_assoc()) { ?>
        <tr>
            <td><?= htmlspecialchars($row['nom']) ?></td>
            <td><?= htmlspecialchars($row['preu']) ?> €</td>
            <td><?= htmlspecialchars($row['empresa']) ?></td>
            <td><?= htmlspecialchars($row['fecha_publicacion']) ?></td>
            <td><?= htmlspecialchars($row['origen']) ?></td>
            <td><?= htmlspecialchars($row['username']) ?></td>
            <td class="table-actions">
                <a href="editar_producte.php?id=<?= $row['id'] ?>" class="edit">Editar</a>
                <a href="eliminar_producte.php?id=<?= $row['id'] ?>" class="delete"
                   onclick="return confirm('Segur que vols eliminar aquest producte?')">Eliminar</a>
            </td>
        </tr>
        <?php } ?>
    </table>

</div>

</body>
</html>


