<?php 
    session_start();
    require_once("./plantillas/plantillas.inc.php");
    require_once("./plantillas/session.inc.php");
 ?>
    <div id="contenedor">
        <?php

            headPagina();
            comprobarUsuario();
            cabecera();
            menuPrincipal();

        ?>
        <div>
        <?php eliminarUser(); ?>
        </div>

    </div>