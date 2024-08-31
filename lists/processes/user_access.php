<?php
    include "../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 3) {
        header('Location: ../../signin.php');
        exit();
    } else {
        if (empty($_POST['id_usuario'])) {
            header('Location: ../users_list.php');
            exit();
        } else {
            // Variable de usuario
            $id_usuario = $_POST['id_usuario'];
    
            // Revisa si existe el usuario
            $query = "SELECT id_usuario, acceso FROM usuario WHERE id_usuario = ?;";
            $stat = $connection->prepare($query);
            $stat->bind_param('i', $id_usuario);
            $stat->execute();
            $result = $stat->get_result();
    
            while ($row = $result->fetch_assoc()) {
                $id_usuario = $row["id_usuario"];
                $acceso = $row["acceso"];
            }
    
            // Si no existe el usuario
            if ($result->num_rows == 0) {
                header('Location: ../users_list.php?list_error=user_not_found');
                exit();
            } else {
                if ($acceso == 1) {
                    $acceso = 0;
                } else {
                    $acceso = 1;
                }
    
                $query = "UPDATE usuario SET acceso = ? WHERE id_usuario = ?;";
                $stat = $connection->prepare($query);
                $stat->bind_param('ii', $acceso, $id_usuario);
                
                if (!$stat->execute()) {
                    header('Location: ../users_list.php?list_error=access_not_changed');
                    exit();
                } else {
                    header('Location: ../users_list.php?list_success=access_changed');
                    exit();
                }
            }
        }
    }
?>