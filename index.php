<?php 
    session_start();
    require_once("./plantillas/plantillas.inc.php");
    require_once("./plantillas/session.inc.php");
    comprobarUsuario();
    headPagina();
    checkonline();
?>


<body>

<!-- Contenedor -->
<div id="contenedor">
    <?php cabecera(); ?>
    <?php menuPrincipal(); ?>
    <?php defaultCategori();?>
    <?php contido(); ?>
    <?php pe(); ?>
    
</div> <!-- /contenedor -->

</body>
</html>
