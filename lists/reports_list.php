<?php
    include "../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 2 && $_SESSION['tipo_usuario'] != 3) {
        header('Location: ../signin.php');
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
    <title>Lista de reportes</title>
    <link rel="stylesheet" href="../assets/css/lists/reports-list.css">
    <link rel="icon" href="../assets/img/favicon.ico">
</head>

<body>
    <?php
        if ($_SESSION['tipo_usuario'] == 2) {
            include_once "../roles/land-inspector/components/land_inspector_menu.php";
        } else {
            include_once "../roles/administrator/components/administrator_menu.php";
        }
    ?>

    <div class="content" id="content">
        <h2>Lista de reportes</h2>

        <!-- PENDIENTE: mejorar criterios de búsqueda, como fecha o tipo de reporte -->
        <div class="searching">
            <input type="search" id="reports-search" placeholder="Buscar reporte...">
        </div>

        <?php
            // Obtener lista de reportes
            /* $query = "SELECT '1' AS tipo_formulario, A.id_buque AS id, A.buque AS buque, DATE_FORMAT(A.fecha_hora_inicio, '%d/%m/%Y %H:%i') AS fecha FROM ins_pre_detalles A 
            UNION ALL 
            SELECT '2' AS tipo_formulario, B.num_operacion AS id, B.buque AS buque, DATE_FORMAT(B.laycan_inicio, '%d/%m/%Y') AS fecha FROM est_hec_buque B 
            UNION ALL 
            SELECT '3' AS tipo_formulario, C.id_term_buque AS id, C.buque AS buque, DATE_FORMAT(C.fecha_trans, '%d/%m/%Y') AS fecha FROM res_trans_buque C 
            UNION ALL 
            SELECT '4' AS tipo_formulario, D.id_safety_buque AS id, C.buque AS buque, DATE_FORMAT(D.date_time, '%d/%m/%Y %H:%i') AS fecha FROM safety_list_buque D 
            INNER JOIN res_trans_buque C ON C.id_term_buque = D.id_term_buque 
            UNION ALL 
            SELECT '5' AS tipo_formulario, E.id_data_trans AS id, C.buque AS buque, CONCAT(E.mes, ' de ', E.año) AS fecha FROM data_trans_buque E 
            INNER JOIN safety_list_buque D ON D.id_safety_buque = E.id_safety_buque 
            INNER JOIN res_trans_buque C ON C.id_term_buque = D.id_term_buque;"; */
            $query = "SELECT '1' AS tipo_formulario, A.id_buque AS id, A.buque AS buque, DATE_FORMAT(A.fecha_hora_inicio, '%d/%m/%Y %H:%i') AS fecha FROM ins_pre_detalles A 
            UNION ALL 
            SELECT '2' AS tipo_formulario, B.num_operacion AS id, B.buque AS buque, DATE_FORMAT(B.laycan_inicio, '%d/%m/%Y') AS fecha FROM est_hec_buque B 
            UNION ALL 
            SELECT '3' AS tipo_formulario, C.id_term_buque AS id, C.buque AS buque, DATE_FORMAT(C.fecha_trans, '%d/%m/%Y') AS fecha FROM res_trans_buque C 
            UNION ALL 
            SELECT '4' AS tipo_formulario, D.id_safety_buque AS id, C.buque AS buque, DATE_FORMAT(D.date_time, '%d/%m/%Y %H:%i') AS fecha FROM safety_list_buque D 
            INNER JOIN res_trans_buque C ON C.id_term_buque = D.id_term_buque 
            UNION ALL 
            SELECT '5' AS tipo_formulario, E.id_data_trans AS id, E.id_buque AS buque, CONCAT(E.mes, ' de ', E.año) AS fecha FROM data_trans_buque E;";
            $result = mysqli_query($connection, $query);
        ?>

        <table class="list-desktop">
            <thead>
                <tr>
                    <th>Tipo de reporte</th>
                    <th>Buque</th>
                    <th>Fecha</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="result-desktop">
                        <td>
                            <?php
                                switch ($row["tipo_formulario"]) {
                                    case '1':
                                        echo "Inspección pre-arribo";
                                        break;
                                    case '2':
                                        echo "Estado de hechos";
                                        break;
                                    case '3':
                                        echo "Resumen de transferencia";
                                        break;
                                    case '4':
                                        echo "Ship Shore Safety Check List";
                                        break;
                                    case '5':
                                        echo "Datos de transferencia";
                                        break;
                                    default:
                                        echo "Otro formulario";
                                        break;
                                }
                            ?>
                        </td>
                        <td><?php echo $row["buque"]; ?></td>
                        <td><?php echo $row["fecha"]; ?></td>
                        
                        <td>
                            <form action="<?php
                                switch ($row["tipo_formulario"]) {
                                    case '1':
                                        echo "../roles/loading-master/pre-arrival-inspection/finished_form.php";
                                        break;
                                    case '2':
                                        echo "../roles/loading-master/statement-of-facts/finished_form.php";
                                        break;
                                    case '3':
                                        echo "../roles/loading-master/transferring-summary/finished_form.php";
                                        break;
                                    case '4':
                                        echo "../roles/loading-master/safety-list/finished_form.php";
                                        break;
                                    case '5':
                                        echo "../roles/land-inspector/transferring-data/finished_form.php";
                                        break;
                                    default:
                                        echo "";
                                        break;
                                }
                            ?>" method="POST">
                                <input type="hidden" name="<?php
                                    switch ($row["tipo_formulario"]) {
                                        case '1':
                                            echo "id_buque";
                                            break;
                                        case '2':
                                            echo "num_operacion";
                                            break;
                                        case '3':
                                            echo "id_term_buque";
                                            break;
                                        case '4':
                                            echo "id_safety_buque";
                                            break;
                                        case '5':
                                            echo "id_data_trans";
                                            break;
                                        default:
                                            echo "";
                                            break;
                                    }
                                ?>" value="<?php echo $row["id"]; ?>" readonly>
                                <input type="submit" class="submit" value="Ver reporte">
                            </form>
                        </td>
                    </tr>
                <?php }

                /* Si la consulta no ha arrojado resultados */
                if ($result->num_rows == 0) { ?>
                    <tr>
                        <td colspan="6">
                            <p class="italic">No se encontraron resultados</p>
                        </td>
                    </tr>
                <?php } ?>

                <!-- Si en la búsqueda no aparecen resultados -->
                <tr id="no-search-results" class="filter">
                    <td colspan="6">
                        <p class="italic">No se encontraron resultados</p>
                    </td>
                </tr>
            </tbody>
        </table>
        
        <div class="list-mobile">
            <p class="sentence">Clic en el recuadro correspondiente para ver el reporte.</p>

            <?php
            // Vuelve al principio del arreglo de resultados y lo recorre nuevamente
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <form id="result-mobile" action="../roles/loading-master/pre-arrival-inspection/finished_form.php" method="POST">
                    <input type="hidden" name="id_buque" value="<?php echo $row["id"]; ?>" readonly>
                    <button class="mobile-result">
                        <p class="bold">
                            <?php
                                switch ($row["tipo_formulario"]) {
                                    case '1':
                                        echo "Inspección pre-arribo";
                                        break;
                                    case '2':
                                        echo "Estado de hechos";
                                        break;
                                    case '3':
                                        echo "Resumen de transferencia";
                                        break;
                                    case '4':
                                        echo "Ship Shore Safety Check List";
                                        break;
                                    case '5':
                                        echo "Datos de transferencia";
                                        break;
                                    default:
                                        echo "Otro formulario";
                                        break;
                                }
                            ?>
                        </p>
                        <p><?php echo $row["buque"]; ?></p>
                        <p class="italic"><?php echo $row["fecha"]; ?></p>
                    </button>
                </form>
            <?php }

            /* Si la consulta no ha arrojado resultados */
            if ($result->num_rows == 0) { ?>
                <p class="no-results">No se encontraron resultados</p>
            <?php } ?>

            <!-- Si en la búsqueda no aparecen resultados -->
            <div id="no-search-results" class="filter">
                <p class="no-results">No se encontraron resultados</p>
            </div>
        </div>
    </div>

    <script src="../assets/js/general.js"></script>
    <script src="../assets/js/search/reports-search.js"></script>
</body>

</html>