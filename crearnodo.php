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
            $resultado = crearNodo();
            ?>
            <div id="contenedor">
                <form action="crearnodo.php" method="GET">
                <label for="titulo">Titulo:</label>
                <input type="text" id="titulo" name="titulo" placeholder="Titulo" required><br/>
                <br/>
                <label for="Contido">Contido:</label><br/>
                <textarea id="contido" name="contido" placeholder="Contido" rows="5" cols="50" required></textarea>
                <div id="lista">
                    <label for="subcategorias">Subcategorias</label>
                    <select name='subcategoria' id="subcategorias">
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
                <br/>
                <input type="submit">
            </div>
            </form>
            <div><?php if ($resultado == True) { echo "<h2 style='color:green;'>¡Se ha creado la noticia con éxito!";}?></h2></div>
    </div>
