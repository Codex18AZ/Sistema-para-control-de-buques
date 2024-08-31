<?php
    include "../../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo'])) {
        header('Location: ../../../signin.php');
        exit();
    } else {
        if (!isset($_POST['id_data_trans'])) {
            header('Location: data_list_finished.php');
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
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de transferencia finalizados</title>
    <link rel="stylesheet" href="../../../assets/css/forms/transferring-data/finished-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php
        include_once "../components/transferring_data_menu.php";
        $id_data_trans = $_POST['id_data_trans'];
    ?>

    <div id="content">
        <div class="pdf-content" id='pdf-content'>
            <div class="pdf-nav">
                <div>Datos de la transferencia</div>
                <img src="../../../assets/img/logo.svg" alt="Logo de Oiltanking">
            </div>
            <hr>

            <div class="pdf-details">
                <table>
                    <?php
                        $query = "SELECT * FROM data_trans_buque WHERE id_data_trans = '$id_data_trans';";
                        $result = mysqli_query($connection, $query);
            
                        while ($row = mysqli_fetch_assoc($result)) {
                            $mes = $row['mes'];
                            $año = $row['año'];
                            $due = $row['due'];
                            $tipo_operacion = $row['tipo_operacion'];
                            $tipo_ingreso = $row['tipo_ingreso'];
                            $destiny = $row['destiny'];
                        }
                    ?>
                    
                    <tr>
                        <td><p>MES</p></td>
                        <td><p><?php if (isset($mes)) { echo $mes; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>AÑO</p></td>
                        <td><p><?php if (isset($año)) { echo $año; } ?></p></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td><p>DUE</p></td>
                        <td><p><?php if (isset($due)) { echo $due; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>TIPO DE OPERACIÓN</p></td>
                        <td><p>
                            <?php
                                if (isset($tipo_operacion)) {
                                    echo $tipo_operacion;
                                }
                            ?>
                        </p></td>
                    </tr>
                </table>

                <table>
                    <tr>
                        <td><p>TIPO DE INGRESO</p></td>
                        <td><p>
                            <?php
                                if (isset($tipo_ingreso)) { 
                                    echo $tipo_ingreso;
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                        <td><p>DESTINY</p></td>
                        <td><p>
                            <?php
                                if (isset($destiny)) {
                                    echo $destiny;
                                }
                            ?>
                        </p></td>
                    </tr>
                </table>
            </div>

            <?php
                $query = "SELECT producto, DATE_FORMAT(fecha_hora_ini, '%d/%m/%Y %H:%i') AS fecha_hora_ini, DATE_FORMAT(fecha_hora_fin, '%d/%m/%Y %H:%i') AS fecha_hora_fin, cant_carg, cant_des, regimen_prom , cant_carg_BBLS, cant_des_BBLS FROM data_trans_detalle WHERE id_data_trans = '$id_data_trans';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table[$i]['producto'] = $row['producto'];
                    $data_table[$i]['fecha_hora_ini'] = $row['fecha_hora_ini'];
                    $data_table[$i]['fecha_hora_fin'] = $row['fecha_hora_fin'];
                    $data_table[$i]['cant_carg'] = $row['cant_carg'];
                    $data_table[$i]['cant_des'] = $row['cant_des'];

                    $data_table[$i]['cant_carg_BBLS'] = $row['cant_carg_BBLS'];
                    $data_table[$i]['cant_des_BBLS'] = $row['cant_des_BBLS'];

                    $data_table[$i]['regimen_prom'] = $row['regimen_prom'];

                    $i++;
                }
                
                $a = 0;

                echo "<div class='pdf-products'>";

                while ($a < 4) {
            ?>

                <table>
                    <tr>
                        <td><p class="bold">PRODUCTO</p></td>
                        <td><p>
                            <?php
                                if (isset($data_table[$a]['producto'])) {
                                    echo $data_table[$a]['producto'];
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                        <td><p class="bold">FECHA Y HORA DE INICIO</p></td>
                        <td><p>
                            <?php
                                if (isset($data_table[$a]['fecha_hora_ini'])) {
                                    echo $data_table[$a]['fecha_hora_ini'];
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                        <td><p class="bold">FECHA Y HORA DE TÉRMINO</p></td>
                        <td><p>
                            <?php
                                if (isset($data_table[$a]['fecha_hora_fin'])) {
                                    echo $data_table[$a]['fecha_hora_fin'];
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                                <td><p class="bold">CANTIDAD CARGADA</p></td>
                                <td>
                                <p><?php if (isset($data_table[$a]['cant_carg'])) { echo number_format($data_table[$a]['cant_carg']); } ?> TM.</p>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="bold">CANTIDAD CARGADA</p></td>
                                <td>
                                <p><?php if (isset($data_table[$a]['cant_carg_BBLS'])) { echo number_format($data_table[$a]['cant_carg_BBLS']); } ?> BBLS.</p>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="bold">CANTIDAD DESCARGADA</p></td>
                                <td>
                                <p><?php if (isset($data_table[$a]['cant_des'])) { echo number_format($data_table[$a]['cant_des']); } ?> TM.</p>
                                </td>
                            </tr>
                            <tr>
                                <td><p class="bold">CANTIDAD DESCARGADA</p></td>
                                <td>
                                <p><?php if (isset($data_table[$a]['cant_des_BBLS'])) { echo number_format($data_table[$a]['cant_des_BBLS']); } ?> BBLS.</p>
                                </td>
                            </tr>
                    <tr>
                        <td><p class="bold">RÉGIMEN PROMEDIO</p></td>
                        <td><p>
                            <?php
                                if (isset($data_table[$a]['regimen_prom'])) {
                                    echo number_format($data_table[$a]['regimen_prom']);
                                }
                            ?>
                        </p></td>
                    </tr>
                </table>

            <?php
                    $a++;
                }

                echo "</div>";

                $query = "SELECT ult_puerto, des_producto, con_propano, des_lastre, obs_lastre, DATE_FORMAT(vessel_left, '%d/%m/%Y %H:%i') AS vessel_left, DATE_FORMAT(sailing, '%d/%m/%Y %H:%i') AS sailing FROM data_trans_viaje WHERE id_data_trans = '$id_data_trans';";
                $result = mysqli_query($connection, $query);
        
                while ($row = mysqli_fetch_assoc($result)) {
                    $ult_puerto = $row['ult_puerto'];
                    $des_producto = $row['des_producto'];
                    $con_propano = $row['con_propano'];
                    $des_lastre = $row['des_lastre'];
                    $obs_lastre = $row['obs_lastre'];
                    $vessel_left = $row['vessel_left'];
                    $sailing = $row['sailing'];
                }
            ?>
            
            <div class="pdf-sailing">
                <table>
                    <tr>
                        <td><p>ÚLTIMO PUERTO</p></td>
                        <td><p><?php if (isset($ult_puerto)) { echo $ult_puerto; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>DESTINO DE PRODUCTO</p></td>
                        <td><p><?php if (isset($des_producto)) { echo $des_producto; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>CONSUMO DE PROPANO</p></td>
                        <td><p><?php if (isset($con_propano)) { echo $con_propano; } ?></p></td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td><p>DESCARGA DE LASTRE</p></td>
                        <td><p><?php if (isset($des_lastre)) { echo $des_lastre; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>OBSERVACIONES LASTRE</p></td>
                        <td><p>
                            <?php
                                if (isset($obs_lastre)) {
                                    echo $obs_lastre;
                                } else {
                                    echo "Sin novedad";
                                }
                            ?>
                        </p></td>
                    </tr>
                </table>
                
                <table>
                    <tr>
                        <td><p>VESSEL LEFT</p></td>
                        <td><p><?php if (isset($vessel_left)) { echo $vessel_left; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>SAILING</p></td>
                        <td><p><?php if (isset($sailing)) { echo $sailing; } ?></p></td>
                    </tr>
                </table>
            </div>

            <?php
                include "../../../components/regular_expressions.php";

                $query = "SELECT * FROM data_trans_info_buque WHERE id_data_trans = '$id_data_trans';";
                $result = mysqli_query($connection, $query);
        
                while ($row = mysqli_fetch_assoc($result)) {
                    $imo = $row['imo'];
                    $trb = $row['trb'];
                    $trn = $row['trn'];
                    $sdwt = $row['sdwt'];
                    $loa = $row['loa'];
                    $breath = $row['breath'];
                    $depth = $row['depth'];
                    $año_fab = $row['año_fab'];
                    $draft_sum = $row['draft_sum'];
                }
            ?>

            <div class="pdf-information">
                <table>
                    <tr class="table-header">
                        <th colspan="2"><p>INFORMACIÓN DEL BUQUE</p></th>
                    </tr>
                    <tr>
                        <td><p>IMO</p></td>
                        <td><p><?php if (isset($imo)) { echo $imo; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>TRB (GRT)</p></td>
                        <td><p>
                            <?php
                                if (isset($trb)) {
                                    if (preg_match($reg_exp_number, $trb)) {
                                        echo number_format($trb);
                                    } else {
                                        echo $trb;
                                    }
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                        <td><p>TRN (NRT)</p></td>
                        <td><p>
                            <?php
                                if (isset($trn)) {
                                    if (preg_match($reg_exp_number, $trn)) {
                                        echo number_format($trn);
                                    } else {
                                        echo $trn;
                                    }
                                }
                            ?>
                        </p></td>
                    </tr> 
                    <tr>
                        <td><p>SDWT:</p></td>
                        <td><p>
                            <?php
                                if (isset($sdwt)) {
                                    if (preg_match($reg_exp_number, $sdwt)) {
                                        echo number_format($sdwt);
                                    } else {
                                        echo $sdwt;
                                    }
                                }
                            ?>
                        </p></td>
                    </tr> 
                    <tr>
                        <td><p>LOA</p></td>
                        <td><p><?php if (isset($loa)) { echo $loa; } ?></p></td>
                    </tr> 
                    <tr>
                        <td><p>BREATH</p></td>
                        <td><p><?php if (isset($breath)) { echo $breath; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>DEPTH</p></td>
                        <td><p><?php if (isset($depth)) { echo $depth; } ?></p></td>
                    </tr> 
                    <tr>
                        <td><p>AÑO FABRICACIÓN</p></td>
                        <td><p><?php if (isset($año_fab)) { echo $año_fab; } ?></p></td>
                    </tr> 
                    <tr>
                        <td><p>DRAFT - SUMMER</p></td>
                        <td><p><?php if (isset($draft_sum)) { echo $draft_sum; } ?></p></td>
                    </tr>     
                </table>
                
                <?php
                    $query = "SELECT DATE_FORMAT(eta, '%d/%m/%Y %H:%i') AS eta, DATE_FORMAT(etd, '%d/%m/%Y %H:%i') AS etd, num_opera, num_opera_anual, viaje, agencia, DATE_FORMAT(lleg, '%d/%m/%Y %H:%i') AS lleg FROM data_trans_est_hechos WHERE id_data_trans = '$id_data_trans';";
                    $result = mysqli_query($connection, $query);
        
                    while ($row = mysqli_fetch_assoc($result)) {
                        $eta = $row['eta'];
                        $etd = $row['etd'];
                        $num_opera = $row['num_opera'];
                        $num_opera_anual = $row['num_opera_anual'];
                        $viaje = $row['viaje'];
                        $agencia = $row['agencia'];
                        $lleg = $row['lleg'];
                    }
                ?>
                
                <table>
                    <tr class="table-header">
                        <th colspan="2"><p>ESTADO DE HECHOS</p></th>
                    </tr>
                    <tr>
                        <td><p>ETA</p></td>
                        <td><p><?php if (isset($eta)) { echo $eta; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>ETD</p></td>
                        <td><p><?php if (isset($etd)) { echo $etd; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>NUMERO DE OPERACIÓN</p></td>
                        <td><p><?php if (isset($num_opera)) { echo $num_opera; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>NUMERO DE OPERACIÓN ANUAL</p></td>
                        <td><p><?php if (isset($num_opera_anual)) { echo $num_opera_anual; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>VIAJE DEL BUQUE ANUAL</p></td>
                        <td><p><?php if (isset($viaje)) { echo $viaje; } ?></p></td>
                    </tr>
                    <tr>
                        <td><p>AGENCIA</p></td>
                        <td><p>
                            <?php
                                if (isset($agencia)) {
                                    echo $agencia;
                                }
                            ?>
                        </p></td>
                    </tr>
                    <tr>
                        <td><p>LLEG. DE PRÁCTICO AL EMBARCADERO</p></td>
                        <td><p><?php if (isset($lleg)) { echo $lleg; } ?></p></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>

    <div class="pdf-print">
        <button id="botonImprimir" class="print-button">Ver impresión</button>
    </div>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="../../../assets/js/general.js"></script>
    <script src="../../../assets/js/print/transferring-data.js"></script>
</body>

</html>