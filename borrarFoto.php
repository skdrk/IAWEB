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
            borrarFoto();
            $fotos = getFotos();
        ?>

        <div>
        
            <?php $artigos = getArtigos(); ?>
            <p>¿Estás seguro de que quieres borrar la foto <strong> <?php echo $fotos[0]["titulo"];?></strong>?</p>
            <form action="borrarFoto.php" method='GET'>
                <input type="hidden" name="foto" value="<?php echo $_GET['foto']; ?>">
                <button><a href="fotos.php">Cancelar</a></button>
                <button type="submit" name="borrar" value="1">Borrar</button>
            </form>

        </div>

    </div>
