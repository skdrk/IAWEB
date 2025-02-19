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
            <div id="contenedor">
                <form action="crearnodo.php" method="GET">
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titutlo" placeholder="Titulo"><br/>
                <label for="Contido">Contido:</label><br/>
                <textarea id="contido" name="contido" placeholder="Contido" rows="5" cols="50"></textarea>
                <div>
                <label for="subcategorias">Subcategorias</label>
                <select id="subcategorias">
                <?php 
                $categorias = getCategorias();
                for ($i = 0; $i < count($categorias); $i++) {
                
                    if ($i == 0 or $categorias[$i]["categoria"] !=  $categorias[$i - 1]["categoria"] ){
                        if($i>0){
                            echo "</optgroup>";
                        }
                        echo "<optgroup label='" . $categorias[$i]["categoria"] . "'>";
                    }
                    echo "<option value=". $categorias[$i]["subcategoria"] ."> " . $categorias[$i]["subcategoria"] ."</option>";
                } 
                ?>
                </select>
            </div>
        </div>
            </form>
    </div>
