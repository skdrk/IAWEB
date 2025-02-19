<?php
    require_once("./plantillas/conexion.php");
function iniciarSesion() {
  
    $login = $_SESSION["usuario"];
    $password = $_SESSION["contraseña"];
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE login = ? and password = ?");
    $stmt->bind_param('ss', $login, $password);
    $stmt->execute();
    $result = $stmt->get_result();
    $user_data = $result->fetch_assoc();

    if ($user_data) {
        header ("Location: ./index.php");
        echo "Usuario: " . $user_login . " Contraseña: " . $user_password;
        $_SESSION["rol"] = $user_data["rol"];
        $_SESSION["nombre"] = $user_data["nombre"]; 
        $_SESSION["apellidos"] = $user_data["apellidos"];
        $_SESSION["edad"] = $user_data["edad"];
        $_SESSION["ciudad"] = $user_data["localidad"];
    } else {
        echo "No se encontró el usuario o la contraseña es incorrecta.";
    }
    

}


function defaultCategori() {
    if (!isset($_GET["categoria"])) {
        return $_GET["categoria"] = "Windows";
    }
}

function getCategorias() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM cat_subcat");
    $stmt->execute();
    $result = $stmt->get_result();
    $categorias = $result->fetch_all(MYSQLI_ASSOC);
    return $categorias;
}

function getArtigos() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM artigo");
    $stmt->execute();
    $result = $stmt->get_result();
    $artigos = $result->fetch_all(MYSQLI_ASSOC);
    return $artigos;
}



function finalizarSesion() {
    //Destruir todas las variables de sesión.
    $_SESSION = array();
    //Si se desea destruir la sesión completamente, borrar la cookie de sesión.
    //Nota: ¡Esto destruirá la sesión, y no la información de la sesión!
    if (INI_get("session.use_cookies")) {
    $params = session_get_cookie_params();
    setcookie(session_name(), '', time() - 42000,
    $params["path"], $params["domain"],
    $params["secure"], $params["httponly"]
    );
 }
 // Finalmente, destruir la sesión.
 session_destroy();
}
function comprobarUsuario() {
    if (!isset($_SESSION["usuario"])) {
        header ("Location: ./login.php");
        die();
    }

}


function tablaUsers() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM usuarios");
    $stmt->execute();
    $result = $stmt->get_result();
    $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    echo "<div class='tdiv'>";
    echo "<table class='tusers'>";
    echo "<tr>";
    echo "<th>ID</th>";
    echo "<th>NOMBRE</th>";
    echo "<th>APELLIDOS</th>";
    echo "<th>LOGIN</th>";
    echo "<th>EDAD</th>";
    echo "<th>LOCALIDAD</th>";
    echo "<th>ROL</th>";
    echo "</tr>";
    for ($j = 0; $j < count($usuarios); $j++) {
        echo "<tr>";
        echo "<td>" . $usuarios[$j]["id"] . "</td>";
        echo "<td>" . $usuarios[$j]["nombre"] . "</td>";
        echo "<td>" . $usuarios[$j]["apellidos"] . "</td>";
        echo "<td>" . $usuarios[$j]["login"] . "</td>";
        echo "<td>" . $usuarios[$j]["edad"] . "</td>";
        echo "<td>" . $usuarios[$j]["localidad"] . "</td>";
        echo "<td>" . $usuarios[$j]["rol"] . "</td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}