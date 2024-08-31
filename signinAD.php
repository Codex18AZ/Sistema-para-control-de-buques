<?php
    session_start();
        
    if (isset($_SESSION['correoAD'])) {
        // Loading Master
        if ($_SESSION['departamento'] == "departamento1" && $_SESSION['oficina1']) {
            header('Location: roles/loading-master/menu.php');
            exit();
        }
        
        // Supervisor de Tierra
        if ($_SESSION['departamento'] == "departamento2" && $_SESSION['oficina2']) {
            header('Location: roles/land-inspector/menu.php');
            exit();
        }

        // Administrador
        if ($_SESSION['departamento'] == "departamento3" && $_SESSION['oficina3']) {
            header('Location: roles/administrator/menu.php');
            exit();
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
    <link rel="stylesheet" href="assets/css/signin.png">
    <link rel="icon" href="assets/img/favicon.ico">
</head>

<body>
    <nav class="menu">
        <a href="index.php" class="logo">
            <img src="assets/img/logo.svg" alt="Logo de Oiltanking">
        </a>
    </nav>

    <div class="content">
        <h2>Bienvenido</h2>

        <?php if ($_GET) { ?>
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
            <p class="sentence">Por favor, ingrese sus credenciales de Active Directory para continuar:</p>
            <form action="processes/loginAD.php" method="POST">
                <div class="field">
                    <label for="usuario">Usuario:</label>
                    <input type="text" name="usuario" id="usuario" required>
                </div>
                <div class="field">
                    <label for="clave">Contraseña:</label>
                    <input type="password" name="clave" id="clave" required>
                </div>
                <div class="field">
                    <label for="dominio">Dominio:</label>
                    <input type="text" name="dominio" id="dominio" required>
                </div>
                <div class="field">
                    <label for="oficina">Oficina:</label>
                    <input type="text" name="oficina" id="oficina" required>
                </div>
                <div class="field">
                    <label for="departamento">Departamento:</label>
                    <input type="text" name="departamento" id="departamento" required>
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