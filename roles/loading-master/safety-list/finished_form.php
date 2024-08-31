<?php
    include "../../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo'])) {
        header('Location: ../../../signin.php');
        exit();
    } else {
        if (!isset($_POST['id_safety_buque'])) {
            header('Location: safety_lists_finished.php');
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
    <title>Ship Shore Safety Check List finalizado</title>
    <link rel="stylesheet" href="../../../assets/css/forms/safety-list/finished-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php
        include_once "../components/safety_list_menu.php";
        $id_safety_buque = $_POST['id_safety_buque'];
    ?>

    <div id="content">
        <div class="pdf-content" id='pdf-content'>
            <div class="pdf-nav">
                <div>Ship Shore Safety Check List</div>
                <img src="../../../assets/img/logo.svg" alt="Logo de Oiltanking">
            </div>
            <hr>
             
            <?php
                $query = "SELECT * FROM safety_list_buque WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['date_time'] = $row['date_time'];
                    $data_table['port'] = $row['port'];
                    $data_table['tanker'] = $row['tanker'];
                    $data_table['terminal'] = $row['terminal'];
                    $data_table['product_trans'] = $row['product_trans'];
                }
            ?>

            <table id="safety_list_buque" class="pdf-table-one">
                <tr class="table-header">
                    <th colspan="2"><p>Ship Shore Safety Check List</p></th>
                </tr>
                <tr>
                    <td><p class="bold">Date and time:</p></td>
                    <td><p><?php if (isset($data_table['date_time'])) { echo $data_table['date_time']; } ?></p></td>
                </tr>
                <tr>
                    <td><p class="bold">Port:</p></td>
                    <td><p><?php if (isset($data_table['port'])) { echo $data_table['port']; } ?></p></td>
                </tr>
                <tr>
                    <td><p class="bold">Tanker:</p></td>
                    <td><p><?php if (isset($data_table['tanker'])) { echo $data_table['tanker']; } ?></p></td>
                </tr>
                <tr>
                    <td><p class="bold">Terminal:</p></td>
                    <td><p><?php if (isset($data_table['terminal'])) { echo $data_table['terminal']; } ?></p></td>
                </tr>
                <tr>
                    <td><p class="bold">Product to be transferred:</p></td>
                    <td><p><?php if (isset($data_table['product_trans'])) { echo $data_table['product_trans']; } ?></p></td>
                </tr>
            </table>
                
            <?php
                $query = "SELECT * FROM safety_list_1a_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_1a'][$i] = $row['status_1a'];
                    $data_table['remarks_1a'][$i] = $row['remarks_1a'];
                    $i++;
                }
            ?>

            <table id="safety_list_1a_tanker" class="pdf-table-two">
                <tr class="table-header">
                    <th colspan='5'><p>Part 1A. Tanker: checks pre-arrival</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_1a'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_1a'][$a]; echo "</p></td>
                                    
                            <td><p class='center'>";
                                if (isset($data_table['status_1a'][$a])) {
                                    echo $data_table['status_1a'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_1a'][$a])) { echo $data_table['remarks_1a'][$a]; } echo "</p></td>
                        </tr>";
                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_1b_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_1b'][$i] = $row['status_1b'];
                    $data_table['remarks_1b'][$i] = $row['remarks_1b'];
                    $i++;
                }
            ?>

            <table id="safety_list_1b_tanker" class="pdf-table-tree">
                <tr class="table-header">
                    <th colspan='5'><p>Part 1B. Tanker: checks pre-arrival if using an inert gas system</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_1b'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_1b'][$a]; echo "</p></td>

                            <td><p class='center'>";
                                if (isset($data_table['status_1b'][$a])) {
                                    echo $data_table['status_1b'][$a];
                                }
                            echo "</p></td>
                            
                            <td><p class='center'>"; if (isset($data_table['remarks_1b'][$a])) { echo $data_table['remarks_1b'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>
            
            <?php
                $query = "SELECT * FROM safety_list_2_terminal WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_2'][$i] = $row['status_2'];
                    $data_table['remarks_2'][$i] = $row['remarks_2'];
                    $i++;
                }
            ?>

            <table id="safety_list_2_terminal" class="pdf-table-four">
                <tr class="table-header">
                    <th colspan='5'><p>Part 2. Terminal: checks pre-arrival</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_2'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_2'][$a]; echo "</p></td>
                            
                            <td><p class='center'>";
                                if (isset($data_table['status_2'][$a])) {
                                    echo $data_table['status_2'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_2'][$a])) { echo $data_table['remarks_2'][$a]; } echo "</p></td>
                        </tr>";
                        
                        $a++;
                    }
                ?>
            </table>
            
            <?php
                $query = "SELECT * FROM safety_list_3_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_3'][$i] = $row['status_3'];
                    $data_table['remarks_3'][$i] = $row['remarks_3'];
                    $i++;
                }
            ?>

            <table id="safety_list_3_tanker" class="pdf-table-five">
                <tr class="table-header">
                    <th colspan='5'><p>Part 3. Tanker: checks after mooring</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_3'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_3'][$a]; echo "</p></td>
                                
                            <td><p class='center'>";
                                if (isset($data_table['status_3'][$a])) {
                                    echo $data_table['status_3'][$a];
                                }
                            echo "</p></td>
                            
                            <td><p class='center'>"; if (isset($data_table['remarks_3'][$a])) { echo $data_table['remarks_3'][$a]; } echo "</p></td>
                        </tr>";
                        
                        $a++;
                    }
                ?>
            </table>
            
            <?php
                $query = "SELECT * FROM safety_list_4_terminal WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_4'][$i] = $row['status_4'];
                    $data_table['remarks_4'][$i] = $row['remarks_4'];
                    $i++;
                }
            ?>

            <table id="safety_list_4_terminal" class="pdf-table-six">
                <tr class="table-header">
                    <th colspan='5'><p>Part 4. Terminal: checks after mooring</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_4'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_4'][$a]; echo "</p></td>
                                
                            <td><p class='center'>";
                                if (isset($data_table['status_4'][$a])) {
                                    echo $data_table['status_4'][$a];
                                }
                            echo "</p></td>
                            
                            <td><p class='center'>"; if (isset($data_table['remarks_4'][$a])) { echo $data_table['remarks_4'][$a]; } echo "</p></td>
                        </tr>";
                        
                        $a++;
                    }
                ?>
            </table>
            
            <?php
                $query = "SELECT * FROM safety_list_5a_tanker_terminal WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_tanker_5a'][$i] = $row['status_tanker_5a'];
                    $data_table['status_terminal_5a'][$i] = $row['status_terminal_5a'];
                    $data_table['remarks_5a'][$i] = $row['remarks_5a'];
                    $i++;
                }
            ?>
            
            <table id="safety_list_5a_tanker_terminal" class="pdf-table-seven">
                <tr class="table-header">
                    <th colspan='5'><p>Part 5A. Tanker and Terminal: pre-transfer conference</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Tanker status</p></td>
                    <td><p>Terminal status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_5a'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_5a'][$a]; echo "</p></td>
                                
                            <td><p class='center'>";
                                if (isset($data_table['status_tanker_5a'][$a])) {
                                    echo $data_table['status_tanker_5a'][$a];
                                }
                            echo "</p></td>
                            <td><p class='center'>";
                                if (isset($data_table['status_terminal_5a'][$a])) {
                                    echo $data_table['status_terminal_5a'][$a];
                                }
                            echo "</p></td>
                            
                            <td><p class='center'>"; if (isset($data_table['remarks_5a'][$a])) { echo $data_table['remarks_5a'][$a]; } echo "</p></td>
                        </tr>";
                        
                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_5b_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_tanker_5b'][$i] = $row['status_tanker_5b'];
                    $data_table['status_terminal_5b'][$i] = $row['status_terminal_5b'];
                    $data_table['remarks_5b'][$i] = $row['remarks_5b'];

                    $i++;
                }
            ?>
            
            <table id="safety_list_5b_tanker" class="pdf-table-eight">
                <tr class="table-header">
                    <th colspan='5'><p>Additional for chemical tankers - Checks pre-transfer</p></th>
                </tr>
                <tr class="table-header">
                    <th colspan='5'><p>Part 5B. Tanker and terminal: bulk liquid chemicals. Check pre-transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Tanker status</p></td>
                    <td><p>Terminal status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_5b'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_5b'][$a]; echo "</p></td>
                                
                            <td><p class='center'>";
                                if (isset($data_table['status_tanker_5b'][$a])) {
                                    echo $data_table['status_tanker_5b'][$a];
                                }
                            echo "</p></td>
                            <td><p class='center'>";
                                if (isset($data_table['status_terminal_5b'][$a])) {
                                    echo $data_table['status_terminal_5b'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_5b'][$a])) { echo $data_table['remarks_5b'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_5c_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_tanker_5c'][$i] = $row['status_tanker_5c'];
                    $data_table['status_terminal_5c'][$i] = $row['status_terminal_5c'];
                    $data_table['remarks_5c'][$i] = $row['remarks_5c'];
                    $i++;
                }
            ?>

            <table id="safety_list_5c_tanker" class="pdf-table-nine">
                <tr class="table-header">
                    <th colspan='5'><p>Additional for gas tankers - Checks pre-transfer.</p></th>
                </tr>
                <tr class="table-header">
                    <th colspan='5'><p>Part 5C. Tanker and terminal: liquefied gas. Check pre-transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Tanker status</p></td>
                    <td><p>Terminal status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_5c'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_5c'][$a]; echo "</p></td>
                                
                            <td><p class='center'>";
                                if (isset($data_table['status_tanker_5c'][$a])) {
                                    echo $data_table['status_tanker_5c'][$a];
                                }
                            echo "</p></td>
                            <td><p class='center'>";
                                if (isset($data_table['status_terminal_5c'][$a])) {
                                    echo $data_table['status_terminal_5c'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_5c'][$a])) { echo $data_table['remarks_5c'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>
            
            <?php
                $query = "SELECT * FROM safety_list_6_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['tanker_initials_6'][$i] = $row['tanker_initials_6'];
                    $data_table['terminal_initials_6'][$i] = $row['terminal_initials_6'];
                            
                    $i++;
                }
                            
                $query = "SELECT * FROM safety_list_6_details WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_details[$i] = $row['details_6'];
                    $i++;
                }
            ?>

            <table id="safety_list_6_tanker" class="pdf-table-ten">
                <tr class="table-header">
                    <th colspan="6"><p>Part 6. Tanker and Terminal: agreements pre-transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Part 5 Item</p></td>
                    <td><p>Check</p></td>
                    <td colspan="2"><p>Details</p></td>
                    <td><p>Tanker initials</p></td>
                    <td><p>Terminal initials</p></td>
                </tr>
                            
                <tr>
                    <td rowspan="2" class="center"><p>32.</p></td>
                    <td rowspan="2"><p>Tanker manoeuvring readiness</p></td>
                    <td><p>Notice period (maximum) for full readiness to manoeuvre:</p></td>
                    <td><p class="center"><?php if (isset($data_details[0])) { echo $data_details[0]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][0])) { echo $data_table['tanker_initials_6'][0]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][0])) { echo $data_table['terminal_initials_6'][0]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Period of disablement (if permitted):</p></td>
                    <td><p class="center"><?php if (isset($data_details[1])) { echo $data_details[1]; } ?></p></td>
                </tr>

                <tr>
                    <td rowspan="2" class="center"><p>33.</p></td>
                    <td rowspan="2"><p>Security protocols</p></td>
                    <td><p>Security level:</p></td>
                    <td><p class="center"><?php if (isset($data_details[2])) { echo $data_details[2]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][1])) { echo $data_table['tanker_initials_6'][1]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][1])) { echo $data_table['terminal_initials_6'][1]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Local requirements:</p></td>
                    <td><p class="center"><?php if (isset($data_details[3])) { echo $data_details[3]; } ?></p></td>
                </tr>
                                
                <tr>
                    <td rowspan="2" class="center"><p>34.</p></td>
                    <td rowspan="2"><p>Effective tanker / terminal communications</p></td>
                    <td><p>Primary system:</p></td>
                    <td><p class="center"><?php if (isset($data_details[4])) { echo $data_details[4]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][2])) { echo $data_table['tanker_initials_6'][2]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][2])) { echo $data_table['terminal_initials_6'][2]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Backup system:</p></td>
                    <td><p class="center"><?php if (isset($data_details[5])) { echo $data_details[5]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="2" class="center"><p>35.</p></td>
                    <td rowspan="2"><p>Operational supervision and watch keeping</p></td>
                    <td><p>Tanker:</p></td>
                    <td><p class="center"><?php if (isset($data_details[6])) { echo $data_details[6]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][3])) { echo $data_table['tanker_initials_6'][3]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][3])) { echo $data_table['terminal_initials_6'][3]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Terminal:</p></td>
                    <td><p class="center"><?php if (isset($data_details[7])) { echo $data_details[7]; } ?></p></td>
                </tr>
                
                <tr>
                    <td rowspan="2" class="center"><p>37. 38.</p></td>
                    <td rowspan="2"><p>Dedicated smoking areas and naked lights restrictions</p></td>
                    <td><p>Tanker:</p></td>
                    <td><p class="center"><?php if (isset($data_details[8])) { echo $data_details[8]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][4])) { echo $data_table['tanker_initials_6'][4]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][4])) { echo $data_table['terminal_initials_6'][4]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Terminal:</p></td>
                    <td><p class="center"><?php if (isset($data_details[9])) { echo $data_details[9]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="3" class="center"><p>45.</p></td>
                    <td rowspan="3"><p>Maximum wind, current and sea/swell criteria or other environmental factors</p></td>
                    <td><p>Stop cargo transfer:</p></td>
                    <td><p class="center"><?php if (isset($data_details[10])) { echo $data_details[10]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['tanker_initials_6'][5])) { echo $data_table['tanker_initials_6'][5]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['terminal_initials_6'][5])) { echo $data_table['terminal_initials_6'][5]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Disconnect:</p></td>
                    <td><p class="center"><?php if (isset($data_details[11])) { echo $data_details[11]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Unberth:</p></td>
                    <td><p class="center"><?php if (isset($data_details[12])) { echo $data_details[12]; } ?></p></td>
                </tr>
                
                <tr>
                    <td rowspan="5" class="center"><p>45. 46.</p></td>
                    <td rowspan="5"><p>Limits for cargo, bunkers and ballast handling</p></td>
                    <td><p>Maximum transfer rates:</p></td>
                    <td><p class="center"><?php if (isset($data_details[13])) { echo $data_details[13]; } ?></p></td>
                    <td rowspan="5"><p class="center"><?php if (isset($data_table['tanker_initials_6'][6])) { echo $data_table['tanker_initials_6'][6]; } ?></p></td>
                    <td rowspan="5"><p class="center"><?php if (isset($data_table['terminal_initials_6'][6])) { echo $data_table['terminal_initials_6'][6]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Topping-off rates:</p></td>
                    <td><p class="center"><?php if (isset($data_details[14])) { echo $data_details[14]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Maximum manifold pressure:</p></td>
                    <td><p class="center"><?php if (isset($data_details[15])) { echo $data_details[15]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Cargo temperature:</p></td>
                    <td><p class="center"><?php if (isset($data_details[16])) { echo $data_details[16]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Other limitations:</p></td>
                    <td><p class="center"><?php if (isset($data_details[17])) { echo $data_details[17]; } ?></p></td>
                </tr>
                
                <tr>
                    <td rowspan="5" class="center"><p>45. 46.</p></td>
                    <td rowspan="5"><p>Pressure surge control</p></td>
                    <td><p>Minimum number of cargo tanks open:</p></td>
                    <td><p class="center"><?php if (isset($data_details[18])) { echo $data_details[18]; } ?></p></td>
                    <td rowspan="5"><p class="center"><?php if (isset($data_table['tanker_initials_6'][7])) { echo $data_table['tanker_initials_6'][7]; } ?></p></td>
                    <td rowspan="5"><p class="center"><?php if (isset($data_table['terminal_initials_6'][7])) { echo $data_table['terminal_initials_6'][7]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Tank switching protocols:</p></td>
                    <td><p class="center"><?php if (isset($data_details[19])) { echo $data_details[19]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Full load rate:</p></td>
                    <td><p class="center"><?php if (isset($data_details[20])) { echo $data_details[20]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Topping-off rate:</p></td>
                    <td><p class="center"><?php if (isset($data_details[21])) { echo $data_details[21]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Closing time of automatic valves:</p></td>
                    <td><p class="center"><?php if (isset($data_details[22])) { echo $data_details[22]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="2" class="center"><p>46.</p></td>
                    <td rowspan="2"><p>Cargo transfer management procedures</p></td>
                    <td><p>Action notice periods:</p></td>
                    <td><p class="center"><?php if (isset($data_details[23])) { echo $data_details[23]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][8])) { echo $data_table['tanker_initials_6'][8]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][8])) { echo $data_table['terminal_initials_6'][8]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Transfer stop protocols:</p></td>
                    <td><p class="center"><p class="center"><?php if (isset($data_details[24])) { echo $data_details[24]; } ?></p></p></td>
                </tr>
                            
                <tr>
                    <td class="center"><p>50.</p></td>
                    <td><p>Routine for regular checks on cargo transferred are agreed</p></td>
                    <td><p>Routine transferred quantity checks:</p></td>
                    <td><p class="center"><?php if (isset($data_details[25])) { echo $data_details[25]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['tanker_initials_6'][9])) { echo $data_table['tanker_initials_6'][9]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['terminal_initials_6'][9])) { echo $data_table['terminal_initials_6'][9]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="2" class="center"><p>51.</p></td>
                    <td rowspan="2"><p>Emergency signals</p></td>
                    <td><p>Tanker:</p></td>
                    <td><p class="center"><?php if (isset($data_details[26])) { echo $data_details[26]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][10])) { echo $data_table['tanker_initials_6'][10]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][10])) { echo $data_table['terminal_initials_6'][10]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Terminal:</p></td>
                    <td><p class="center"><?php if (isset($data_details[27])) { echo $data_details[27]; } ?></p></td>
                </tr>
                
                <tr>
                    <td class="center"><p>55.</p></td>
                    <td><p>Tank venting system</p></td>
                    <td><p>Procedure:</p></td>
                    <td><p class="center"><?php if (isset($data_details[28])) { echo $data_details[28]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['tanker_initials_6'][11])) { echo $data_table['tanker_initials_6'][11]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['terminal_initials_6'][11])) { echo $data_table['terminal_initials_6'][11]; } ?></p></td>
                </tr>
                                
                <tr>
                    <td class="center"><p>55.</p></td>
                    <td><p>Closed operations</p></td>
                    <td><p>Requirements:</p></td>
                    <td><p class="center"><?php if (isset($data_details[29])) { echo $data_details[29]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['tanker_initials_6'][12])) { echo $data_table['tanker_initials_6'][12]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['terminal_initials_6'][12])) { echo $data_table['terminal_initials_6'][12]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="2" class="center"><p>56.</p></td>
                    <td rowspan="2"><p>Vapour return line</p></td>
                    <td><p>Operational parameters:</p></td>
                    <td><p class="center"><?php if (isset($data_details[30])) { echo $data_details[30]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['tanker_initials_6'][13])) { echo $data_table['tanker_initials_6'][13]; } ?></p></td>
                    <td rowspan="2"><p class="center"><?php if (isset($data_table['terminal_initials_6'][13])) { echo $data_table['terminal_initials_6'][13]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Maximum flow rate:</p></td>
                    <td><p class="center"><?php if (isset($data_details[31])) { echo $data_details[31]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="3" class="center"><p>60.</p></td>
                    <td rowspan="3"><p>Nitrogen supply from terminal</p></td>
                    <td><p>Procedures to receive:</p></td>
                    <td><p class="center"><?php if (isset($data_details[32])) { echo $data_details[32]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['tanker_initials_6'][14])) { echo $data_table['tanker_initials_6'][14]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['terminal_initials_6'][14])) { echo $data_table['terminal_initials_6'][14]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Maximum pressure:</p></td>
                    <td><p class="center"><?php if (isset($data_details[33])) { echo $data_details[33]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Flow rate:</p></td>
                    <td><p class="center"><?php if (isset($data_details[34])) { echo $data_details[34]; } ?></p></td>
                </tr>
                            
                <tr>
                    <td rowspan="3" class="center"><p>83.</p></td>
                    <td rowspan="3"><p>For gas tanker only: cargo tank relief valve settings</p></td>
                    <td><p>Tank 1:</p></td>
                    <td><p class="center"><?php if (isset($data_details[35])) { echo $data_details[35]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['tanker_initials_6'][15])) { echo $data_table['tanker_initials_6'][15]; } ?></p></td>
                    <td rowspan="3"><p class="center"><?php if (isset($data_table['terminal_initials_6'][15])) { echo $data_table['terminal_initials_6'][15]; } ?></p></td>
                </tr>

                <tr>
                    <td><p>Tank 2:</p></td>
                    <td><p class="center"><?php if (isset($data_details[36])) { echo $data_details[36]; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Tank 3:</p></td>
                    <td><p class="center"><?php if (isset($data_details[37])) { echo $data_details[37]; } ?></p></td>
                </tr>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_7a_general WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_7a'][$i] = $row['status_7a'];
                    $data_table['remarks_7a'][$i] = $row['remarks_7a'];
                           
                    $i++;
                }
            ?>

            <table id="safety_list_7a_general" class="pdf-table-eleven">
                <tr class="table-header">
                    <th colspan='5'><p>Part 7A. General tanker: checks pre-transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_7a'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_7a'][$a]; echo "</p></td>

                            <td><p class='center'>";
                                if (isset($data_table['status_7a'][$a])) {
                                    echo $data_table['status_7a'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_7a'][$a])) { echo $data_table['remarks_7a'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_7b_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_7b'][$i] = $row['status_7b'];
                    $data_table['remarks_7b'][$i] = $row['remarks_7b'];
                           
                    $i++;
                }
            ?>

            <table id="safety_list_7b_tanker" class="pdf-table-twelve">
                <tr class="table-header">
                    <th colspan='5'><p>Part 7B. Tanker: checks pre-transfer if crude oil washing is planned</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_7b'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_7b'][$a]; echo "</p></td>

                            <td><p class='center'>";
                                if (isset($data_table['status_7b'][$a])) {
                                    echo $data_table['status_7b'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_7b'][$a])) { echo $data_table['remarks_7b'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_7c_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['status_7c'][$i] = $row['status_7c'];
                    $data_table['remarks_7c'][$i] = $row['remarks_7c'];
                           
                    $i++;
                }
            ?>

            <table id="safety_list_7c_tanker" class="pdf-table-thriteen">
                <tr class="table-header">
                    <th colspan='5'><p>Part 7C. Tanker: checks prior to tank cleaning ans/or gas freeing</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item</p></td>
                    <td><p>Check</p></td>
                    <td><p>Status</p></td>
                    <td><p>Remarks</p></td>
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
                            <td><p class='center'>"; echo $data_list['item_7c'][$a]; echo "</p></td>
                            <td><p>"; echo $data_list['check_7c'][$a]; echo "</p></td>

                            <td><p class='center'>";
                                if (isset($data_table['status_7c'][$a])) {
                                    echo $data_table['status_7c'][$a];
                                }
                            echo "</p></td>

                            <td><p class='center'>"; if (isset($data_table['remarks_7c'][$a])) { echo $data_table['remarks_7c'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_ungrouped WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $declaration = $row['declaration'];
                }
            ?>
            
            <table id='safety_list_ungrouped'>
                <tr class="table-header">
                    <th><p>Declaration</p></th>
                </tr>
                <tr>
                    <td>
                        <p>We the undersigned have checked the items in the applicable parts 1 to 7 as marked and signed below:</p>
                        <p><?php if (isset($declaration)) { echo $declaration; } ?></p>
                    </td>
                </tr>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_check_part WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['tanker_check'][$i] = $row['tanker_check'];
                    $data_table['terminal_check'][$i] = $row['terminal_check'];
                           
                    $i++;
                }
            ?>
            
            <table id="safety_list_check_part" class="pdf-table-fourteen">
                <tr class="table-subtitles">
                    <td><p>Check</p></td>
                    <td><p>Tanker</p></td>
                    <td><p>Terminal</p></td>
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
                            <td><p>"; echo $data_list['check_part'][$a]; echo "</p></td>
                            <td><p class='center'>"; if (isset($data_table['tanker_check'][$a])) { echo $data_table['tanker_check'][$a]; } echo "</p></td>
                            <td><p class='center'>"; if (isset($data_table['terminal_check'][$a])) { echo $data_table['terminal_check'][$a]; } echo "</p></td>
                        </tr>";

                        $a++;
                    }
                ?>
            </table>
            
            <div class="accordance">
                <p>In accordance with the guidance in chapter 25 of ISGOTT, we have satisfied ourselves that the entries we have made are correct to the best of our knowledge and that the tanker and terminal are in agreement to undertake the transfer operation.</p>
                <p>We have also agreed to carry out the repetitive checks noted in parts 8 and 9 of the ISGOTT SSSCL, which should occur at intervals of not more than <span class="bold">4</span> hours for the tanker and not more than <span class="bold">4</span> hours for the terminal.</p>
                <p>If, to our knowledge, the status of any item changes, we will immediately inform the other party.</p>
            </div>
            
            <?php
                $query = "SELECT * FROM safety_list_firma WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $name_tanker = $row['name_tanker'];
                    $name_terminal = $row['name_terminal'];
                    $rank_tanker = $row['rank_tanker'];
                    $rank_terminal = $row['rank_terminal'];
                    $signature_tanker = $row['signature_tanker'];
                    $signature_terminal = $row['signature_terminal'];
                    $date_tanker = $row['date_tanker'];
                    $date_terminal = $row['date_terminal'];
                    $time_tanker = $row['time_tanker'];
                    $time_terminal = $row['time_terminal'];

                    $i++;
                }
            ?>
            
            <table id='safety_list_firma' class="pdf-table-eighteen">
                <tr class="table-header">
                    <th><p>Tanker</p></th>
                    <th><p>Terminal</p></th>
                </tr>
                <tr>
                    <td><p>Name: <?php if (isset($name_tanker)) { echo $name_tanker; } ?></p></td>
                    <td><p>Name: <?php if (isset($name_terminal)) { echo $name_terminal; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Rank: <?php if (isset($rank_tanker)) { echo $rank_tanker; } ?></p></td>
                    <td><p>Rank: <?php if (isset($rank_terminal)) { echo $rank_terminal; } ?></p></td>
                </tr>
                <tr class="table-signatures">
                    <td><p>Signature: <?php if (isset($signature_tanker)) { echo $signature_tanker; } ?></p></td>
                    <td><p>Signature: <?php if (isset($signature_terminal)) { echo $signature_terminal; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Date: <?php if (isset($date_tanker)) { echo $date_tanker; } ?></p></td>
                    <td><p>Date: <?php if (isset($date_terminal)) { echo $date_terminal; } ?></p></td>
                </tr>
                <tr>
                    <td><p>Time: <?php if (isset($time_tanker)) { echo $time_tanker; } ?></p></td>
                    <td><p>Time: <?php if (isset($time_terminal)) { echo $time_terminal; } ?></p></td>
                </tr>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_8_tanker WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], [], [], [], [], [], [], [], [], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['time_8_1'][$i] = $row['time_8_1'];
                    $data_table['time_8_2'][$i] = $row['time_8_2'];
                    $data_table['time_8_3'][$i] = $row['time_8_3'];
                    $data_table['time_8_4'][$i] = $row['time_8_4'];
                    $data_table['time_8_5'][$i] = $row['time_8_5'];

                    $data_table['time_8_6'][$i] = $row['time_8_6'];
                    $data_table['time_8_7'][$i] = $row['time_8_7'];
                    $data_table['time_8_8'][$i] = $row['time_8_8'];
                    $data_table['time_8_9'][$i] = $row['time_8_9'];
                    $data_table['time_8_10'][$i] = $row['time_8_10'];
                    
                    $i++;
                }
                        
                $query = "SELECT * FROM safety_list_ungrouped WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                
                while ($row = mysqli_fetch_assoc($result)) {
                    $interv_time_8 = $row['interv_time_8'];
                }
            ?>

            <table id="safety_list_8_tanker" class="pdf-table-fifteen">
                <tr class="table-header">
                    <th colspan='12'><p>Part 8. Tanker: repetitive checks during and after transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item ref.</p></td>
                    <td><p>Check</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                </tr>
                <tr>
                    <td colspan='2'><p class="bold">Interval time: <?php if (isset($interv_time_8)) { echo $interv_time_8; } ?> hours</p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_1'][0])) { echo $data_table['time_8_1'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_2'][0])) { echo $data_table['time_8_2'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_3'][0])) { echo $data_table['time_8_3'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_4'][0])) { echo $data_table['time_8_4'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_5'][0])) { echo $data_table['time_8_5'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_6'][0])) { echo $data_table['time_8_6'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_7'][0])) { echo $data_table['time_8_7'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_8'][0])) { echo $data_table['time_8_8'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_9'][0])) { echo $data_table['time_8_9'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_8_10'][0])) { echo $data_table['time_8_10'][0]; } ?></p></td>
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
                        echo "<tr>";
                            if ($a < count($data_list['check_8']) - 1) {
                                echo "<td><p class='center'>"; echo $data_list['item_8'][$a]; echo "</p></td>
                                <td><p>"; echo $data_list['check_8'][$a]; echo "</p></td>";
                            } else {
                                echo "<td colspan='2'><p class='bold'>"; echo $data_list['check_8'][$a]; echo "</p></td>";
                            }
                                    
                            echo "<td><p>";
                                if (isset($data_table['time_8_1'][$i])) {
                                    echo $data_table['time_8_1'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_2'][$i])) {
                                    echo $data_table['time_8_2'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_3'][$i])) {
                                    echo $data_table['time_8_3'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_4'][$i])) {
                                    echo $data_table['time_8_4'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_5'][$i])) {
                                    echo $data_table['time_8_5'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_6'][$i])) {
                                    echo $data_table['time_8_6'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_7'][$i])) {
                                    echo $data_table['time_8_7'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_8'][$i])) {
                                    echo $data_table['time_8_8'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_9'][$i])) {
                                    echo $data_table['time_8_9'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_8_10'][$i])) {
                                    echo $data_table['time_8_10'][$i];
                                }
                            echo "</p></td>
                        </tr>";

                        $a++;
                        $i++;
                    }
                ?>
            </table>

            <?php
                $query = "SELECT * FROM safety_list_9_terminal WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);
                $data_table = [[], [], [], [], [], [], [], [], [], [], [], []];
                $i = 0;

                while ($row = mysqli_fetch_assoc($result)) {
                    $data_table['time_9_1'][$i] = $row['time_9_1'];
                    $data_table['time_9_2'][$i] = $row['time_9_2'];
                    $data_table['time_9_3'][$i] = $row['time_9_3'];
                    $data_table['time_9_4'][$i] = $row['time_9_4'];
                    $data_table['time_9_5'][$i] = $row['time_9_5'];

                    $data_table['time_9_6'][$i] = $row['time_9_6'];
                    $data_table['time_9_7'][$i] = $row['time_9_7'];
                    $data_table['time_9_8'][$i] = $row['time_9_8'];
                    $data_table['time_9_9'][$i] = $row['time_9_9'];
                    $data_table['time_9_10'][$i] = $row['time_9_10'];
                    
                    $i++;
                }
                        
                $query = "SELECT * FROM safety_list_ungrouped WHERE id_safety_buque = '$id_safety_buque';";
                $result = mysqli_query($connection, $query);

                while ($row = mysqli_fetch_assoc($result)) {
                    $interv_time_9 = $row['interv_time_9'];
                }
            ?>
            
            <table id="safety_list_9_terminal" class="pdf-table-sixteen">
                <tr class="table-header">
                    <th colspan='12'><p>Part 9. Terminal: repetitive checks during and after transfer</p></th>
                </tr>
                <tr class="table-subtitles">
                    <td><p>Item ref.</p></td>
                    <td><p>Check</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                    <td><p>Time</p></td>
                </tr>
                <tr>
                    <td colspan='2'><p class="bold">Interval time: <?php if (isset($interv_time_9)) { echo $interv_time_9; } ?> hours</p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_1'][0])) { echo $data_table['time_9_1'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_2'][0])) { echo $data_table['time_9_2'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_3'][0])) { echo $data_table['time_9_3'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_4'][0])) { echo $data_table['time_9_4'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_5'][0])) { echo $data_table['time_9_5'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_6'][0])) { echo $data_table['time_9_6'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_7'][0])) { echo $data_table['time_9_7'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_8'][0])) { echo $data_table['time_9_8'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_9'][0])) { echo $data_table['time_9_9'][0]; } ?></p></td>
                    <td><p class="center"><?php if (isset($data_table['time_9_10'][0])) { echo $data_table['time_9_10'][0]; } ?></p></td>
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
                        echo "<tr>";
                            if ($a < count($data_list['check_9']) - 1) {
                                echo "<td><p class='center'>"; echo $data_list['item_9'][$a]; echo "</p></td>
                                <td><p>"; echo $data_list['check_9'][$a]; echo "</p></td>";
                            } else {
                                echo "<td colspan='2'><p class='bold'>"; echo $data_list['check_9'][$a]; echo "</p></td>";
                            }

                            echo "<td><p>";
                                if (isset($data_table['time_9_1'][$i])) {
                                    echo $data_table['time_9_1'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_2'][$i])) {
                                    echo $data_table['time_9_2'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_3'][$i])) {
                                    echo $data_table['time_9_3'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_4'][$i])) {
                                    echo $data_table['time_9_4'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_5'][$i])) {
                                    echo $data_table['time_9_5'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_6'][$i])) {
                                    echo $data_table['time_9_6'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_7'][$i])) {
                                    echo $data_table['time_9_7'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_8'][$i])) {
                                    echo $data_table['time_9_8'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_9'][$i])) {
                                    echo $data_table['time_9_9'][$i];
                                }
                            echo "</p></td>
                            <td><p>";
                                if (isset($data_table['time_9_10'][$i])) {
                                    echo $data_table['time_9_10'][$i];
                                }
                            echo "</p></td>
                        </tr>";

                        $a++;
                        $i++;
                    }
                ?>
            </table>

            <!-- <hr>
            <div class="pdf-footer">
                <p>Documento: FORM-0220-OTAS</p>
                <p>Version: <span class="bold italic underline">03</span></p>
                <p>Page 1 of 1</p>
            </div> -->
        </div>
    </div>

    <div class="pdf-print">
        <button id="botonImprimir" class="print-button">Ver impresión</button>
    </div>
        
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/1.5.3/jspdf.debug.js"></script>
    <script src="../../../assets/js/general.js"></script>
    <script src="../../../assets/js/print/safety-list.js"></script>
</body>
</html>