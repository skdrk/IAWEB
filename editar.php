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
            $artigos = getArtigos();
            editArtigos($artigos);

        ?>

        <div>
            <h1>Editando artícul <strong> <?php echo $artigos[0]["titulo"];?></strong></h1>
            <form action="editar.php" method='GET'>
                <input type="hidden" name="articulo" value="<?php echo $artigos[0]["id"] ; ?>">
                <label for="titulo">Titulo: </label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $artigos[0]["titulo"] ?>"></br></br>
                <label for="contido">Contido: </label>
                <textarea id="contido" name="contido" rows="10" cols="102"><?php echo $artigos[0]["contido"];?></textarea>
                <div id="lista">
                    <label for="subcategorias">Subcategorias</label>
                    <select name='subcategoria' id="subcategorias" >
                    <?php 
                    $categorias = getCategorias();
                    for ($i = 0; $i < count($categorias); $i++) {
                    
                        if ($i == 0 or $categorias[$i]["categoria"] !=  $categorias[$i - 1]["categoria"] ){
                            if($i>0){
                                echo "</optgroup>";
                            }
                            echo "<optgroup label='" . $categorias[$i]["categoria"] . "'>";
                        }
                        if ($categorias[$i]["subcategoria"] == $artigos[0]["subcategoria"]) {
                            echo "<option value=". $categorias[$i]["subcategoria"] ." selected> " . $categorias[$i]["subcategoria"] ."</option>";
                        } else {
                            echo "<option value=". $categorias[$i]["subcategoria"] ."> " . $categorias[$i]["subcategoria"] ."</option>";
                        } 
                    } 
                    ?>
                    </select>
                </div>
                </br>
                <input type="submit" name="guardar" value="Guardar">
            </form>
        </div>

    </div>
