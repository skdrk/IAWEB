<?php 
    session_start();
    require_once("./plantillas/plantillas.inc.php");
    require_once("./plantillas/session.inc.php");

    if (isset($_POST["user"]) && isset($_POST["password"])) {
        $_SESSION["usuario"] = $_POST["user"];
        $_SESSION["contraseña"] = $_POST["password"];
        iniciarSesion();
    }
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
	<style>
        div label {
            width: 15%;
            float: left;
        }

        form {
            margin: 20px 0;
        }
        .login {
            margin-left: 245px;
            margin-top: 5px;
        }

    </style>
</head>

<body>

<!-- Contenedor -->
<div id="contenedor">
    <?php cabecera(); ?>
    <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <label for="user">Nombre de usuario: </label>
        <input type="text" id="user" name="user"/></br>
        <label for="password">Contraseña: </label>
        <input type="password" id="password" name="password"/></br>
        <div class="login">
        <input type="submit" value="Login"/>
        </div>
    </form>
    <?php pe(); ?>
    
</div> <!-- /contenedor -->

</body>
</html>
