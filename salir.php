<?php 
session_start();
require_once "plantillas/session.inc.php";
finalizarSesion();
header("Location: ./login.php");
die();
?>