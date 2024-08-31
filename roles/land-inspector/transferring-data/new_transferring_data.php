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
    <title>Nuevos datos de transferencia</title>
    <link rel="stylesheet" href="../../../assets/css/forms/transferring-summary/new-transferring-summary.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/transferring_data_menu.php"; ?>

    <div class="content" id="content">
        <h1>Nuevos Datos de Transferencia</h1>
        <!-- codigo de prueba inicio -->
    <div class="content" id="content">
        <p class="sentence">Crear nuevo formulario:</p>
        <div class="table-container">
            <form action="new_form.php" method="POST">
                <input type="hidden" name="id_buque" value="<?php $numero_aleatorio = rand(10000, 299000000); echo $numero_aleatorio;?>" readonly="">
                <input type="hidden" name="tanker" value='Buque de prueba' readonly="">
                <input type="submit" class="show" value="Nuevo">
            </form>
            <br>
        </div>
    <!-- codigo de prueba fin -->
        <p class="sentence">Seleccione la inspección pre-arribo a la que pertenecerá el nuevo formulario de "Datos de transferencia":</p>

        <div class="table-container">
            <table class="list-table">
                <tr>
                    <th>N° de operación</th>
                    <th>Buque</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>

                <?php
                    $query = "SELECT A.id_buque, A.buque, DATE_FORMAT(A.fecha_hora_inicio, '%d/%m/%y') AS fecha FROM ins_pre_detalles A LEFT JOIN data_trans_buque B ON A.id_buque = B.id_buque WHERE B.id_buque IS NULL AND A.id_buque IS NOT NULL;";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        while ($row = $result->fetch_array()) {
                            $id_buque = $row['id_buque'];
                            $buque = $row['buque'];
                            $fecha = $row['fecha'];
                ?>
                
                <tr>
                    <td><?php echo $id_buque; ?></td>
                    <td><?php echo $buque; ?></td>
                    <td><?php echo $fecha; ?></td>

                    <td>
                        <form action="new_form.php" method="POST">
                            <input type="hidden" name="id_buque" value="<?php echo $id_buque; ?>" readonly>
                            <input type="hidden" name="tanker" value="<?php echo $tanker; ?>" readonly>
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