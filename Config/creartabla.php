<?php
require_once "connexio.php"; 


// Taula usuaris
$sql_usuarios = "
CREATE TABLE IF NOT EXISTS usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    ultima_sessio DATETIME DEFAULT NULL
) ENGINE=InnoDB;
";
$conn->query($sql_usuarios);


// Taula productes

$sql_productos = "
CREATE TABLE IF NOT EXISTS productes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    preu DECIMAL(10,2) NOT NULL,
    usuari_id INT NOT NULL,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE
) ENGINE=InnoDB;
";
$conn->query($sql_productos);



// Admin (Contrasenya : 1234)
$conn->query("DELETE FROM usuaris WHERE username = 'admin'");
$pass_admin = password_hash("1234", PASSWORD_DEFAULT);
$conn->query("INSERT INTO usuaris (username, password) VALUES ('admin', '$pass_admin')");

// Usuari0 (Contrasenya : 1234)
$conn->query("DELETE FROM usuaris WHERE username = 'usuario'");
$pass_usuario = password_hash("1234", PASSWORD_DEFAULT);
$conn->query("INSERT INTO usuaris (username, password) VALUES ('usuario', '$pass_usuario')");

echo "✅ Tablas creadas y usuarios 'admin' y 'usuario' listos.";

