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
            $fotos = getfotos();

        ?>

        <div>
        
        <?php 
        $fotos = getFotos();
        echo '<div class="articulo">';
        for ($x = 0; $x < count($fotos); $x++) {
            echo '<div style="display: flex; align-items: center; gap: 20px;margin-top: 10px;">';
            echo '<div style="flex: 1;">';
            echo '<h2><a href="#">' . $fotos[$x]["titulo"] . '</a></h2>';
            echo '<p>' . $fotos[$x]["descripcion"] . '</p>';
            if ($_SESSION["rol"] == "admin") {
                echo "<div style='display: flex; gap: 10px; margin-top: 10px;'>";
                echo "<form method='GET' action='borrarFoto.php'><button type='submit' name='foto' value='" . $fotos[$x]["id"] . "'>Borrar</button></form>";
                echo "<form method='GET' action='editarFoto.php'><button type='submit' name='foto' value='" . $fotos[$x]["id"] . "'>Editar</button></form>";
                echo "</div>";
            }
            echo '</div>';
            echo '<img src="' . $fotos[$x]["imagen"] . '" style="max-width: 150px; height: auto; border-radius: 5px;">';
            echo '</div>';
        }
        echo '</div>';
        ?>

        </div>
