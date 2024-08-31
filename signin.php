<?php
    session_start();
        
    if (isset($_SESSION['correo'])) {
        switch ($_SESSION['tipo_usuario']) {
            case 1:
                header('Location: roles/loading-master/menu.php');
                exit();
                break;
            case 2:
                header('Location: roles/land-inspector/menu.php');
                exit();
                break;
            case 3:
                header('Location: roles/administrator/menu.php');
                exit();
                break;
            default:
                break;
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="assets/css/signin.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>

<body>
    <nav class="menu">
        <a href="index.php" class="logo">
            <img src="assets/img/logo.png" alt="Logo de Oiltanking">
        </a>
    </nav>

    <div class="content">
        <h2>Bienvenido</h2>

        <?php if (isset($_GET['error'])) { ?>
        <p class="error-text">
            <span class="error">
                <?php include_once "components/messages/error_messages.php"; ?>
            </span>
        </p>
        <?php } ?>


        <div id="timer">
            <p class="sentence">
                Puede iniciar sesión cuando el temporizador llegue a cero: <span id="segundos">--</span>
            </p>
        </div>
        
        <div class="login" id="login">
            <p class="sentence">Por favor, ingrese su usuario y contraseña para continuar:</p>
            <form action="processes/login.php" method="POST">
                <div class="field">
                    <label for="correo">Usuario:</label>
                    <input type="text" name="correo" id="correo" required>
                </div>
                <div class="field">
                    <label for="clave">Contraseña:</label>
                    <input type="password" name="clave" id="clave" required>
                </div>
                <div class="buttons">
                    <a href="index.php" class="return">Volver</a>
                    <input type="submit" value="Acceder" class="submit">
                </div>
            </form>
        </div>
    </div>

    <script src="assets/js/timer.js"></script>
</body>

</html>