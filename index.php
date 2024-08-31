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
    <title>Oiltanking</title>
    <link rel="stylesheet" href="assets/css/general.css">
    <link rel="icon" href="assets/img/favicon.ico">
</head>

<body>
    <?php include_once "components/logout_menu.php"; ?>

    <div class="content">
        <div class="option">
            <h3>Portada</h3>
            <p>Todas las cuentas tienen nuevos formularios y funcionalidades</p><br>
            <p>CUENTA: loandingmaster CONTRASEÑA: 123456789</p>
            <p>CUENTA: landinspector CONTRASEÑA: 123456789</p>
            <p>CUENTA: administrator CONTRASEÑA: 123456789</p>
        </div>
        
    </div>
</body>

</html>