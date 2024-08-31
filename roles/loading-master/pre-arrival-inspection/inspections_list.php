<?php
    include "../../../components/database.php";

    session_start();
    
    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 1) {
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
    <title>Lista de inspecciones pre-arribo</title>
    <link rel="stylesheet" href="../../../assets/css/forms/pre-arrival-inspection/inspections-list.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/pre_arrival_inspection_menu.php"; ?>

    <div class="content" id="content">
        <h1>Lista de Inspecciones Pre-Arribo guardadas</h1>

        <div class="table-container">
            <table class="list-table">
                <tr>
                    <th>#</th>
                    <th>Buque</th>
                    <th>Operación</th>
                    <th>Producto a transferir</th>
                    <th>Fecha y hora de inicio</th>
                    <th>Acciones</th>
                </tr>

                <?php
                    $query = "SELECT id_buque, buque, operacion, prod_transferir, DATE_FORMAT(fecha_hora_inicio, '%d/%m/%y %H:%i') AS fecha_hora_inicio FROM ins_pre_detalles;";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        while ($row = $result->fetch_array()) {
                            $id_buque = $row['id_buque'];
                            $buque = $row['buque'];
                            $operacion = $row['operacion'];
                            $prod_transferir = $row['prod_transferir'];
                            $fecha_hora_inicio = $row['fecha_hora_inicio'];
                ?>
                
                <tr>
                    <td><?php echo $id_buque; ?></td>
                    <td><?php echo $buque; ?></td>
                    <td><?php echo $operacion; ?></td>
                    <td><?php echo $prod_transferir; ?></td>
                    <td><?php echo $fecha_hora_inicio; ?></td>

                    <td>
                        <form action="finished_form.php" method="POST">
                            <input type="hidden" name="id_buque" value="<?php echo $id_buque; ?>" readonly>
                            <input type="submit" class="show" value="Mostrar">
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