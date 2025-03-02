<?php 
    session_start();
    require_once("./plantillas/plantillas.inc.php");
    require_once("./plantillas/session.inc.php");
    comprobarUsuario();
    headPagina();    
?>

<body>

<!-- Contenedor -->
<div id="contenedor">
    <?php cabecera(); ?>
    <?php menuPrincipal(); ?>
    <?php $foto = editarFoto(); ?>
    <div>
            <h1>Editando artícul <strong> <?php echo $foto[0]["titulo"];?></strong></h1>
            <form action="editarFoto.php" method='GET'>
                <input type="hidden" name="foto" value="<?php echo $foto[0]["id"] ; ?>">
                <label for="titulo">Titulo: </label>
                <input type="text" id="titulo" name="titulo" value="<?php echo $foto[0]["titulo"] ?>"></br></br>
                <label for="contido">Contido: </label>
                <textarea id="contido" name="descripcion" rows="10" cols="102"><?php echo $foto[0]["descripcion"];?></textarea>
                </br>
                </br>
                <input type="submit" name="guardar" value="Guardar">
            </form>
        </div>
    <?php pe(); ?>
    
</div> <!-- /contenedor -->

</body>
</html>