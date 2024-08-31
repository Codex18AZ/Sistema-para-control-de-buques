<?php
    include "../../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 2) {
        header('Location: ../../../signin.php');
        exit();
    } else {
        /* if (!isset($_POST['id_buque']) || !isset($_POST['tanker'])) { */
        if (!isset($_POST['id_buque'])) {
            header('Location: new_transferring_data.php');
            exit();
        } else {
            $id_buque = $_POST['id_buque'];
            /* $tanker = $_POST['tanker']; */

            // Comprueba si ya existen datos de transferencia (sin finalizar) con el id_buque
            $query = "SELECT id_data_trans FROM data_trans_buque WHERE id_buque = '$id_buque';";
            $result = mysqli_query($connection, $query);

            if ($result->num_rows > 0) {
                header('Location: data_list_unfinished.php');
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
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Datos de transferencia</title>
    <link rel="stylesheet" href="../../../assets/css/forms/transferring-data/new-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/transferring_data_menu.php"; ?>

    <div class="content" id="content">
        <h1>Datos de Transferencia</h1>

        <?php if ($_GET) { ?>
        <p class="error-text">
            <span class="error">
                Error al enviar los datos: <?php include_once "../../../components/messages/error_messages.php"; ?>
            </span>
        </p>
        <?php } ?>

        <form id="form" class="form" action="processes/form_sending.php" method="POST">
            <div class="tables">
                <div class="table-container">
                    <div class="form-table">
                        <label for="operacion_na">Número de operación:</label>
                        <input type="number" id="operacion_na" name="operacion_na" value='<?php if (isset($operacion_na)) { echo $operacion_na; } ?>'>
                        <br>
                    </div>
                    <table id="data_trans_buque" class="form-table">
                        <tr>
                            <td>MES</td>
                            <td>
                                <input type="hidden" name="id_buque" value='<?php echo $id_buque; ?>' readonly>
                                <select name="mes">
                                    <option value='' selected>Seleccione...</option>
                                    <option value="Enero">Enero</option>
                                    <option value="Febrero">Febrero</option>
                                    <option value="Marzo">Marzo</option>
                                    <option value="Abril">Abril</option>
                                    <option value="Mayo">Mayo</option>
                                    <option value="Junio">Junio</option>
                                    <option value="Julio">Julio</option>
                                    <option value="Agosto">Agosto</option>
                                    <option value="Septiembre">Septiembre</option>
                                    <option value="Octubre">Octubre</option>
                                    <option value="Noviembre">Noviembre</option>
                                    <option value="Diciembre">Diciembre</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>AÑO</td>
                            <td><input type="number" name='año' min="2000"></td>
                        </tr>
                        <tr>
                            <td>DUE</td>
                            <td><input type="text" name='due'></td>
                        </tr>
                        <tr>
                            <td>TIPO DE OPERACIÓN</td>
                            <td>
                                <select name='tipo_operacion'>
                                    <option value='' selected>Seleccione...</option>
                                    <option value='CARGA'>CARGA</option>
                                    <option value='ALMACENAMIENTO'>ALMACENAMIENTO</option>
                                    <option value='GASSING UP'>GASSING UP</option>
                                    <option value='MANTENIMIENTO'>MANTENIMIENTO</option>
                                    <option value='DESCARGA'>DESCARGA</option>
                                    <option value='CARGA / DESCARGA'>CARGA / DESCARGA</option>
                                    <option value='ALMAC / CARGA / DESCARGA'>ALMAC / CARGA / DESCARGA</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>TIPO DE INGRESO</td>
                            <td>
                                <select name='tipo_ingreso'>
                                    <option value='' selected>Seleccione...</option>
                                    <option value='ÚNICO'>ÚNICO</option>
                                    <option value='1ER INGRESO'>1ER INGRESO</option>
                                    <option value='2DO INGRESO'>2DO INGRESO</option>
                                    <option value='1ER AMARRE (MANIOBRA ABORTADA POR CONDICIONES)'>1ER AMARRE (MANIOBRA ABORTADA POR CONDICIONES)</option>
                                    <option value='2DO AMARRE'>2DO AMARRE</option>
                                    <option value='CARGA'>CARGA</option>
                                    <option value='DESCARGA'>DESCARGA</option>
                                    <option value='ESTUDIO DE MANIOBRA'>ESTUDIO DE MANIOBRA</option>
                                    <option value='3ER INGRESO'>3ER INGRESO</option>
                                    <option value='1ER INGRESO (OPERACIÓN ABORTADA POR CONDICIONES)'>1ER INGRESO (OPERACIÓN ABORTADA POR CONDICIONES)</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>DESTINY</td>
                            <td>
                                <select name='destiny'>
                                    <option value='' selected>Seleccione...</option>
                                    <option value='IMPORTACIÓN'>IMPORTACIÓN </option>
                                    <option value='EXPORTACIÓN'>EXPORTACIÓN</option>
                                    <option value='CABOTAJE'>CABOTAJE</option>
                                    <option value='GASSING UP'>GASSING UP</option>
                                    <option value='CARGA ALMACENAMIENTO'>CARGA ALMACENAMIENTO</option>
                                    <option value='DESCARGA ALMACENAMIENTO'>DESCARGA ALMACENAMIENTO</option>
                                </select>
                            </td>
                        </tr>
                    </table>
                </div>
                
                <?php
                    $a = 0;

                    while ($a < 4) {
                ?>

                    <div class="table-container">
                        <table id="data_trans_detalle" class="form-table">
                            <tr>
                                <td>PRODUCTO</td>
                                <td>
                                    <select id="select" name="producto_<?php echo $a; ?>">
                                        <option selected value="">Seleccione...</option>
                                        <option value="MBDS">MBDS</option>
                                        <option value="DIESELB5S50">DIESELB5S50</option>
                                        <option value="PROPANE">PROPANE</option>
                                        <option value="NAPHTA">NAPHTA</option>
                                        <option value="BUTANE">BUTANE</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td>FECHA Y HORA DE INICIO</td>
                                <td>
                                    <input type="datetime-local" name='fecha_hora_ini_<?php echo $a; ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>FECHA Y HORA DE TÉRMINO</td>
                                <td>
                                    <input type="datetime-local" name='fecha_hora_fin_<?php echo $a; ?>'>
                                </td>
                            </tr>
                            <tr>
                                <td>CANTIDAD CARGADA</td>
                                <td>
                                    <input type="number" name='cant_carg_<?php echo $a; ?>' min="0.000" step="0.001"> TM.
                                </td>
                            </tr>
                            <tr>
                                <td>CANTIDAD CARGADA</td>
                                <td>
                                    <input type="number" name='cant_carg_BBLS_<?php echo $a; ?>' min="0.000" step="0.001"> BBLS.
                                </td>
                            </tr>
                            <tr>
                                <td>CANTIDAD DESCARGADA</td>
                                <td>
                                    <input type="number" name='cant_des_<?php echo $a; ?>' min="0.000" step="0.001"> TM.
                                </td>
                            </tr>
                            <tr>
                                <td>CANTIDAD DESCARGADA</td>
                                <td>
                                    <input type="number" name='cant_des_BBLS_<?php echo $a; ?>' min="0.000" step="0.001"> BBLS.
                                </td>
                            </tr>
                            <tr>
                                <td>RÉGIMEN PROMEDIO</td>
                                <td>
                                    <input type="number" name='regimen_prom_<?php echo $a; ?>' min="0.0000" step="0.0001">
                                </td>
                            </tr>
                        </table>
                    </div>
                
                <?php
                        $a++;
                    }
                ?>

                <div class="table-container">
                    <table id="data_trans_viaje" class="form-table">
                        <tr>
                            <td>ÚLTIMO PUERTO</td>
                            <td><input type="text" name='ult_puerto'></td>
                        </tr>
                        <tr>
                            <td>DESTINO DE PRODUCTO</td>
                            <td><input type="text" name='des_producto'></td>
                        </tr>
                        <tr>
                            <td>CONSUMO DE PROPANO</td>
                            <td><input type="text" name='con_propano'></td>
                        </tr>
                        <tr>
                            <td>DESCARGA DE LASTRE</td>
                            <td><input type="number" name='des_lastre' step="0.0001"></td>
                        </tr>
                        <tr>
                            <td>OBSERVACIONES LASTRE</td>
                            <td><input type="text" name='obs_lastre' value='Sin novedad'></td>
                        </tr>
                        <tr>
                            <td>VESSEL LEFT</td>
                            <td><input type="datetime-local" name='vessel_left'></td>
                        </tr>
                        <tr>
                            <td>SAILING</td>
                            <td><input type="datetime-local" name='sailing'></td>
                        </tr>
                    </table>
                </div>

                <div class="table-container">
                    <table id="data_trans_info_buque" class="form-table">
                        <tr>
                            <th colspan="2">INFORMACIÓN DEL BUQUE</th>
                        </tr>
                        <tr>
                            <td>IMO</td>
                            <td><input type="text" name='imo'></td>
                        </tr>
                        <tr>
                            <td>TRB (GRT)</td>
                            <td><input type="number" name='trb' min="0"></td>
                        </tr>
                        <tr>
                            <td>TRN (NRT)</td>
                            <td><input type="number" name='trn' min="0"></td>
                        </tr> 
                        <tr>
                            <td>SDWT:</td>
                            <td><input type="number" name='sdwt' min="0"></td>
                        </tr> 
                        <tr>
                            <td>LOA</td>
                            <td><input type="text" name='loa'></td>
                        </tr> 
                        <tr>
                            <td>BREATH</td>
                            <td><input type="text" name='breath'></td>
                        </tr>
                        <tr>
                            <td>DEPTH</td>
                            <td><input type="text" name='depth'></td>
                        </tr> 
                        <tr>
                            <td>AÑO FABRICACIÓN</td>
                            <td><input type="number" name='año_fab' min="1900"></td>
                        </tr> 
                        <tr>
                            <td>DRAFT - SUMMER</td>
                            <td><input type="text" name='draft_sum'></td>
                        </tr>     
                    </table>
                </div>

                <div class="table-container">
                    <table id="data_trans_est_hechos" class="form-table">
                        <tr>
                            <th colspan="2">ESTADO DE HECHOS</th>
                        </tr>
                        <tr>
                            <td>ETA</td>
                            <td><input type="date" name='eta'></td>
                        </tr>
                        <tr>
                            <td>ETD</td>
                            <td><input type="date" name='etd'></td>
                        </tr>
                        <tr>
                            <td>NUMERO DE OPERACIÓN</td>
                            <td><input type="number" name='num_opera'></td>
                        </tr>
                        <tr>
                            <td>NUMERO DE OPERACIÓN ANUAL</td>
                            <td><input type="number" name='num_opera_anual'></td>
                        </tr>
                        <tr>
                            <td>VIAJE DEL BUQUE ANUAL</td>
                            <td><input type="number" name='viaje'></td>
                        </tr>
                        <tr>
                            <td>AGENCIA</td>
                            <td>
                                <select name="agencia" id="">
                                    <option selected="" value="">Seleccione...</option>
                                    <option value="RENADSA">RENADSA</option>
                                    <option value="MARTIMA MERCANTIL">MARTIMA MERCANTIL</option>
                                    <option value="COSMOS">COSMOS</option>
                                    <option value="RASAN">RASAN</option>
                                    <option value="AGENTAL PERÚ">AGENTAL PERÚ</option>
                                    <option value="ISS MARINE SERVICES S.A.C.">ISS MARINE SERVICES S.A.C.</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>LLEG. DE PRÁCTICO AL EMBARCADERO</td>
                            <td><input type="datetime-local" name='lleg'></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="options">
                <!-- <input type="button" class="return" onclick="clearFormData()" value="Limpiar formulario"> -->
                <input type="button" class="submit" onclick="saveUnfinishedForm()" value="Guardar borrador">
                <input type="button" id="guardar-boton" class="submit" value="Guardar y cerrar operación">
            </div>

            <div id="verificacion">
                <h1>Cierre de Datos de Transferencia</h1>
                <p>
                    ¿Está seguro de que desea cerrar esta operación? No podrán agregarse ni editarse nuevos parámetros.
                    <!-- Si está seguro, ingrese su contraseña para continuar: -->
                </p>

                <!-- <div class="verification-password">
                    <input type="password" name="password">
                </div> -->

                <div class="verification-buttons">
                    <input type="button" id="ocultarVerificacion" class="return" value="Cancelar">
                    <input type="submit" name="continuar" class="submit" value="Continuar">
                </div>
            </div>
        </form>
    </div>

    <script src="../../../assets/js/general.js"></script>
    <!-- <script src="../../../assets/js/localstorage/transferring-data.js"></script> -->
    <script src="../../../assets/js/forms/transferring-data.js"></script>
</body>

</html>