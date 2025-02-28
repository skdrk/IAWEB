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
              
                    echo '<h2><a href="#">' . $fotos[$x]["titulo"] . '</a></h2>';
                    echo '<p class="info">';
                    echo "<p>" . $fotos[$x]["descripcion"]. "</p>";
                    if ($_SESSION["rol"] == "admin") {
                        echo "<div class='botones-articulos'> <form method='GET' action='borrarFoto.php'><button type='submit' name='foto' value='" . $fotos[$x]["id"] . "'>Borrar</button></form></div>";
                        echo "<div class='botones-articulos'> <form method='GET' action='editarFoto.php'><button type='submit' name='foto' value='" . $fotos[$x]["id"] . "'>Editar</button></form></div>";
                    }
                    echo "<img src='" . $fotos[$x]["imagen"]. "'></img>";
            }
            echo '</div> <!-- /articulo -->'
        ?>
        </div>
