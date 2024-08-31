<?php
    include "../../../components/database.php";
    include "../../../components/regular_expressions.php";

    session_start();

    if (!isset($_SESSION['correo'])) {
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

    if (!isset($_POST['id_buque'])) {
        header('Location: inspections_list.php');
        exit();
    } else {
        $id_buque = $_POST['id_buque'];

        $query = "SELECT buque, lugar, terminal, operacion, prod_transferir, DATE_FORMAT(fecha_hora_inicio, '%d/%m/%y %H:%i') AS fecha_hora_inicio FROM ins_pre_detalles WHERE id_buque = '$id_buque';";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $buque = $row["buque"];
            $lugar = $row["lugar"];
            $terminal = $row["terminal"];
            $operacion = $row["operacion"];
            $prod_transferir = $row["prod_transferir"];
            $fecha_hora_inicio = $row["fecha_hora_inicio"];
        }
    }

    // Arreglos de detalles de inspección
    include_once "../components/items_arrays.php";
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inspección pre-arribo finalizada</title>
    <link rel="stylesheet" href="../../../assets/css/forms/pre-arrival-inspection/finished-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/pre_arrival_inspection_menu.php"; ?>

    <div id="content">
        <div class="pdf-content" id='pdf-content'>
            <div class="pdf-nav">
                <div>Inspección Pre-Arribo</div>
                <img src="../../../assets/img/logo.svg" alt="Logo de Oiltanking">
            </div>
            <hr>
            <div class="pdf-title">
                <h3>PRE ARRIVAL INSPECTION FORM</h3>
                <p class="italic">Formato de Inspección de Pre - Arribo</p>
            </div>

            <table class="pdf-details">
                <tr>
                    <td>
                        <p><span class="bold">VESSEL: </span><?php echo $buque; ?></p>
                        <p class="italic">Buque</p>
                    </td>
                    <td>
                        <p><span class="bold">LOCATION: </span><?php echo $lugar; ?></p>
                        <p class="italic">Lugar</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span class="bold">TERMINAL: </span><?php echo $terminal; ?></p>
                        <p class="italic">Terminal</p>
                    </td>
                    <td>
                        <p><span class="bold">OPERATION: </span><?php echo $operacion; ?></p>
                        <p class="italic">Operación</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p><span class="bold">CARGO TO TRANSFER: </span><?php echo $prod_transferir; ?></p>
                        <p class="italic">Producto por transferir</p>
                    </td>
                    <td>
                        <p><span class="bold">COMMENCE'S DATE & TIME: </span><?php echo $fecha_hora_inicio; ?></p>
                        <p class="italic">Fecha y hora de inicio</p>
                    </td>
                </tr>
            </table>

            <table class="pdf-table-one">
                <tr class="table-header">
                    <td colspan="7">
                        <p class="bold">Part I - EQUIPMENTS CERTIFICATE</p>
                        <p class="italic">Parte I - Certificado de equipos</p>
                    </td>
                </tr>

                <tr class="table-header">
                    <td class="table-detail" colspan="2">
                        <p class="bold">ITEMS OF INSPECTION</p>
                        <p class="italic">Detalle de Inspección</p>
                    </td>
                    <td class="table-expiration">
                        <p class="bold">Date</p>
                        <p class="italic">Fecha</p>
                    </td>

                    <td class="table-option">
                        <p class="bold">Yes</p>
                        <p class="italic">Sí</p>
                    </td>
                    <td class="table-option">
                        <p class="bold">No</p>
                        <p class="italic">No</p>
                    </td>
                    <td class="table-option">
                        <p class="bold">N/A</p>
                    </td>

                    <td class="table-observation">
                        <p class="bold">Remarks</p>
                        <p class="italic">Observación</p>
                    </td>
                </tr>

                <?php
                    $query = "SELECT detalle_inspeccion, expiracion, conformidad, observacion FROM ins_pre_info where id_buque = '$id_buque';";
                    $result = mysqli_query($connection, $query);

                    if ($result) {
                        $item = 1;
                        $a = 1;
                        $b = 1;

                        while ($row = $result->fetch_array()) {
                            if (isset($row['detalle_inspeccion'])) {
                                if (preg_match($reg_exp_date, $row['expiracion'])) {
                                    $fecha = strtotime($row['expiracion']);
                                    $expiracion = date("d.m.y", $fecha);
                                } else {
                                    $expiracion = $row['expiracion'];
                                }

                                $conformidad = $row['conformidad'];
                                $observacion = $row['observacion'];
                            }

                            if ($item <= 10) {
                ?>

                            <tr>
                                <td>
                                    <p><?php echo $a; ?></p>
                                </td>

                                <td>
                                    <p><span class="bold"><?php echo $part1English[$a]; ?> / </span><span class="italic"><?php echo $part1Spanish[$a]; ?></span></p>
                                </td>

                                <td>
                                    <p><?php echo $expiracion; ?></p>
                                </td>

                                <?php if ($conformidad == 'si') { ?>
                                    <td><p>✔</p></td>
                                    <td></td>
                                    <td></td>
                                <?php } else if ($conformidad == 'no') { ?>
                                    <td></td>
                                    <td><p>✔</p></td>
                                    <td></td>
                                <?php } else { ?>
                                    <td></td>
                                    <td></td>
                                    <td><p>✔</p></td>
                                <?php } ?>
                                
                                <td>
                                    <p class="observation-text"><?php echo $observacion; ?></p>
                                </td>
                            </tr>

                            <?php
                                $a++;
                            }

                            if ($item >= 11 && $item <= 31) {
                                if ($item == 11) {
                            ?>
            </table>

            <table class="pdf-table-two">
                <tr class="table-header">
                    <td colspan="7">
                        <p class="bold">Part II - Equipment inspection on deck</p>
                        <p class="italic">Parte II - Inspección de equipos en cubierta</p>
                    </td>
                </tr>

                <tr class="table-header">
                    <td class="table-detail" colspan="2">
                        <p class="bold">ITEMS OF INSPECTION</p>
                        <p class="italic">Detalle de Inspección</p>
                    </td>

                    <td class="table-option">
                        <p class="bold">Yes</p>
                        <p class="italic">Si</p>
                    </td>
                    <td class="table-option">
                        <p class="bold">No</p>
                        <p class="italic">No</p>
                    </td>
                    <td class="table-option">
                        <p class="bold">N/A</p>
                    </td>

                    <td class="table-observation">
                        <p class="bold">Remarks</p>
                        <p class="italic">Observación</p>
                    </td>
                </tr>

                <?php
                                }
                ?>

                <tr>
                    <td>
                        <p><?php echo $b; ?></p>
                    </td>

                    <td>
                        <p><span class="bold"><?php echo $part2English[$b]; ?> / </span><span class="italic"><?php echo $part2Spanish[$b]; ?></span></p>
                    </td>

                    <?php if ($conformidad == 'si') { ?>
                        <td><p>✔</p></td>
                        <td></td>
                        <td></td>
                    <?php } else if ($conformidad == 'no') { ?>
                        <td></td>
                        <td><p>✔</p></td>
                        <td></td>
                    <?php } else { ?>
                        <td></td>
                        <td></td>
                        <td><p>✔</p></td>
                    <?php } ?>

                    <td>
                        <p class="observation-text"><?php echo $observacion; ?></p>
                    </td>
                </tr>

                <?php
                                $b++;
                            }

                            $item++;
                        }
                    }
                ?>

            </table>

            <div class="pdf-disclaimer">
                <p class="bold">THE UNDERSIGNED ATTEST THAT WE MADE A JOINT INSPECTION OF THE VESSEL WITH REFERENCE TO THE ABOVE REQUIREMENTS AND IN FRONT OF THE EACH ONE OF THEM WE INDICATED THAT THE REGULATIONS HAVE BEEN COMPLIED.</p>
                <p class="italic">Los firmantes dan fe de que se realizó una inspección conjunta al buque con referencia a los puntos anteriores y frente a cada uno de ellos, hemos indicado que el reglamento ha sido cumplido.</p>
            </div>

            <?php
                $query = "SELECT grado_buque, grado_terminal, DATE_FORMAT(fecha_hora_buque, '%d/%m/%y %H:%i') AS fecha_hora_buque, DATE_FORMAT(fecha_hora_terminal, '%d/%m/%y %H:%i') AS fecha_hora_terminal FROM ins_pre_firmas where id_buque ='$id_buque';";
                $result = mysqli_query($connection, $query);

                if ($result) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $grado_buque = $row["grado_buque"];
                        $grado_terminal = $row["grado_terminal"];

                        $fecha_hora_buque = $row["fecha_hora_buque"];
                        $fecha_hora_terminal = $row["fecha_hora_terminal"];
                    }
                }
            ?>

            <table class="pdf-signatures">
                <tr>
                    <td>
                        <p><span class="bold">FOR VESSEL (SIGNATURE) /</span></p>
                        <p class="italic">Por el buque (firma)</p>
                    </td>

                    <td>
                        <p><span class="bold">FOR TERMINAL (SIGNATURE) /</span></p>
                        <p class="italic">Por el terminal (firma)</p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><span class="bold">TITLE / </span><span class="italic">Grado: </span><?php echo $grado_buque; ?></p>
                    </td>

                    <td>
                        <p><span class="bold">TITLE / </span><span class="italic">Grado: </span><?php echo $grado_terminal; ?></p>
                    </td>
                </tr>

                <tr>
                    <td>
                        <p><span class="bold">COMPLETED DATE & TIME: </span><?php echo $fecha_hora_buque; ?></p>
                        <p class="italic">Fecha y hora de término:</p>
                    </td>

                    <td>
                        <p><span class="bold">COMPLETED DATE & TIME: </span><?php echo $fecha_hora_terminal; ?></p>
                        <p class="italic">Fecha y hora de término:</p>
                    </td>
                </tr>
            </table>

            <hr>
            <div class="pdf-footer">
                <p>Documento: FORM-0219-OTAS</p>
                <p>Version: <span class="bold italic underline">9</span></p>
                <p>Page 1 of 1</p>
            </div>
            

        </div>
    </div>

    <div class="pdf-print">
        <button id="botonImprimir" class="print-button">Ver impresión</button>
    </div>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="../../../assets/js/general.js"></script>
    <script src="../../../assets/js/print/pre-arrival-inspection.js"></script>
    
</body>

</html>