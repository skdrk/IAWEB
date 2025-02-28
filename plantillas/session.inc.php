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
        $stmt = $mysqli->prepare("UPDATE usuarios set online = 1 WHERE login = ? ");
        $stmt->bind_param('s', $login);
        $stmt->execute();
        header ("Location: ./index.php");
        $_SESSION["rol"] = $user_data["rol"];
        $_SESSION["nombre"] = $user_data["nombre"]; 
        $_SESSION["apellidos"] = $user_data["apellidos"];
        $_SESSION["edad"] = $user_data["edad"];
        $_SESSION["ciudad"] = $user_data["localidad"];

        if (!isset($_COOKIE["contador"])) {
            setcookie("contador", 1);
        } else {
            setcookie("contador", $_COOKIE["contador"] + 1);
        }
    } else {
        echo "No se encontró el usuario o la contraseña es incorrecta.";
    }
    

}

function checkonline() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM usuarios WHERE online = 1");
    $stmt->execute();
    $result = $stmt->get_result();
    $usariosOnline = $result->fetch_all(MYSQLI_ASSOC);
    return $usariosOnline;
}


function defaultCategori() {
    if (!isset($_GET["categoria"])) {
        return $_GET["categoria"] = "Windows";
    }
}

function getCategorias() {
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("SELECT * FROM cat_subcat ORDER BY categoria");
    $stmt->execute();
    $result = $stmt->get_result();
    $categorias = $result->fetch_all(MYSQLI_ASSOC);
    return $categorias;
}

function getArtigos() {
    $mysqli = getConnection();
    if (isset($_GET["articulo"])) {
        $id = $_GET["articulo"];
        $stmt = $mysqli->prepare("SELECT * FROM artigo WHERE id = $id");
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM artigo");
    }
    $stmt->execute();
    $result = $stmt->get_result();
    $artigos = $result->fetch_all(MYSQLI_ASSOC);
    return $artigos;
}

function getFotos() {
    $mysqli = getConnection();
    if (isset($_GET["foto"])) {
        $id = $_GET["foto"];
        $stmt = $mysqli->prepare("SELECT * FROM imagenes where id = $id");
        $stmt->execute();
    } else {
        $stmt = $mysqli->prepare("SELECT * FROM imagenes");
        $stmt->execute();
    }
    $result = $stmt->get_result();
    $fotos = $result->fetch_all(MYSQLI_ASSOC);
    return $fotos;
}

function borrarFoto() {
    $mysqli = getConnection();
    if (isset($_GET["borrar"])) {
        $id = $_GET["foto"];
        $stmt = $mysqli->prepare("DELETE FROM imagenes WHERE id = $id");
        $stmt->execute();
        header ("Location: ./fotos.php");
    }
}
function editArtigos($artigos) {
    $mysqli = getConnection();
    if (isset($_GET["guardar"])){
        $id = $_GET["articulo"];
        $titulo = $_GET["titulo"];
        $contido = $_GET["contido"];
        $subcategoria = $_GET["subcategoria"];
        $stmt = $mysqli->prepare("UPDATE artigo SET titulo = ?, contido = ?, subcategoria = ? WHERE id = ?");
        $stmt->bind_param("ssss", $titulo, $contido, $subcategoria, $id);
        $stmt->execute();
        header ("Location: ./index.php?categoria=$subcategoria");
    }
}


function finalizarSesion() {
    $mysqli = getConnection();
    $login = $_SESSION["usuario"];
    $stmt = $mysqli->prepare("UPDATE usuarios set online = 0 WHERE login = ? ");
    $stmt->bind_param('s', $login);
    $stmt->execute();
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
    echo "<th></th>";
    echo "<th></th>";
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
        echo "<td><button value=editar><a href='./editarUser.php?user=" . $usuarios[$j]["id"] . "'>Editar</a></button></td>";
        echo "<td><button value=eliminar><a href='./eliminarUser.php?user=" . $usuarios[$j]["id"] . "'>Eliminar</a></button></td>";
        echo "</tr>";
    }
    echo "</table>";
    echo "</div>";
}

function crearNodo() {
    if (isset($_GET["titulo"])) {
        $titulo = $_GET["titulo"];
        $contido = $_GET["contido"];
        $subcategoria = $_GET["subcategoria"];
        $autor = $_SESSION["usuario"];
        $fecha = date('Y-m-d H:i:s');
        $mysqli = getConnection();
        $stmt = $mysqli->prepare("INSERT INTO artigo(titulo,autor,contido,data,subcategoria) VALUES ('$titulo', '$autor', '$contido', '$fecha', '$subcategoria')");
        $stmt->execute();
        header ("Location: ./index.php?categoria=$subcategoria");
    } else {
        return False;
    }
}

