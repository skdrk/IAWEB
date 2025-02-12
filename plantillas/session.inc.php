<?php

function iniciarSesion() {
    require_once("./plantillas/conexion.php");
    
    $login = $_SESSION["usuario"];
    $password = $_SESSION["contraseña"];

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


/*

    $login = [
        "usuario" => ["admin", "usr01"], 
        "contraseña" => ["1234", "qwerty"]
    ];

    $usuario = [
        ["admin" => "1234"],
        ["usr01" => "qwerty"]
    ];
    
    $userok = FALSE;
    foreach ($login["usuario"] as $key => $user) {
        if ($_SESSION["usuario"] == $user) {
            
            if ($login["contraseña"][$key] == $_SESSION["contraseña"]) {
                $userok = TRUE;
                if ($user == "admin") {
                $_SESSION["nombreReal"] = "Borja";
                $_SESSION["apellidos"] = "Fernandez Veloso";
                $_SESSION["edad"] = "25";
                $_SESSION["ciudad"] = "Ourense";
                break;
            }
            if ($login["contraseña"][$key] == $_SESSION["contraseña"]) {
                $userok = TRUE;
                if ($user == "usr01") {
                $_SESSION["nombreReal"] = "Chema";
                $_SESSION["apellidos"] = "Gonzaled Fariñas";
                $_SESSION["edad"] = "25";
                $_SESSION["ciudad"] = "Ourense";
                break;
                }
            }    
        }
    }
*/

?>