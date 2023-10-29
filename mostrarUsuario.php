<?php
// Obtener el ID de usuario desde la consulta GET
$user_id = $_GET["user_id"];

// Incluir el archivo de configuración de la base de datos
include "dbConfig.php";

try {
    // Intentar establecer una conexión a la base de datos
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    // Comprobar si la conexión a la base de datos fue exitosa
    if ($connect) {
        // Crear una consulta SQL para seleccionar un usuario con el ID proporcionado
        $query = "SELECT * FROM `user` WHERE user_id = '$user_id'";
        $resultado = mysqli_query($connect, $query);
    }

    if ($resultado) {
        // Obtener los datos del usuario y mostrarlos
        $user = mysqli_fetch_array($resultado);
        echo "<h2> Información detallada del usuario</h2>";
        echo "Id usuario: " . $user['user_id'] . "<br>";
        echo "Nombre: " . $user['name'] . "<br>";
        echo "Apellidos: " . $user['surname'] . "<br>";
        echo "Email: " . $user['email'] . "<br>";
        echo "Rol: " . $user['rol'] . "<br>";
        
        // Comprobar si la casilla "active" fue marcada en el formulario
        if (isset($user['active'])) {
            $active = "Si";
        } else {
            $active = "No";
        }
        echo "Activo: " . $active . "<br>";
    }
} catch (Exception $ex) {
    // Capturar excepciones y mostrar un mensaje de error personalizado en caso de que ocurra un error
    echo "Error: " . $ex->getMessage();
}
?>
<br>
<a href="login.html">Volver</a>
