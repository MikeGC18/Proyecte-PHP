CREATE DATABASE IF NOT EXISTS projecte;
USE projecte;

-- Taula usuaris
CREATE TABLE IF NOT EXISTS usuaris (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    ultima_sessio DATETIME DEFAULT NULL
) ENGINE=InnoDB;

-- Taula productes amb noves columnes
CREATE TABLE IF NOT EXISTS productes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nom VARCHAR(100) NOT NULL,
    preu DECIMAL(10,2) NOT NULL,
    empresa VARCHAR(100) DEFAULT NULL,
    fecha_publicacion DATE DEFAULT NULL,
    origen VARCHAR(100) DEFAULT NULL,
    usuari_id INT NOT NULL,
    FOREIGN KEY (usuari_id) REFERENCES usuaris(id) ON DELETE CASCADE
) ENGINE=InnoDB;

-- Usuaris inicials
-- Contrasenya: 1234 (hash)
DELETE FROM usuaris WHERE username = 'admin';
DELETE FROM usuaris WHERE username = 'usuario';

INSERT INTO usuaris (username, password) VALUES
(
  'admin',
  '$2y$10$QyK8ZBv0R7R0VY5TqMZCBeP5lH8k8VwKxq1lWQXG5Wc0C9mWk4u7C'
),
(
  'usuario',
  '$2y$10$QyK8ZBv0R7R0VY5TqMZCBeP5lH8k8VwKxq1lWQXG5Wc0C9mWk4u7C'
);

