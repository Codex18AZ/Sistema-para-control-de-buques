<?php
    include "../../components/database.php";

    session_start();
        
    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 3) {
        header('Location: ../../signin.php');
        exit();
    } else {
        $correo = $_SESSION['correo'];
        
        $query = "SELECT nombres, apellidos FROM usuario WHERE correo = '$correo';";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nombres = explode(" ", $row["nombres"]);
            $apellidos = explode(" ", $row["apellidos"]);

            $nombre = $nombres[0];
            $apellido = $apellidos[0];
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú del Administrador General</title>
    <link rel="stylesheet" href="../../assets/css/menus.css">
    <link rel="icon" href="../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../../components/login_menu.php"; ?>

    <div class="content">
        <h2 class="role-title">Menú del Administrador General</h2>
        <div class="role-options">
            <a href="../../lists/operations_list.php">
                <table class="role-option">
                    <tr class="option-image">
                        <td><img src="../../assets/img/formulario.png" alt="Formulario"></td>
                    </tr>
                    <tr class="option-text">
                        <td>Lista de operaciones</td>
                    </tr>
                </table>
            </a>
            <a href="../../lists/users_list.php">
                <table class="role-option">
                    <tr class="option-image">
                        <td><img src="../../assets/img/formulario.png" alt="Formulario"></td>
                    </tr>
                    <tr class="option-text">
                        <td>Lista de accesos de usuario</td>
                    </tr>
                </table>
            </a>
            <a href="../../lists/reports_list.php">
                <table class="role-option">
                    <tr class="option-image">
                        <td><img src="../../assets/img/formulario.png" alt="Formulario"></td>
                    </tr>
                    <tr class="option-text">
                        <td>Lista de reportes</td>
                    </tr>
                </table>
            </a>
        </div>
    </div>
</body>

</html>