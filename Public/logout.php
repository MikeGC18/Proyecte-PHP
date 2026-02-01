<?php
// Opcions per tancar la sessio
session_start();
session_destroy();

header("Location: login.php");
exit();
