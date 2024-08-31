<?php
    include "../../../components/database.php";

    session_start();
    
    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 2) {
        header('Location: ../../../signin.php');
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
    <title>Lista de datos de transferencia finalizados</title>
    <link rel="stylesheet" href="../../../assets/css/forms/transferring-summary/new-transferring-summary.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/transferring_data_menu.php"; ?>

    <div class="content" id="content">
        <h1>Lista de Datos de Transferencia finalizados</h1>

        <div class="table-container">
            <table class="list-table">
                <tr>
                    <th>N° de operación</th>
                    <th>Mes</th>
                    <th>Año</th>
                    <th>Acciones</th>
                </tr>

                <?php
                    $query = "SELECT id_data_trans, mes, año FROM data_trans_buque WHERE finalizado = 1;";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        while ($row = $result->fetch_array()) {
                            $id_data_trans = $row['id_data_trans'];
                            $mes = $row['mes'];
                            $año = $row['año'];
                ?>
                
                <tr>
                    <td><?php echo $id_data_trans; ?></td>
                    <td><?php echo $mes; ?></td>
                    <td><?php echo $año; ?></td>

                    <td>
                        <form action="finished_form.php" method="POST">
                            <input type="hidden" name="id_data_trans" value="<?php echo $id_data_trans; ?>" readonly>
                            <input type="submit" class="show" value="Seleccionar">
                        </form>
                    </td>
                </tr>
            
                <?php
                        }
                    }
                ?>
            </table>
        </div>
    </div>

    <script src="../../../assets/js/general.js"></script>
</body>

</html>