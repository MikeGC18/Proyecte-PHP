<?php
require_once __DIR__ . "/../auth/auth.php";
require_once __DIR__ . "/../config/connexio.php"; 

if ($_POST) {
    // Validació de camps obligatoris
    if (!empty($_POST['nom']) && is_numeric($_POST['preu']) && !empty($_POST['empresa'])) {

        // SQL per insertar tots els camps
        $sql = "INSERT INTO productes (nom, preu, empresa, fecha_publicacion, origen, usuari_id) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        $stmt = $conn->prepare($sql);
        $stmt->bind_param(
            "sdsssi", 
            $_POST['nom'],                 
            $_POST['preu'],                
            $_POST['empresa'],             
            $_POST['fecha_publicacion'],   
            $_POST['origen'],              
            $_SESSION['usuari_id']         
        );
        $stmt->execute();

        header("Location: productes.php");
        exit();
    } else {
        echo "<p style='color:red'>Falten camps obligatoris o el preu no és numèric</p>";
    }
}
?>
<link rel="stylesheet" href="CSS/afegir_producte.css">
<div class="container">
    <h2>Afegir Producte</h2>

    <?php if (!empty($error)) echo "<p class='error'>$error</p>"; ?>

    <form method="post">
        <input type="text" name="nom" placeholder="Nom del producte" required>
        <input type="text" name="preu" placeholder="Preu" required>
        <input type="text" name="empresa" placeholder="Empresa" required>
        <input type="date" name="fecha_publicacion" placeholder="Data publicació">
        <input type="text" name="origen" placeholder="Origen">
        <button type="submit">Guardar</button>
    </form>

    <a href="productes.php">⬅ Tornar</a>
</div>



