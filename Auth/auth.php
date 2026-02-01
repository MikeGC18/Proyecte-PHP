<?php
session_start();

if (!isset($_SESSION['usuari_id'])) {
    header("Location: login.php");
    exit();
}
