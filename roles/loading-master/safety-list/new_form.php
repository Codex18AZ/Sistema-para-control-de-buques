<?php
    include "../../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 1) {
        header('Location: ../../../signin.php');
        exit();
    } else {
        if (!isset($_POST['id_term_buque']) || !isset($_POST['buque'])) {
            header('Location: new_safety_list.php');
            exit();
        } else {
            $id_term_buque = $_POST['id_term_buque'];
            $buque = $_POST['buque'];

            // Comprueba si ya existe un Safety Check List (sin finalizar) con el id_term_buque
            $query = "SELECT id_term_buque FROM safety_list_buque WHERE id_term_buque = '$id_term_buque';";
            $result = mysqli_query($connection, $query);

            if ($result->num_rows > 0) {
                header('Location: safety_lists_unfinished.php');
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
    <title>Ship Shore Safety Check List</title>
    <link rel="stylesheet" href="../../../assets/css/forms/safety-list/new-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/safety_list_menu.php"; ?>

    <div class="content" id="content">
        <h1>Ship Shore Safety Check List</h1>

        <?php if ($_GET) { ?>
        <p class="error-text">
            <span class="error">
                Error al enviar los datos: <?php include_once "../../../components/messages/error_messages.php"; ?>
            </span>
        </p>
        <?php } ?>

        <form id="form" class="form" action="processes/form_sending.php" method="POST">
            <div class="tables">
                <label for="operacion_na">Número de operación:</label>
                <input type="number" id="operacion_na" name="operacion_na">
                <br>
            </div>
            <div class="tables">
                <div class="table-container">
                    <table id="safety_list_buque" class="form-table">
                        <tr>
                            <th colspan="2">Ship Shore Safety Check List</th>
                        </tr>
                        <tr>
                            <td>Date and time:</td>
                            <td>
                                <input type="hidden" name="id_term_buque" value='<?php echo $id_term_buque; ?>' readonly>
                                <input type="datetime-local" name="date_time">
                            </td>
                        </tr>
                        <tr>
                            <td>Port:</td>
                            <td><input type="text" name="port" value="PISCO, PERU" required readonly></td>
                        </tr>
                        <tr>
                            <td>Tanker:</td>
                            <td><input type="text" name="tanker" value='<?php echo $buque; ?>' readonly></td>
                        </tr>
                        <tr>
                            <td>Terminal:</td>
                            <td><input type="text" name="terminal" value="TMPC" required readonly></td>
                        </tr>
                        <tr>
                            <td>Product to be transferred:</td>
                            <td><input type="text" name="product_trans"></td>
                        </tr>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_1a_tanker" class="form-table">
                        <tr><th colspan='5'>Part 1A. Tanker: checks pre-arrival</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_1a_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_1a'][$i] = $row['item_1a'];
                                $data_list['check_1a'][$i] = $row['check_1a'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_1a'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_1a'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_1a'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_1a_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_1a_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_1b_tanker" class="form-table">
                        <tr><th colspan='5'>Part 1B. Tanker: checks pre-arrival if using an inert gas system</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_1b_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_1b'][$i] = $row['item_1b'];
                                $data_list['check_1b'][$i] = $row['check_1b'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_1b'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_1b'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_1b'][$a]; echo "</td>
                                    <td>
                                        <select name='status_1b_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_1b_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_2_terminal" class="form-table">
                        <tr><th colspan='5'>Part 2. Terminal: checks pre-arrival</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_2_terminal_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_2'][$i] = $row['item_2'];
                                $data_list['check_2'][$i] = $row['check_2'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_2'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_2'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_2'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_2_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_2_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_3_tanker" class="form-table">
                        <tr><th colspan='5'>Part 3. Tanker: checks after mooring</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_3_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_3'][$i] = $row['item_3'];
                                $data_list['check_3'][$i] = $row['check_3'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_3'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_3'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_3'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_3_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_3_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>
                <div class="table-container">
                    <table id="safety_list_4_terminal" class="form-table">
                        <tr><th colspan='5'>Part 4. Terminal: checks after mooring</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_4_terminal_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_4'][$i] = $row['item_4'];
                                $data_list['check_4'][$i] = $row['check_4'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_4'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_4'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_4'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_4_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_4_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>
                <div class="table-container">
                    <table id="safety_list_5a_tanker_terminal" class="form-table">
                        <tr><th colspan='5'>Part 5A. Tanker and Terminal: pre-transfer conference</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Tanker status</span></td>
                            <td><span class='bold'>Terminal status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_5a_tanker_terminal_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_5a'][$i] = $row['item_5a'];
                                $data_list['check_5a'][$i] = $row['check_5a'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_5a'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_5a'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_5a'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_tanker_5a_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <select name='status_terminal_5a_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_5a_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_5b_tanker" class="form-table">
                        <tr><th colspan='5'>Additional for chemical tankers - Checks pre-transfer</th></tr>
                        <tr><th colspan='5'>Part 5B. Tanker and terminal: bulk liquid chemicals. Check pre-transfer</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Tanker status</span></td>
                            <td><span class='bold'>Terminal status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_5b_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_5b'][$i] = $row['item_5b'];
                                $data_list['check_5b'][$i] = $row['check_5b'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_5b'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_5b'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_5b'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_tanker_5b_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <select name='status_terminal_5b_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_5b_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_5c_tanker" class="form-table">
                        <tr><th colspan='5'>Additional for gas tankers - Checks pre-transfer.</th></tr>
                        <tr><th colspan='5'>Part 5C. Tanker and terminal: liquefied gas. Check pre-transfer</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Tanker status</span></td>
                            <td><span class='bold'>Terminal status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_5c_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_5c'][$i] = $row['item_5c'];
                                $data_list['check_5c'][$i] = $row['check_5c'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_5c'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_5c'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_5c'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='status_tanker_5c_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    
                                    <td>
                                        <select name='status_terminal_5c_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_5c_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                        <table id="safety_list_6_tanker" class="form-table">
                            <tr><th colspan="6">Part 6. Tanker and Terminal: agreements pre-transfer</th></tr>
                            <tr>
                                <td><span class="bold">Part 5 Item</span></td>
                                <td><span class="bold">Check</span></td>
                                <td colspan="2"><span class="bold">Details</span></td>
                                <td><span class="bold">Terminal initials</span></td>
                                <td><span class="bold">Tanker initials</span></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">32.</td>
                                <td rowspan="2">Tanker manoeuvring readiness</td>
                                <td>Notice period (maximum) for full readiness to manoeuvre:</td>
                                <td><input type="text" name="details_6_0" value='<?php if (isset($data_details[0])) { echo $data_details[0]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_0" value='<?php if (isset($data_table['tanker_initials_6'][0])) { echo $data_table['tanker_initials_6'][0]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_0" value='<?php if (isset($data_table['terminal_initials_6'][0])) { echo $data_table['terminal_initials_6'][0]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Period of disablement (if permitted):</td>
                                <td><input type="text" name="details_6_1" value='<?php if (isset($data_details[1])) { echo $data_details[1]; } ?>'></td>
                            </tr>

                            <tr>
                                <td rowspan="2">33.</td>
                                <td rowspan="2">Security protocols</td>
                                <td>Security level:</td>
                                <td><input type="text" name="details_6_2" value='<?php if (isset($data_details[2])) { echo $data_details[2]; } ?>' ></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_1" value='<?php if (isset($data_table['tanker_initials_6'][1])) { echo $data_table['tanker_initials_6'][1]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_1" value='<?php if (isset($data_table['terminal_initials_6'][1])) { echo $data_table['terminal_initials_6'][1]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Local requirements:</td>
                                <td><input type="text" name="details_6_3" value='<?php if (isset($data_details[3])) { echo $data_details[3]; } ?>'></td>
                            </tr>
                                
                            <tr>
                                <td rowspan="2">34.</td>
                                <td rowspan="2">Effective tanker / terminal communications</td>
                                <td>Primary system:</td>
                                <td><input type="text" name="details_6_4" value='<?php if (isset($data_details[4])) { echo $data_details[4]; } ?>' ></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_2" value='<?php if (isset($data_table['tanker_initials_6'][2])) { echo $data_table['tanker_initials_6'][2]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_2" value='<?php if (isset($data_table['terminal_initials_6'][2])) { echo $data_table['terminal_initials_6'][2]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Backup system:</td>
                                <td><input type="text" name="details_6_5" value='<?php if (isset($data_details[5])) { echo $data_details[5]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">35.</td>
                                <td rowspan="2">Operational supervision and watch keeping</td>
                                <td>Tanker:</td>
                                <td><input type="text" name="details_6_6" value='<?php if (isset($data_details[6])) { echo $data_details[6]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_3" value='<?php if (isset($data_table['tanker_initials_6'][3])) { echo $data_table['tanker_initials_6'][3]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_3" value='<?php if (isset($data_table['terminal_initials_6'][3])) { echo $data_table['terminal_initials_6'][3]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Terminal:</td>
                                <td><input type="text" name="details_6_7" value='<?php if (isset($data_details[7])) { echo $data_details[7]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">37. 38.</td>
                                <td rowspan="2">Dedicated smoking areas and naked lights restrictions</td>
                                <td>Tanker:</td>
                                <td><input type="text" name="details_6_8" value='<?php if (isset($data_details[8])) { echo $data_details[8]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_4" value='<?php if (isset($data_table['tanker_initials_6'][4])) { echo $data_table['tanker_initials_6'][4]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_4" value='<?php if (isset($data_table['terminal_initials_6'][4])) { echo $data_table['terminal_initials_6'][4]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Terminal:</td>
                                <td><input type="text" name="details_6_9" value='<?php if (isset($data_details[9])) { echo $data_details[9]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="3">45.</td>
                                <td rowspan="3">Maximum wind, current and sea/swell criteria or other environmental factors</td>
                                <td>Stop cargo transfer:</td>
                                <td><input type="text" name="details_6_10" value='<?php if (isset($data_details[10])) { echo $data_details[10]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="tanker_initials_6_5" value='<?php if (isset($data_table['tanker_initials_6'][5])) { echo $data_table['tanker_initials_6'][5]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="terminal_initials_6_5" value='<?php if (isset($data_table['terminal_initials_6'][5])) { echo $data_table['terminal_initials_6'][5]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Disconnect:</td>
                                <td><input type="text" name="details_6_11" value='<?php if (isset($data_details[11])) { echo $data_details[11]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Unberth:</td>
                                <td><input type="text" name="details_6_12" value='<?php if (isset($data_details[12])) { echo $data_details[12]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="5">45. 46.</td>
                                <td rowspan="5">Limits for cargo, bunkers and ballast handling</td>
                                <td>Maximum transfer rates:</td>
                                <td><input type="text" name="details_6_13" value='<?php if (isset($data_details[13])) { echo $data_details[13]; } ?>'></td>
                                <td rowspan="5"><input type="text" name="tanker_initials_6_6" value='<?php if (isset($data_table['tanker_initials_6'][6])) { echo $data_table['tanker_initials_6'][6]; } ?>'></td>
                                <td rowspan="5"><input type="text" name="terminal_initials_6_6" value='<?php if (isset($data_table['terminal_initials_6'][6])) { echo $data_table['terminal_initials_6'][6]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Topping-off rates:</td>
                                <td><input type="text" name="details_6_14" value='<?php if (isset($data_details[14])) { echo $data_details[14]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Maximum manifold pressure:</td>
                                <td><input type="text" name="details_6_15" value='<?php if (isset($data_details[15])) { echo $data_details[15]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Cargo temperature:</td>
                                <td><input type="text" name="details_6_16" value='<?php if (isset($data_details[16])) { echo $data_details[16]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Other limitations:</td>
                                <td><input type="text" name="details_6_17" value='<?php if (isset($data_details[17])) { echo $data_details[17]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="5">45. 46.</td>
                                <td rowspan="5">Pressure surge control</td>
                                <td>Minimum number of cargo tanks open:</td>
                                <td><input type="text" name="details_6_18" value='<?php if (isset($data_details[18])) { echo $data_details[18]; } ?>'></td>
                                <td rowspan="5"><input type="text" name="tanker_initials_6_7" value='<?php if (isset($data_table['tanker_initials_6'][7])) { echo $data_table['tanker_initials_6'][7]; } ?>'></td>
                                <td rowspan="5"><input type="text" name="terminal_initials_6_7" value='<?php if (isset($data_table['terminal_initials_6'][7])) { echo $data_table['terminal_initials_6'][7]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Tank switching protocols:</td>
                                <td><input type="text" name="details_6_19" value='<?php if (isset($data_details[19])) { echo $data_details[19]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Full load rate:</td>
                                <td><input type="text" name="details_6_20" value='<?php if (isset($data_details[20])) { echo $data_details[20]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Topping-off rate:</td>
                                <td><input type="text" name="details_6_21" value='<?php if (isset($data_details[21])) { echo $data_details[21]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Closing time of automatic valves:</td>
                                <td><input type="text" name="details_6_22" value='<?php if (isset($data_details[22])) { echo $data_details[22]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">46.</td>
                                <td rowspan="2">Cargo transfer management procedures</td>
                                <td>Action notice periods:</td>
                                <td><input type="text" name="details_6_23" value='<?php if (isset($data_details[23])) { echo $data_details[23]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_8" value='<?php if (isset($data_table['tanker_initials_6'][8])) { echo $data_table['tanker_initials_6'][8]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_8" value='<?php if (isset($data_table['terminal_initials_6'][8])) { echo $data_table['terminal_initials_6'][8]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Transfer stop protocols:</td>
                                <td><input type="text" name="details_6_24" value='<?php if (isset($data_details[24])) { echo $data_details[24]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="1">50.</td>
                                <td rowspan="1">Routine for regular checks on cargo transferred are agreed</td>
                                <td>Routine transferred quantity checks:</td>
                                <td><input type="text" name="details_6_25" value='<?php if (isset($data_details[25])) { echo $data_details[25]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="tanker_initials_6_9" value='<?php if (isset($data_table['tanker_initials_6'][9])) { echo $data_table['tanker_initials_6'][9]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="terminal_initials_6_9" value='<?php if (isset($data_table['terminal_initials_6'][9])) { echo $data_table['terminal_initials_6'][9]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">51.</td>
                                <td rowspan="2">Emergency signals</td>
                                <td>Tanker:</td>
                                <td><input type="text" name="details_6_26" value='<?php if (isset($data_details[26])) { echo $data_details[26]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_10" value='<?php if (isset($data_table['tanker_initials_6'][10])) { echo $data_table['tanker_initials_6'][10]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_10" value='<?php if (isset($data_table['terminal_initials_6'][10])) { echo $data_table['terminal_initials_6'][10]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Terminal:</td>
                                <td><input type="text" name="details_6_27" value='<?php if (isset($data_details[27])) { echo $data_details[27]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="1">55.</td>
                                <td rowspan="1">Tank venting system</td>
                                <td>Procedure:</td>
                                <td><input type="text" name="details_6_28" value='<?php if (isset($data_details[28])) { echo $data_details[28]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="tanker_initials_6_11" value='<?php if (isset($data_table['tanker_initials_6'][11])) { echo $data_table['tanker_initials_6'][11]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="terminal_initials_6_11" value='<?php if (isset($data_table['terminal_initials_6'][11])) { echo $data_table['terminal_initials_6'][11]; } ?>'></td>
                            </tr>
                                
                            <tr>
                                <td rowspan="1">55.</td>
                                <td rowspan="1">Closed operations</td>
                                <td>Requirements:</td>
                                <td><input type="text" name="details_6_29" value='<?php if (isset($data_details[29])) { echo $data_details[29]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="tanker_initials_6_12" value='<?php if (isset($data_table['tanker_initials_6'][12])) { echo $data_table['tanker_initials_6'][12]; } ?>'></td>
                                <td rowspan="1"><input type="text" name="terminal_initials_6_12" value='<?php if (isset($data_table['terminal_initials_6'][12])) { echo $data_table['terminal_initials_6'][12]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="2">56.</td>
                                <td rowspan="2">Vapour return line</td>
                                <td>Operational parameters:</td>
                                <td><input type="text" name="details_6_30" value='<?php if (isset($data_details[30])) { echo $data_details[30]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="tanker_initials_6_13" value='<?php if (isset($data_table['tanker_initials_6'][13])) { echo $data_table['tanker_initials_6'][13]; } ?>'></td>
                                <td rowspan="2"><input type="text" name="terminal_initials_6_13" value='<?php if (isset($data_table['terminal_initials_6'][13])) { echo $data_table['terminal_initials_6'][13]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Maximum flow rate:</td>
                                <td><input type="text" name="details_6_31" value='<?php if (isset($data_details[31])) { echo $data_details[31]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="3">60.</td>
                                <td rowspan="3">Nitrogen supply from terminal</td>
                                <td>Procedures to receive:</td>
                                <td><input type="text" name="details_6_32" value='<?php if (isset($data_details[32])) { echo $data_details[32]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="tanker_initials_6_14" value='<?php if (isset($data_table['tanker_initials_6'][14])) { echo $data_table['tanker_initials_6'][14]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="terminal_initials_6_14" value='<?php if (isset($data_table['terminal_initials_6'][14])) { echo $data_table['terminal_initials_6'][14]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Maximum pressure:</td>
                                <td><input type="text" name="details_6_33" value='<?php if (isset($data_details[33])) { echo $data_details[33]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Flow rate:</td>
                                <td><input type="text" name="details_6_34" value='<?php if (isset($data_details[34])) { echo $data_details[34]; } ?>'></td>
                            </tr>
                            
                            <tr>
                                <td rowspan="3">83.</td>
                                <td rowspan="3">For gas tanker only: cargo tank relief valve settings</td>
                                <td>Tank 1:</td>
                                <td><input type="text" name="details_6_35" value='<?php if (isset($data_details[35])) { echo $data_details[35]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="tanker_initials_6_15" value='<?php if (isset($data_table['tanker_initials_6'][15])) { echo $data_table['tanker_initials_6'][15]; } ?>'></td>
                                <td rowspan="3"><input type="text" name="terminal_initials_6_15" value='<?php if (isset($data_table['terminal_initials_6'][15])) { echo $data_table['terminal_initials_6'][15]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Tank 2:</td>
                                <td><input type="text" name="details_6_36" value='<?php if (isset($data_details[36])) { echo $data_details[36]; } ?>'></td>
                            </tr>
                            <tr>
                                <td>Tank 3:</td>
                                <td><input type="text" name="details_6_37" value='<?php if (isset($data_details[37])) { echo $data_details[37]; } ?>'></td>
                            </tr>                    
                        </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_7a_general" class="form-table">
                        <tr><th colspan='5'>Part 7A. General tanker: checks pre-transfer</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_7a_general_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_7a'][$i] = $row['item_7a'];
                                $data_list['check_7a'][$i] = $row['check_7a'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_7a'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_7a'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_7a'][$a]; echo "</td>

                                    <td>
                                        <select name='status_7a_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_7a_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_7b_tanker" class="form-table">
                        <tr><th colspan='5'>Part 7B. Tanker: checks pre-transfer if crude oil washing is planned</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_7b_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_7b'][$i] = $row['item_7b'];
                                $data_list['check_7b'][$i] = $row['check_7b'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_7b'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_7b'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_7b'][$a]; echo "</td>

                                    <td>
                                        <select name='status_7b_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_7b_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_7c_tanker" class="form-table">
                        <tr><th colspan='5'>Part 7C. Tanker: checks prior to tank cleaning ans/or gas freeing</th></tr>
                        <tr>
                            <td><span class='bold'>Item</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Status</span></td>
                            <td><span class='bold'>Remarks</span></td>
                        </tr>
                        <?php
                            $query = "SELECT * FROM safety_list_7c_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_7c'][$i] = $row['item_7c'];
                                $data_list['check_7c'][$i] = $row['check_7c'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['item_7c'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_7c'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_7c'][$a]; echo "</td>

                                    <td>
                                        <select name='status_7c_$a'>
                                            <option value='' selected>--- Seleccionar ---</option>
                                            <option value='Yes'>Yes</option>
                                            <option value='No'>No</option>
                                            <option value='N/A'>N/A</option>
                                        </select>
                                    </td>
                                    <td><textarea name='remarks_7c_$a'></textarea></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id='safety_list_ungrouped' class='form-table'>
                        <tr><th>Declaration</th></tr>
                        <tr>
                            <td class="declaration">
                                <p>We the undersigned have checked the items in the applicable parts 1 to 7 as marked and signed below:</p>
                                <input type="text" name='declaration'>
                            </td>
                        </tr>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_check_part" class="form-table">
                        <tr>
                            <td><span class='bold'>Check</span></td>
                            <td><span class='bold'>Tanker</span></td>
                            <td><span class='bold'>Terminal</span></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_check_part_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['check_part'][$i] = $row['check_part'];
                                $i++;
                            }

                            $a = 0;

                            while ($a < count($data_list['check_part'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['check_part'][$a]; echo "</td>
                                    <td><input type='text' name='tanker_check_$a'></td>
                                    <td><input type='text' name='terminal_check_$a'></td>
                                </tr>";

                                $a++;
                            }
                        ?>
                    </table>
                </div>

                <div class="accordance">
                    <p>In accordance with the guidance in chapter 25 of ISGOTT, we have satisfied ourselves that the entries we have made are correct to the best of our knowledge and that the tanker and terminal are in agreement to undertake the transfer operation.</p>
                    <p>We have also agreed to carry out the repetitive checks noted in parts 8 and 9 of the ISGOTT SSSCL, which should occur at intervals of not more than <span class="bold">4</span> hours for the tanker and not more than <span class="bold">4</span> hours for the terminal.</p>
                    <p>If, to our knowledge, the status of any item changes, we will immediately inform the other party.</p>
                </div>
                
                <div class="table-container">
                    <table class='form-table'>
                        <tr>
                            <th>Tanker</th>
                            <th>Terminal</th>
                        </tr>
                        <tr>
                            <td>
                                <div class="signature">
                                    <p>Name:</p>
                                    <input type='text' name='name_tanker'>
                                </div>
                            </td>
                            <td>
                                <div class="signature">
                                    <p>Name:</p>
                                    <input type='text' name='name_terminal'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="signature">
                                    <p>Rank:</p>
                                    <input type='text' name='rank_tanker'>
                                </div>
                            </td>
                            <td>
                                <div class="signature">
                                    <p>Rank:</p>
                                    <input type='text' name='rank_terminal'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="signature">
                                    <p>Signature:</p>
                                    <input type='text' name='signature_tanker' disabled>
                                </div>
                            </td>
                            <td>
                                <div class="signature">
                                    <p>Signature:</p>
                                    <input type='text' name='signature_terminal' disabled>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="signature">
                                    <p>Date:</p>
                                    <input type='date' name='date_tanker'>
                                </div>
                            </td>
                            <td>
                                <div class="signature">
                                    <p>Date:</p>
                                    <input type='date' name='date_terminal'>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <div class="signature">
                                    <p>Time:</p>
                                    <input type='time' name='time_tanker'>
                                </div>
                            </td>
                            <td>
                                <div class="signature">
                                    <p>Time:</p>
                                    <input type='time' name='time_terminal'>
                                </div>
                            </td>
                        </tr>
                    </table>
                </div>
                <div class="table-container">
                    <table id="safety_list_8_tanker" class="form-table">
                        <tr><th colspan='12'>Part 8. Tanker: repetitive checks during and after transfer</th></tr>
                        <tr>
                            <td><span class='bold'>Item ref.</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                        </tr>
                        <tr>
                            <td colspan='2'>Interval time: <input type="number" name='interv_time_8' min="0"> hours</td>
                            <td><input type='datetime-local' name='time_8_1_0'></td>
                            <td><input type='datetime-local' name='time_8_2_0'></td>
                            <td><input type='datetime-local' name='time_8_3_0'></td>
                            <td><input type='datetime-local' name='time_8_4_0'></td>
                            <td><input type='datetime-local' name='time_8_5_0'></td>
                            <td><input type='datetime-local' name='time_8_6_0'></td>
                            <td><input type='datetime-local' name='time_8_7_0'></td>
                            <td><input type='datetime-local' name='time_8_8_0'></td>
                            <td><input type='datetime-local' name='time_8_9_0'></td>
                            <td><input type='datetime-local' name='time_8_10_0'></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_8_tanker_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_8'][$i] = $row['item_8'];
                                $data_list['check_8'][$i] = $row['check_8'];
                                $i++;
                            }

                            $a = 0;
                            $i = 1;

                            while ($a < count($data_list['check_8'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_8'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_8'][$a]; echo "</td>
                                    
                                    <td>
                                        <select name='time_8_1_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_2_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_3_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_4_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_5_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_6_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_7_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_8_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_9_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_8_10_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                </tr>";

                                $a++;
                                $i++;
                            }
                        ?>
                    </table>
                </div>

                <div class="table-container">
                    <table id="safety_list_9_terminal" class="form-table">
                        <tr><th colspan='12'>Part 9. Terminal: repetitive checks during and after transfer</th></tr>
                        <tr>
                            <td><span class='bold'>Item ref.</span></td>
                            <td><span class='bold'>Check</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                            <td><span class="bold">Time</span></td>
                        </tr>
                        <tr>
                            <td colspan='2'>Interval time: <input type="number" name='interv_time_9' min="0"> hours</td>
                            <td><input type='datetime-local' name='time_9_1_0'></td>
                            <td><input type='datetime-local' name='time_9_2_0'></td>
                            <td><input type='datetime-local' name='time_9_3_0'></td>
                            <td><input type='datetime-local' name='time_9_4_0'></td>
                            <td><input type='datetime-local' name='time_9_5_0'></td>
                            <td><input type='datetime-local' name='time_9_6_0'></td>
                            <td><input type='datetime-local' name='time_9_7_0'></td>
                            <td><input type='datetime-local' name='time_9_8_0'></td>
                            <td><input type='datetime-local' name='time_9_9_0'></td>
                            <td><input type='datetime-local' name='time_9_10_0'></td>
                        </tr>

                        <?php
                            $query = "SELECT * FROM safety_list_9_terminal_d";
                            $result = mysqli_query($connection, $query);
                            $data_list = [[], []];
                            $i = 0;

                            while ($row = mysqli_fetch_assoc($result)) {
                                $data_list['item_9'][$i] = $row['item_9'];
                                $data_list['check_9'][$i] = $row['check_9'];
                                $i++;
                            }

                            $a = 0;
                            $i = 1;

                            while ($a < count($data_list['check_9'])) {
                                echo "<tr>
                                    <td>"; echo $data_list['item_9'][$a]; echo "</td>
                                    <td>"; echo $data_list['check_9'][$a]; echo "</td>
                                    <td>
                                        <select name='time_9_1_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_2_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_3_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_4_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_5_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_6_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_7_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_8_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_9_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                    <td>
                                        <select name='time_9_10_$i'>
                                            <option value='' selected>- none -</option>
                                            <option value='✓'>✓</option>
                                            <option value='✘'>✘</option>
                                        </select>
                                    </td>
                                </tr>";

                                $a++;
                                $i++;
                            }
                        ?>
                    </table>
                </div>
            </div>            

            <div class="options">
                <!-- <input type="button" class="return" onclick="clearFormData()" value="Limpiar formulario"> -->
                <input type="button" class="submit" onclick="saveUnfinishedForm()" value="Guardar borrador">
                <input type="button" id="guardar-boton" class="submit" value="Guardar y cerrar operación">
            </div>

            <div id="verificacion">
                <h1>Cierre de Ship Shore Safety Check List</h1>
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
    <!-- <script src="../../../assets/js/localstorage/safety-list.js"></script> -->
    <script src="../../../assets/js/forms/safety-list.js"></script>
</body>

</html>