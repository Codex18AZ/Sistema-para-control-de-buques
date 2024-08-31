<?php
    include "../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 3) {
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
    <title>Lista de accesos de usuario</title>
    <link rel="stylesheet" href="../assets/css/lists/users-list.css">
    <link rel="icon" href="../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../roles/administrator/components/administrator_menu.php"; ?>
    
    <div class="content" id="content">
        <h2>Lista de accesos de usuario</h2>

        <?php if (isset($_GET['list_error'])) { ?>
        <p class="error-text">
            <span class="error">
                <?php include_once "../components/messages/error_messages.php"; ?>
            </span>
        </p>
        <?php } ?>

        <?php if (isset($_GET['list_success'])) { ?>
        <p class="success-text">
            <span class="success">
                <?php include_once "../components/messages/success_messages.php"; ?>
            </span>
        </p>
        <?php } ?>

        <div class="searching">
            <input type="search" id="users-search" placeholder="Buscar por nombre, correo o rol...">
        </div>

        <?php
            // Obtener lista de usuarios
            // IMPORTANTE: esto puede cambiar con la implementación del Active Directory
            $query = "SELECT id_usuario, nombres, apellidos, correo, tipo_usuario, acceso FROM usuario WHERE tipo_usuario != 3;";
            $result = mysqli_query($connection, $query);
        ?>

        <table class="list-desktop">
            <thead>
                <tr>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>Acceso a la página</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            
            <tbody>
                <?php while ($row = mysqli_fetch_assoc($result)) { ?>
                    <tr id="result-desktop">
                        <td><?php echo $row["nombres"]." ".$row["apellidos"]; ?></td>
                        <td><?php echo $row["correo"]; ?></td>
                        <td>
                            <?php
                                if ($row["tipo_usuario"] == 1) {
                                    echo "Loading Master";
                                } else {
                                    echo "Supervisor de Tierra";
                                }
                            ?>
                        </td>
                        <td>
                            <?php
                                if ($row["acceso"] == 1) {
                                    echo "Sí";
                                } else {
                                    echo "No";
                                } 
                            ?>
                        </td>
                        
                        <td>
                            <form action="processes/user_access.php" method="POST">
                                <input type="hidden" name="id_usuario" value="<?php echo $row["id_usuario"]; ?>" readonly>
                                <input type="submit" class="submit" value="Cambiar acceso">
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
            <p class="sentence">Clic en el usuario para cambiar su acceso a la página web.</p>

            <?php
            // Vuelve al principio del arreglo de resultados y lo recorre nuevamente
            mysqli_data_seek($result, 0);
            while ($row = mysqli_fetch_assoc($result)) {
            ?>
                <form id="result-mobile" action="processes/user_access.php" method="POST">
                    <input type="hidden" name="id_usuario" value="<?php echo $row["id_usuario"]; ?>" readonly>
                    <button class="mobile-result">
                        <p class="bold"><?php echo $row["correo"]; ?></p>
                        <p><?php echo $row["nombres"]." ".$row["apellidos"]; ?></p>
                        <p class="italic">
                            <?php
                                if ($row["tipo_usuario"] == 1) {
                                    echo "Loading Master";
                                } else {
                                    echo "Supervisor de Tierra";
                                }
                            ?>
                        </p>
                        <p>
                            Acceso a la página: 
                            <?php if ($row["acceso"] == 1) {
                                echo "Sí";
                            } else {
                                echo "No";
                            } ?>
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
    <script src="../assets/js/search/users-search.js"></script>
</body>

</html>