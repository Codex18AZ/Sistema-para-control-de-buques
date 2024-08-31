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
    <title>Nueva Ship Shore Safety Check List</title>
    <link rel="stylesheet" href="../../../assets/css/forms/transferring-summary/new-transferring-summary.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/safety_list_menu.php"; ?>

    <div class="content" id="content">
        <h1>Nueva Ship Shore Safety Check List</h1>
    <!-- codigo de prueba inicio -->
    <div class="content" id="content">
        <p class="sentence">Crear nuevo formulario:</p>
        <div class="table-container">
            <form action="new_form.php" method="POST">
                <input type="hidden" name="id_term_buque" value="<?php $numero_aleatorio = rand(10000, 299000000); echo $numero_aleatorio;?>" readonly="">
                <input type="hidden" name="buque" value='Buque de prueba' readonly="">
                <input type="submit" class="show" value="Nuevo">
            </form>
            <br>
        </div>
    <!-- codigo de prueba fin -->
        <p class="sentence">Seleccione el resumen de transferencia al que pertenecerá la nueva Ship Shore Safety Check List:</p>

        <div class="table-container">
            <table class="list-table">
                <tr>
                    <th>N° de operación</th>
                    <th>Buque</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>

                <?php
                    $query = "SELECT A.id_term_buque, A.buque, DATE_FORMAT(A.fecha_trans, '%d/%m/%y') AS fecha_trans FROM res_trans_buque  A LEFT JOIN safety_list_buque B ON A.id_term_buque = B.id_term_buque WHERE B.id_safety_buque IS NULL and A.finalizado = 1;";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        while ($row = $result->fetch_array()) {
                            $id_term_buque = $row['id_term_buque'];
                            $buque = $row['buque'];
                            $fecha = $row['fecha_trans'];
                ?>
                
                <tr>
                    <td><?php echo $id_term_buque; ?></td>
                    <td><?php echo $buque; ?></td>
                    <td><?php echo $fecha; ?></td>

                    <td>
                        <form action="new_form.php" method="POST">
                            <input type="hidden" name="id_term_buque" value="<?php echo $id_term_buque; ?>" readonly>
                            <input type="hidden" name="buque" value="<?php echo $buque; ?>" readonly>
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