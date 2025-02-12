<?php 
    require_once("./plantillas/plantillas.inc.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
    <!-- Este deseño baséase nun deseño web libre chamado CrystalX e que se pode descargar desde
         a dirección http://www.oswd.org/design/preview/id/3465 -->
    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
    <meta http-equiv="content-language" content="es" />

    <meta name="copyright" content="Design/Code: Vit Dlouhy [Nuvio - www.nuvio.cz]; e-mail: vit.dlouhy@nuvio.cz" />
    
    <title>O meu sitio web</title>
    <meta name="description" content="O meu sitio web" />
    <meta name="keywords" content="sitio, web" />
    
    <link rel="shortcut icon" href="imaxes/Icono.ico"/>
    <link rel="index" href="/" title="Inicio" />
    <link rel="stylesheet" media="screen,projection" type="text/css" href="exercicio.css" />
	
</head>

<body>

<!-- Contenedor -->
<div id="contenedor"> 
    <?php cabecera(); ?>
    <?php menuPrincipal(); ?>
    <form action="contacto.php" method="POST">
    <div>
        <div>
            <p>Tipo de comunicación:</p>
                <input id="informacion" type="radio" name="menu" value="in"/>
                <label for="informacion">Informacion</label></br>
                <input id="denuncia" type="radio" name="menu" value="de"/>
                <label for="denuncia">Denuncia</label></br>
                <input id="reclamacion" type="radio" name="menu" value="re"/>
                <label for="reclamacion">Reclamacion</label></br>

        </div>
        <div>
            <fieldset>
                <legend>Contacto</legend>
                <?php if (isset($_POST['condiciones']) && ($_POST['telf'] == NULL && $_POST['email'] == NULL)) {
                    echo '<p style="color: red;">Debe introducir por lo menos uno de los campos</p>';
                }?>
                <labelfor="telf">Telefono</label>
                <input style="margin-left: 2.8%; margin-bottom: 0.5%;" type="tel" id="telf" name="telf"/></br>
                <label for="mail">Email</label>
                <input  style="margin-left: 5%;" type="mail" id="mail" name="email"/>
            </fieldset>
        </div>

        <div>
            <p>Mensaje:</p>
            <textarea id="texto" name="mensaje" rows="10" cols="102" placeholder="Introduce aquí tu mensaje"></textarea>
        </div>
        <div>
            <input type="checkbox" id="check" name="condiciones" value="accepto" required/>
            <label for="check">Acepto las condiciones de politica de privacidad</label>
            <br><input type="submit"/>
        </div>
        </form>
    </div>
    <div>
        <?php foreach ($_POST as $key => $name) {
            echo "$key => $name <br>";
        }
        ?>
    <div>
    <?php pe(); ?>
    
</div> <!-- /contenedor -->

</body>
</html>
