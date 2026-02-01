<?php
require_once __DIR__ . "/../auth/auth.php";
require_once __DIR__ . "/../config/connexio.php"; 

$id = $_GET['id'] ?? null;
if (!$id) {
    header("Location: productes.php");
    exit();
}

//Eliminació consulta del producte
$stmt = $conn->prepare(
    "DELETE FROM productes WHERE id = ? AND usuari_id = ?"
);
$stmt->bind_param("ii", $id, $_SESSION['usuari_id']);
$stmt->execute();

header("Location: productes.php");
exit();
