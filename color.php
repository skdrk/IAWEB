<?php 
    session_start();
    
    if (isset($_GET["color"])) {
        $_SESSION["color"] = $_GET["color"] ;
    }
?>

<html>
    <head> 
        <title>Colores</title>
    </head>
    <body>
        <form method="get">
            <label for="color"> Elige un color: </label>
            <select name="color" id="color">
                <option value="rojo" selected>Rojo</option>
                <option value="verde">Verde</option>
                <option value="azul">Azul</option>
                <option value="amarillo">Amarillo</option>
            </select>
        </br>
            <input type="submit" value="Guardar Datos"/>
        </form>
        <a href="test/test1.php">Ir a la pagina 1</a>
    </br>
        <a href="test/test2.php">Ir a la pagina 2</a>
        <?php if(isset($_SESSION["color"])) {
            echo "<p>" . $_SESSION['color'] . "</p>"; }
            ?>
    </body>
</html>