function borrarNodo() {
    if (isset($_GET["borrar"])) {
        $id = $_GET["articulo"];
        $mysqli = getConnection();
        $stmt = $mysqli->prepare("DELETE FROM artigo WHERE id = '$id'");
        $stmt->execute();
        return True;
    } else {
        return False;
    }
}

function crearCategoria() {
    if ($_GET["categoria"] != "") {
        $categoriaFinal = $_GET["categoria"];
    }else {
        $categoriaFinal = $_GET["categorias"];
    }
    $categoria = $_GET["categorias"];
    $subcategoria = $_GET["subcategoria"];
    $mysqli = getConnection();
    $stmt = $mysqli->prepare("INSERT INTO cat_subcat(categoria,subcategoria) VALUES ('$categoriaFinal','$subcategoria')");
    $stmt->execute();
    return True;
}
function eliminarUser() {
    $mysqli = getConnection();
    if (isset($_GET["user"]) && $_SESSION["rol"] == "admin") { 
        $id = $_GET['user'];
        $stmt = $mysqli->prepare("SELECT * FROM usuarios where id = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
    echo "<p>¿Estás seguro de que quieres borrar el usuario <strong>" . $usuarios[0]['nombre'] . "</strong>";
    echo "<form action='eliminarUser.php' method='GET'>
        <input type='hidden' name='user' value='" . $usuarios[0]['id'] . "'>
        <input type='hidden' name='borrar'>
        <input type='submit' value='Borrar'>
    </form>
    <form action='usuarios.php'>
        <input type='submit' value='Cancelar'>
    </form>";
    if (isset($_GET['borrar'])) {
        $id = $usuarios[0]['id'];
        $stmt = $mysqli->prepare("DELETE FROM usuarios where id = $id");
        $stmt->execute();
        header ("Location: ./usuarios.php");
    }
    if (isset($_GET[''])) {
        header ("Location: ./usuarios.php");
    }
    }
}

function editarUser() {
    $mysqli = getConnection();
    if (isset($_GET["user"]) && $_SESSION["rol"] == "admin") { 
        $id = $_GET['user'];
        $stmt = $mysqli->prepare("SELECT * FROM usuarios where id = $id");
        $stmt->execute();
        $result = $stmt->get_result();
        $usuarios = $result->fetch_all(MYSQLI_ASSOC);
        echo "<div class='tdiv'>";
        echo "<table class='tusers'>";
        echo "<tr>";
        echo "<th>NOMBRE</th>";
        echo "<th>APELLIDOS</th>";
        echo "<th>LOGIN</th>";
        echo "<th>EDAD</th>";
        echo "<th>LOCALIDAD</th>";
        echo "<th>ROL</th>";
        echo "</tr>";
        echo "<form action='editarUser.php' method='GET'>";
        echo "<tr>";
        echo "<input type='hidden' name='id' value='". $id ."' required></td>";
        echo "<td><input type='text' name='nombre' value='". $usuarios[0]["nombre"] ."'" . $usuarios[0]["nombre"] . " required></td>";
        echo "<td><input type='text' name='apellidos' value='". $usuarios[0]["apellidos"] ."'" . $usuarios[0]["apellidos"] . " required></td>";
        echo "<td><input type='text' name='login' value='". $usuarios[0]["login"] ."'" . $usuarios[0]["login"] . " required></td>";
        echo "<td><input type='text' name='edad' value='". $usuarios[0]["edad"] ."'" . $usuarios[0]["edad"] . " required></td>";
        echo "<td><input type='text' name='localidad' value='". $usuarios[0]["localidad"] ."'" . $usuarios[0]["localidad"] . " required></td>";
        echo "<td><input type='text' name='rol' value='". $usuarios[0]["rol"] ."'" . $usuarios[0]["rol"] . " required></td>";
        echo "</tr>";
        echo "</table>";
        echo "<input type='submit'>";
        echo "</form>";
        echo "</div>";
}
    if (isset($_GET['login'])) {
        $id = $_GET["id"];
        $nombre = $_GET["nombre"];
        $apellidos = $_GET["apellidos"];
        $login = $_GET["login"];
        $edad = $_GET["edad"];
        $localidad = $_GET["localidad"];
        $rol = $_GET["rol"];
        $stmt = $mysqli->prepare("UPDATE usuarios SET nombre = ?, apellidos = ?, login = ?, edad = ?, localidad = ?, rol = ? WHERE id = ?");
        $stmt->bind_param("ssssssi", $nombre, $apellidos, $login, $edad, $localidad, $rol, $id);
        $stmt->execute();
        header ("Location: ./usuarios.php");
    }

}