<?php 
function cabecera(){ ?>
<!-- Cabecera -->
<div id="cabecera">

<!-- Logo -->
<h1 id="logo"><a href="index.php" title="Mi sitio web">O meu sitio web</a></h1>

<!-- Buscador -->
<div id="buscador">
    <form action="" method="get">
        <fieldset>
            <legend>Buscador</legend>
            <input type="text" name="busqueda" size="30" />
            <input type="submit" name="botonbuscar" value="Buscar" />
        </fieldset>
    </form>
</div> <!-- /buscador -->

<div class="clear"></div>
</div> <!-- /cabecera -->

<?php defaultCategori(); } ?>

<?php 
function menuPrincipal(){ ?>
<!-- Menú principal -->
<div id="menu">
    <ul>
        <li><a href="index.php">Inicio</a></li>
        <li class="seleccionado"><a href="#">Blog</a></li>
        <li><a href="./login.php">Sobre min</a></li>
        <li><a href="#">Fotos</a></li>
        <li><a href="contacto.php">Contacto</a></li>
        <li><a href="#">Enlaces</a></li>
        <?php if ($_SESSION["rol"]=="admin"){?>
            <li><a href="usuarios.php">Usuarios</a></li>
        <?php }?>
        <li><a href="salir.php">Salir</a></li>
    </ul>

<div class="clear"></div>
</div> <!-- /menú principal -->
<?php } ?>
<?php 
function contido(){ ?>
<!-- Contenido -->
<div id="contenido">

<!-- Principal -->
<div id="principal">

    <!-- Articulo -->
    <?php 
        $artigos = getArtigos();
        echo '<div class="articulo">';
        foreach ($artigos as $x=>$artigo) {
            if ($_GET["categoria"] == $artigos[$x]["subcategoria"]) {
                echo "</p>";
                echo '<h2><a href="#">' . $artigos[$x]["titulo"] . '</a></h2>';
                echo '<p class="info">';
                echo '<span class="fecha">' . $artigos[$x]["data"] . '</span>';
                echo '<span class="categoria"><a href="#">deseño</a></span>';
                if (isset($_GET["categoria"])) {
                    echo "<span class='categoria'><a href=" . "index.php?categoria=" . $artigos[$x]["subcategoria"] . ">Categoria " . $artigos[$x]["subcategoria"] . "</span></a>";
                }
                echo "<p>" . $artigos[$x]["contido"]. "</p>";
            }
        }
        echo '</div> <!-- /articulo -->'
    ?>

    <div class="clear"></div>
    
   

</div><!-- /principal -->

<!-- Secundario -->
<div id="secundario">

        <!-- Sobre mi -->
        <h3><a href="./login.php">Sobre min</a></h3>

        <div id="sobremi">
            <img src="imaxes/mifoto.gif" alt="Mi foto" />
            <p><strong><?= $_SESSION["nombre"] . " " . $_SESSION["apellidos"]; ?></strong><br />
            <?= $_SESSION["edad"]; ?><br />
            <?= $_SESSION["ciudad"]; ?><br />
            <a href="#">O meu perfil público</a></p>
        </div> <!-- /sobre mi -->

        <div class="clear"></div>
        <!-- Categorías -->
         <?php
               $categorias = getCategorias();
               foreach ($categorias as $i=>$categoria) {
                    if ($i == 0 or $categorias[$i]["categoria"] !=  $categorias[$i - 1]["categoria"] ){
                        echo "</ul>";
                        echo "<h3>". $categorias[$i]["categoria"] . "</h3>";
                        echo "<ul id='categorias'>";
                    }
                    echo "<li ";
                    if (isset($_GET['categoria']) &&  $_GET['categoria'] == $categorias[$i]["subcategoria"]) { echo ' class="seleccionado"'; }
                    echo "><a href='index.php?categoria=" . $categorias[$i]["subcategoria"]  . "'>" . $categorias[$i]["subcategoria"] . "</a></li>";
                }
           ?>

        <!-- Archivo -->
        <h3>Arquivo</h3>

        <ul id="archivo">
            <li class="seleccionado"><a href="#">Xaneiro 201X</a></li>
            <li><a href="#">Decembro 201X</a></li>
            <li><a href="#">Novembro 201X</a></li>
            <li><a href="#">Outubro 201X</a></li>
            <li><a href="#">Setembro 201X</a></li>
        </ul>

        <div class="clear"></div>

        <!-- Enlaces -->
        <h3>Enlaces</h3>

        <ul id="enlaces">
            <li><a href="#">Enlace 1</a></li>
            <li><a href="#">Enlace 2</a></li>
            <li><a href="#">Enlace 3</a></li>
            <li><a href="#">Enlace 4</a></li>
            <li><a href="#">Enlace 5</a></li>
        </ul>

        <div class="clear"></div>

</div> <!-- /secundario -->

<div class="clear"></div>
</div> <!-- /contenido -->
<?php } ?>

<?php 
function pe(){ ?>
<!-- Pie de página -->
<div id="pie">
<p id="copyright">&copy; 201X Nome da empresa</p>
</div> <!-- /pie de página -->
<?php } ?>