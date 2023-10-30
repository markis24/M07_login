<?php
// Inicia o reanuda una sesión existente
session_start();

// Verifica el rol del usuario en la sesión
if ($_SESSION["rol"] == 'alumnat') {
    // Usuario con rol "alumnat"
    echo "<h2>" . " Hola " . $_SESSION["name"] . ", eres un alumno" . "</h2>";
    ?>
    <a href="mostrarUsuario.php?user_id=<?php echo $_SESSION["user_id"];?>">Mostrar información</a>
    <a href="desconectar.php">Desconectar</a><br>
    <?php
} elseif ($_SESSION["rol"] == 'professorat') {
    // Usuario con rol "professorat"
    echo "<h2>" . " Hola " . $_SESSION["name"] . ", eres un profesor" . "</h2>";
    ?>
    <a href="mostrarUsuario.php?user_id=<?php echo $_SESSION["user_id"]?>">Mostrar información</a>
    <a href="desconectar.php">Desconectar</a>
    <br>
    <br>
    <?php
    echo '<table>
        <tr>
            <th>Nombre</th>
            <th>Apellidos</th>
            <th>Email</th>
        </tr>';
    include("dbConfig.php");
    // Establece una conexión con la base de datos utilizando las constantes definidas
    $connect = mysqli_connect(DB_HOST, DB_USER, DB_PSW, DB_NAME, DB_PORT);

    // Comprueba si la conexión a la base de datos fue exitosa
    if (!$connect) {
        throw new Exception("Error de conexión: " . mysqli_connect_error());
    } else {
        // Consulta para seleccionar todos los usuarios de la tabla "user"
        $query = "SELECT * FROM user";
        $resultado_usuarios = mysqli_query($connect, $query);

        // Recorre los resultados y muestra los datos en una tabla
        foreach ($resultado_usuarios as $usuario) {
            echo '<tr>
                <td>' . $usuario['name'] . '</td>
                <td>' . $usuario['surname'] . '</td>
                <td>' . $usuario['email'] . '</td>
            </tr>';
        }
        echo '</table>';
    }
}
?>
