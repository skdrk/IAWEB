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
            $resultado = crearCategoria();
            ?>
            <div id="contenedor">
                <form action="crearcategoria.php" method="GET">
                <label for="categoria">Categoría Nueva (subrir solo si se va a crear):</label>
                <input type="text" id="categoria" name="categoria" placeholder="Nueva categoria"><br/>
                <br/>
                <div>
                    <label for="categorias">Categorias</label>
                    <select name='categorias' id="categorias">
                    <?php 
                    $categorias = getCategorias();
                    for ($i = 0; $i < count($categorias); $i++) {
                    
                        if ($i == 0 or $categorias[$i]["categoria"] !=  $categorias[$i - 1]["categoria"] ){
                            if($i>0){
                                echo "</option>";
                            }
                            
                            echo "<option value=". $categorias[$i]['categoria'] ."> " . $categorias[$i]['categoria'] ."</option>";
                        }
                    } 
                    ?>
                    </select>
                </div>
                <br/>
                <label for="subcategoria">Subcategoria</label>
                <input type="text" id="subcategoria" name="subcategoria" placeholder="Nueva subcategoria" required><br/>
                <br/>
                <input type="submit">
            </div>
            </form>
    </div>
