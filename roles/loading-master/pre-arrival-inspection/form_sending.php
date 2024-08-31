<?php
    include "../../../components/database.php";
    include "../../../components/regular_expressions.php";

    /* Verificación de los detalles del buque */
    // Si no se ha ingresado algún detalle
    if (empty($_POST['buque']) || empty($_POST['lugar']) || empty($_POST['terminal']) || empty($_POST['operacion']) || empty($_POST['prod_transferir']) || empty($_POST['fecha_hora_inicio']) || !isset($_POST['id_buque'])) {
        header('Location: new_form.php?error=empty_fields');
        exit();
    } else {
        // Si el formato de fecha no es válido
        if (!preg_match($reg_exp_datetime, $_POST['fecha_hora_inicio'])) {
            header('Location: new_form.php?error=no_valid_data');
            exit();
        } else {
            $buque = htmlspecialchars($_POST['buque']);
            $lugar = htmlspecialchars($_POST['lugar']);
            $terminal = htmlspecialchars($_POST['terminal']);
            $operacion = htmlspecialchars($_POST['operacion']);
            $prod_transferir = htmlspecialchars($_POST['prod_transferir']);
            $fecha_hora_inicio = htmlspecialchars($_POST['fecha_hora_inicio']);
            $id_buque = htmlspecialchars($_POST['id_buque']);
        }
    }


    /* Arreglos de datos de la información */
    $expiracion = array();
    $conformidad = array();
    $observacion = array();

    /* Verificación de los datos ingresados: Parte I */
    // Si el campo de conformidad está vacío
    for ($i = 1; $i <= 10; $i++) { 
        if (empty($_POST['con'.$i]) || !preg_match($reg_exp_accordance, $_POST['con'.$i])) {
            header('Location: new_form.php?form_error=accordance_data');
            exit();
        } else {
            // Validación de fechas (si es necesario)
            if (empty($_POST['exp'.$i])) {
                $expiracion[$i] = NULL;
            } else {
                $expiracion[$i] = htmlspecialchars($_POST['exp'.$i]);
            }

            $conformidad[$i] = htmlspecialchars($_POST['con'.$i]);
            $observacion[$i] = htmlspecialchars($_POST['obs'.$i]);
        }
    }


    /* Verificación de los datos ingresados: Parte II */
    // Si el campo de conformidad está vacío
    for ($i = 11; $i <= 31; $i++) { 
        if (empty($_POST['con'.$i]) || !preg_match($reg_exp_accordance, $_POST['con'.$i])) {
            header('Location: new_form.php?form_error=accordance_data');
            exit();
        } else {
            $expiracion[$i] = NULL;
            $conformidad[$i] = htmlspecialchars($_POST['con'.$i]);
            $observacion[$i] = htmlspecialchars($_POST['obs'.$i]);
        }
    }

    /* ESTA SECCIÓN SE ENCUENTRA PENDIENTE DE CAMBIO */
    
    /*Verificación de las firmas*/
    // Si el campo de las firmas está vacío
    /* if (!isset($_POST['firma_buque']) || !isset($_POST['firma_terminal'])) {
        header('Location: new_form.php?error=empty_fields');
        exit();
    } else { */
        // Validación de fechas (si es necesario)
        if (empty($_POST['fecha_hora_buque'])) {
            $fecha_hora_buque = NULL;
        } else {
            $fecha_hora_buque = htmlspecialchars($_POST['fecha_hora_buque']);
        }

        if (empty($_POST['fecha_hora_terminal'])) {
            $fecha_hora_terminal = NULL;
        } else {
            $fecha_hora_terminal = htmlspecialchars($_POST['fecha_hora_terminal']);
        }
        
        /* $firma_buque = htmlspecialchars($_POST['firma_buque']); */
        $grado_buque = htmlspecialchars($_POST['grado_buque']);

        /* $firma_terminal = htmlspecialchars($_POST['firma_terminal']); */
        $grado_terminal = htmlspecialchars($_POST['grado_terminal']);

        $firma_buque = NULL;
        $firma_terminal = NULL;
    /* } */


    /* Inserción de datos */
    // Agrega el registro de detalles del buque
    $query = "INSERT INTO ins_pre_detalles(buque, lugar, terminal, operacion, prod_transferir, fecha_hora_inicio, id_buque) VALUES (?, ?, ?, ?, ?, ?, ?);";
    $stat = $connection->prepare($query);
    $stat->bind_param('ssssssi', $buque, $lugar, $terminal, $operacion, $prod_transferir, $fecha_hora_inicio, $id_buque);

    // Si los detalles se ingresaron correctamente, se registran los demás datos
    if ($stat->execute()) {
        // Obtiene la ID del buque del registro ya ingresado
        $query = "SELECT id_buque FROM ins_pre_detalles ORDER BY id_buque DESC LIMIT 1;";
        $result = mysqli_query($connection, $query);
        while ($row = mysqli_fetch_assoc($result)) {
            $id_buque = $row["id_buque"];
        }

        // Inserción de los registros de información
        for ($i = 1; $i <= sizeof($conformidad); $i++) {
       
            $query = "INSERT INTO ins_pre_info(id_buque, detalle_inspeccion, expiracion, conformidad, observacion) VALUES (?, ?, ?, ?, ?);";
            $stat = $connection->prepare($query);
            $stat->bind_param('iisss', $id_buque, $i, $expiracion[$i], $conformidad[$i], $observacion[$i]);
            
            if (!$stat->execute()) {
                header('Location: new_form.php?form_error=information_data');
                exit();
            }
        }

        // Inserción de firmas
        $query = "INSERT INTO ins_pre_firmas(id_buque, firma_buque, grado_buque, fecha_hora_buque, firma_terminal, grado_terminal, fecha_hora_terminal) VALUES (?, ?, ?, ?, ?, ?, ?);";
        $stat = $connection->prepare($query);
        $stat->bind_param('issssss', $id_buque, $firma_buque, $grado_buque, $fecha_hora_buque, $firma_terminal, $grado_terminal, $fecha_hora_terminal);
        
        if (!$stat->execute()) {
            header('Location: new_form.php?form_error=signatures_data');
            exit();
        }

        // Borrado de datos almacenados en el formulario
        echo '<script>
            localStorage.removeItem("preArrDetails");
            localStorage.removeItem("preArrInformation");
            localStorage.removeItem("preArrSignatures");
        </script>';

        // Redirección a la página del formulario terminado
        echo '<form id="form" action="finished_form.php" method="POST">
            <input type="hidden" name="id_buque" value="'.$id_buque.'" readonly>
            <script>
                document.getElementById("form").submit();
            </script>
        </form>';
    } else {
        header('Location: new_form.php?form_error=details_data');
        exit();
    }
?>