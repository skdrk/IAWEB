<?php 
    session_start();
    require_once("./plantillas/plantillas.inc.php");
    require_once("./plantillas/session.inc.php");
 ?>
    <div id="contenedor">
        <?php
            $resultado = borrarNodo();
            headPagina();
            comprobarUsuario();
            cabecera();
            menuPrincipal();

        ?>

        <div>
        <?php if ($resultado == True) { echo "<h1 style='color:green;'>¡Borrado con éxito!<h1>";} else { ?>
            <?php $artigos = getArtigos(); ?>
            <p>¿Estás seguro de que quieres borrar el artículo <strong> <?php for ($x = 0; $x < count($artigos); $x++) {if ($artigos[$x]["id"] == $_GET["articulo"]) { echo $artigos[$x]["titulo"];}} ?></strong>?</p>
            <form action="borrar.php" method='GET'>
                <input type="hidden" name="articulo" value="<?php echo $_GET['articulo']; ?>">
                <button type="submit" value="cancelar">Cancelar</button>
                <button type="submit" name="borrar" value="1">Borrar</button>
            </form>
            <?php } ?>
        </div>

    </div>
