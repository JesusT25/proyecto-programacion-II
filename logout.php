<?php
//Iniciar una sesión
session_start();

$last_page = isset($_SESSION['last_page']) ? $_SESSION['last_page'] : 'index.php';

//Eliminando la sesión
session_destroy();

//Redirigir a la ultima pagina  
header("Location: $last_page");
exit();
?>