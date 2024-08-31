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
    <title>Lista de operaciones</title>
    <link rel="stylesheet" href="../assets/css/lists.css">
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
        <h2>Lista de operaciones</h2>

        <div class="searching">
            <input type="search" id="operations-search" placeholder="Buscar por buque o laycan...">
            <!-- <div class="checking">
                <input type="checkbox" id="unfinished">
                <label for="unfinished">Mostrar no finalizadas</label>
            </div> -->
        </div>

        <?php
            // Obtener lista de operaciones
            $query = "SELECT num_operacion, buque, DATE_FORMAT(laycan_inicio, '%d/%m/%Y') AS laycan, finalizado AS estado FROM est_hec_buque;";
            $result = mysqli_query($connection, $query);
        ?>

        <table class="list-desktop">
            <thead>
                <tr>
                    <th>N° de operación</th>
                    <th>Buque</th>
                    <th>Laycan</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>

            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="result-desktop"
                    <?php if ($row["estado"] == 0) {
                        /* echo "class='filter'"; */
                    } ?>>
                        <td><?php echo $row["num_operacion"]; ?></td>
                        <td><?php echo $row["buque"]; ?></td>
                        <td><?php echo $row["laycan"]; ?></td>
                        <td>
                            <?php
                                if ($row["estado"] == 1) {
                                    echo "Finalizada";
                                } else {
                                    echo "No finalizada";
                                }
                            ?>
                        </td>
                        <td>
                            <form action="../roles/loading-master/statement-of-facts/finished_form.php" method="POST">
                                <input type="hidden" name="num_operacion" value="<?php echo $row["num_operacion"]; ?>" readonly>
                                <input type="submit" class="submit" value="Ver formulario">
                            </form>
                        </td>
                    </tr>
                <?php }

                /* Si la consulta no ha arrojado resultados */
                if ($result->num_rows == 0) { ?>
                    <tr>
                        <td colspan="5">
                            <p class="italic">No se encontraron resultados</p>
                        </td>
                    </tr>
                <?php } ?>

                <!-- Si en la búsqueda no aparecen resultados -->
                <tr id="no-search-results" class="filter">
                    <td colspan="5">
                        <p class="italic">No se encontraron resultados</p>
                    </td>
                </tr>
            </tbody>
        </table>

        <div class="list-mobile">
            <?php
            // Vuelve al principio del arreglo de resultados y lo recorre nuevamente
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <form id="result-mobile" action="../roles/loading-master/statement-of-facts/finished_form.php" method="POST"
                <?php if ($row["estado"] == 0) {
                    /* echo "class='filter'"; */
                } ?>>
                    <input type="hidden" name="num_operacion" value="<?php echo $row["num_operacion"]; ?>" readonly>
                    <button class="mobile-result">
                        <p class="bold">Operación N°<?php echo $row["num_operacion"]; ?></p>
                        <p>Buque: <?php echo $row["buque"]; ?></p>
                        <p>Laycan: <?php echo $row["laycan"]; ?></p>
                        <p>
                            Estado: 
                            <?php
                                if ($row["estado"] == 1) {
                                    echo "Finalizada";
                                } else {
                                    echo "No finalizada";
                                }
                            ?>
                        </p>
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
    <script src="../assets/js/search/operations-search.js"></script>
</body>

</html>