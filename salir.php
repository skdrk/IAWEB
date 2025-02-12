<?php 
require_once "plantillas/session.inc.php";
finalizarSesion();
header("Location: ./index.php");
die();
?>