<?php
require "../auth/auth.php";
require "../config/connexio.php";

$id = $_GET['id'] ?? 0;
if (!$id) header("Location: productes.php");

// Extreure dades del producte
$stmt = $conn->prepare("SELECT * FROM productes WHERE id=? AND usuari_id=?");
$stmt->bind_param("ii", $id, $_SESSION['usuari_id']);
$stmt->execute();
$producte = $stmt->get_result()->fetch_assoc();

if (!$producte) die("Accés no permès");

// Actualizació del producte
if ($_POST) {
    $nom = $_POST['nom'];
    $preu = $_POST['preu'];
    $empresa = $_POST['empresa'] ?? '';
    $fecha_publicacion = $_POST['fecha_publicacion'] ?? null;
    $origen = $_POST['origen'] ?? '';

    if (!empty($nom) && is_numeric($preu)) {
        $stmt = $conn->prepare("UPDATE productes SET nom=?, preu=?, empresa=?, fecha_publicacion=?, origen=? WHERE id=? AND usuari_id=?");
        $stmt->bind_param("sdssssi", $nom, $preu, $empresa, $fecha_publicacion, $origen, $id, $_SESSION['usuari_id']);
        $stmt->execute();
        header("Location: productes.php");
        exit();
    }
}
?>

<link rel="stylesheet" href="CSS/editar_producte.css">
<div class="container">
    <h2>Editar Producte</h2>

    <form method="post">
        <label>Nom:</label>
        <input type="text" name="nom" value="<?= htmlspecialchars($producte['nom']) ?>" required>

        <label>Preu:</label>
        <input type="number" step="0.01" name="preu" value="<?= htmlspecialchars($producte['preu']) ?>" required>

        <label>Empresa:</label>
        <input type="text" name="empresa" value="<?= htmlspecialchars($producte['empresa']) ?>">

        <label>Data de publicació:</label>
        <input type="date" name="fecha_publicacion" value="<?= htmlspecialchars($producte['fecha_publicacion']) ?>">

        <label>Origen:</label>
        <input type="text" name="origen" value="<?= htmlspecialchars($producte['origen']) ?>">

        <button type="submit">Actualitzar</button>
    </form>

    <a href="productes.php">⬅ Tornar</a>
</div>

