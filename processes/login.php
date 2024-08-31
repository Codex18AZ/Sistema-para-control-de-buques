<?php
    include "../components/database.php";

    if (empty($_POST['correo']) || empty($_POST['clave'])) {
        header('Location: ../signin.php?error=login_error');
        exit();
    } else {
        // Variables de usuario y contraseña
        $correo = $_POST['correo'];
        $clave = $_POST['clave'];

        // Revisa si existe el usuario
        $query = "SELECT correo, clave, tipo_usuario, acceso FROM usuario WHERE correo = ?;";
        $stat = $connection->prepare($query);
        $stat->bind_param('s', $correo);
        $stat->execute();
        $result = $stat->get_result();

        while ($row = $result->fetch_assoc()) {
            $reg_correo = $row["correo"];
            $reg_clave = $row["clave"];
            $tipo_usuario = $row["tipo_usuario"];
            $acceso = $row["acceso"];
        }
    
        // Si no existe el usuario, o la contraseña no coincide
        if ($result->num_rows == 0 || !password_verify($clave, $reg_clave)) {
            header('Location: ../signin.php?error=login_error');
            exit();
        } else {
            // Si el usuario no posee acceso a la página
            if ($acceso == 0) {
                header('Location: ../signin.php?error=session_error');
                exit();
            } else {
                session_start();
                $_SESSION['correo'] = $correo;
                $_SESSION['tipo_usuario'] = $tipo_usuario;
                
                switch ($_SESSION['tipo_usuario']) {
                    case 1:
                        header('Location: ../roles/loading-master/menu.php');
                        exit();
                        break;
                    case 2:
                        header('Location: ../roles/land-inspector/menu.php');
                        exit();
                        break;
                    case 3:
                        header('Location: ../roles/administrator/menu.php');
                        exit();
                        break;
                    default:
                        header('Location: ../signin.php?error=session_error');
                        exit();
                }
            }
        }
    }
?>