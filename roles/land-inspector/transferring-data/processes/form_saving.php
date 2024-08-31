<?php
    include "../../../../components/database.php";
    include "../../../../components/regular_expressions.php";

    /* Verificación de los detalles de los datos de transferencia */
    // Si no se han ingresado los detalles obtenidos del Safety Check List
    if (!isset($_POST['id_buque'])) {
        header('Location: ../new_transferring_data.php');
        exit();
    } else {
        $id_buque = htmlspecialchars($_POST['id_buque']);

        // Comprueba si ya existen datos de transferencia con el id
        $query = "SELECT id_data_trans, id_buque FROM data_trans_buque WHERE id_buque = '$id_buque';";
        $result = mysqli_query($connection, $query);

        if ($result->num_rows > 0) {
            $existente = true;

            // Obtiene el número de operación, para posterior edición
            while ($row = mysqli_fetch_assoc($result)) {
                $id_data_trans = $row["id_data_trans"];
            }
        } else {
            $existente = false;
        }

        // Redirige a la página anterior en caso de error
        echo '<form id="form" method="POST">';
            if ($existente) {
                echo '<input type="hidden" name="id_data_trans" value="'.$id_data_trans.'" readonly>';
            } else {
                echo '<input type="hidden" name="id_buque" value="'.$id_buque.'" readonly>';
            }
            echo '<script>
                form = document.getElementById("form");
            </script>
        </form>';

        // Ingreso o edición de detalles de los datos de transferencia (data_trans_buque)
        $mes = htmlspecialchars($_POST['mes']);
        $año = htmlspecialchars($_POST['año']);
        $due = htmlspecialchars($_POST['due']);
        $tipo_operacion = htmlspecialchars($_POST['tipo_operacion']);
        $tipo_ingreso = htmlspecialchars($_POST['tipo_ingreso']);
        $destiny = htmlspecialchars($_POST['destiny']);
        $operacion_na = htmlspecialchars($_POST['operacion_na']);

        $finalizado = 0;

        if ($existente) {
            $query = "UPDATE data_trans_buque
                SET mes = ?,
                año = ?,
                due = ?,
                tipo_operacion = ?,
                tipo_ingreso = ?,
                destiny = ?,
                operacion_na = ?
                WHERE id_data_trans = ?;";
            
            $stat = $connection->prepare($query);
            $stat->bind_param('ssssssii', $mes, $año, $due, $tipo_operacion, $tipo_ingreso, $destiny, $operacion_na, $id_data_trans);
        } else {
            $query = "INSERT INTO data_trans_buque(id_buque, mes, año, due, tipo_operacion, tipo_ingreso, destiny, operacion_na, finalizado) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

            $stat = $connection->prepare($query);
            $stat->bind_param('issssssii', $id_buque, $mes, $año, $due, $tipo_operacion, $tipo_ingreso, $destiny, $operacion_na, $finalizado);
        }
            
        if (!$stat->execute()) {
            if ($existente) {
                echo '<script>
                    form.action = "../unfinished_form.php?form_error=details_data";
                    form.submit();
                </script>';
            } else {
                echo '<script>
                    form.action = "../new_form.php?form_error=details_data";
                    form.submit();
                </script>';
            }
        }

        // Obtiene el número de operación del nuevo formulario
        if (!$existente) {
            $query = "SELECT id_data_trans FROM data_trans_buque ORDER BY id_data_trans DESC LIMIT 1;";
            $result = mysqli_query($connection, $query);
            while ($row = mysqli_fetch_assoc($result)) {
                $id_data_trans = $row["id_data_trans"];
            }
        }
        
        // Ingreso o edición de datos de los productos (data_trans_detalle)
        for ($i = 0; $i < 4; $i++) {
            $producto = htmlspecialchars($_POST['producto_'.$i]);

            // Operador ternario: $variable = condición ? verdadera : falsa;
            $fecha_hora_ini = empty($_POST['fecha_hora_ini_'.$i]) ? NULL : htmlspecialchars($_POST['fecha_hora_ini_'.$i]);
            $fecha_hora_fin = empty($_POST['fecha_hora_fin_'.$i]) ? NULL : htmlspecialchars($_POST['fecha_hora_fin_'.$i]);

            $cant_carg = htmlspecialchars($_POST['cant_carg_'.$i]);
            $cant_carg_BBLS = htmlspecialchars($_POST['cant_carg_BBLS_'.$i]);
            $cant_des = htmlspecialchars($_POST['cant_des_'.$i]);
            $cant_des_BBLS = htmlspecialchars($_POST['cant_des_BBLS_'.$i]);

            $regimen_prom = htmlspecialchars($_POST['regimen_prom_'.$i]);

            if ($existente) {
                $query = "UPDATE data_trans_detalle
                    SET producto = ?,
                    fecha_hora_ini = ?,
                    fecha_hora_fin = ?,
                    cant_carg = ?,
                    cant_carg_BBLS = ?,
                    cant_des = ?,
                    cant_des_BBLS = ?,
                    regimen_prom = ?
                    WHERE id_data_trans = ? AND id_detalle = (SELECT id_detalle FROM data_trans_detalle WHERE id_data_trans = ? LIMIT 1 OFFSET $i);";
            
                $stat = $connection->prepare($query);
                $stat->bind_param('ssssssssii', $producto, $fecha_hora_ini, $fecha_hora_fin, $cant_carg, $cant_carg_BBLS, $cant_des, $cant_des_BBLS, $regimen_prom, $id_data_trans, $id_data_trans);
            } else {
                $query = "INSERT INTO data_trans_detalle(id_data_trans, producto, fecha_hora_ini, fecha_hora_fin, cant_carg, cant_carg_BBLS, cant_des, cant_des_BBLS, regimen_prom) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?);";

                $stat = $connection->prepare($query);
                $stat->bind_param('issssssss', $id_data_trans, $producto, $fecha_hora_ini, $fecha_hora_fin, $cant_carg, $cant_carg_BBLS, $cant_des, $cant_des_BBLS, $regimen_prom);
            }

            if (!$stat->execute()) {
                if ($existente) {
                    echo '<script>
                        form.action = "../unfinished_form.php?form_error=details_data";
                        form.submit();
                    </script>';
                } else {
                    echo '<script>
                        form.action = "../new_form.php?form_error=details_data";
                        form.submit();
                    </script>';
                }
            }
        }
    }

    // Ingreso o edición de los datos de viaje (data_trans_viaje)
    $ult_puerto = htmlspecialchars($_POST['ult_puerto']);
    $des_producto = htmlspecialchars($_POST['des_producto']);
    $con_propano = htmlspecialchars($_POST['con_propano']);
    $des_lastre = htmlspecialchars($_POST['des_lastre']);
    $obs_lastre = htmlspecialchars($_POST['obs_lastre']);
    $vessel_left = empty($_POST['vessel_left']) ? NULL : htmlspecialchars($_POST['vessel_left']);
    $sailing = empty($_POST['sailing']) ? NULL : htmlspecialchars($_POST['sailing']);

    if ($existente) {
        $query = "UPDATE data_trans_viaje
            SET ult_puerto = ?,
            des_producto = ?,
            con_propano = ?,
            des_lastre = ?,
            obs_lastre = ?,
            vessel_left = ?,
            sailing = ?
            WHERE id_data_trans = ?;";
    
        $stat = $connection->prepare($query);
        $stat->bind_param('sssssssi', $ult_puerto, $des_producto, $con_propano, $des_lastre, $obs_lastre, $vessel_left, $sailing, $id_data_trans);
    } else {
        $query = "INSERT INTO data_trans_viaje(id_data_trans, ult_puerto, des_producto, con_propano, des_lastre, obs_lastre, vessel_left, sailing) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stat = $connection->prepare($query);
        $stat->bind_param('isssssss', $id_data_trans, $ult_puerto, $des_producto, $con_propano, $des_lastre, $obs_lastre, $vessel_left, $sailing);
    }

    if (!$stat->execute()) {
        if ($existente) {
            echo '<script>
                form.action = "../unfinished_form.php?form_error=details_data";
                form.submit();
            </script>';
        } else {
            echo '<script>
                form.action = "../new_form.php?form_error=details_data";
                form.submit();
            </script>';
        }
    }

    // Ingreso o edición de la información del buque (data_trans_info_buque)
    $imo = htmlspecialchars($_POST['imo']);
    $trb = htmlspecialchars($_POST['trb']);
    $trn = htmlspecialchars($_POST['trn']);
    $sdwt = htmlspecialchars($_POST['sdwt']);
    $loa = htmlspecialchars($_POST['loa']);
    $breath = htmlspecialchars($_POST['breath']);
    $depth = htmlspecialchars($_POST['depth']);
    $año_fab = htmlspecialchars($_POST['año_fab']);
    $draft_sum = htmlspecialchars($_POST['draft_sum']);

    if ($existente) {
        $query = "UPDATE data_trans_info_buque
            SET imo = ?,
            trb = ?,
            trn = ?,
            sdwt = ?,
            loa = ?,
            breath = ?,
            depth = ?,
            año_fab = ?,
            draft_sum = ?
            WHERE id_data_trans = ?;";
    
        $stat = $connection->prepare($query);
        $stat->bind_param('sssssssssi', $imo, $trb, $trn, $sdwt, $loa, $breath, $depth, $año_fab, $draft_sum, $id_data_trans);
    } else {
        $query = "INSERT INTO data_trans_info_buque(id_data_trans, imo, trb, trn, sdwt, loa, breath, depth, año_fab, draft_sum) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?);";

        $stat = $connection->prepare($query);
        $stat->bind_param('isssssssss', $id_data_trans, $imo, $trb, $trn, $sdwt, $loa, $breath, $depth, $año_fab, $draft_sum);
    }

    if (!$stat->execute()) {
        if ($existente) {
            echo '<script>
                form.action = "../unfinished_form.php?form_error=information_data";
                form.submit();
            </script>';
        } else {
            echo '<script>
                form.action = "../new_form.php?form_error=information_data";
                form.submit();
            </script>';
        }
    }

    // Ingreso o edición de la información del estado de hechos (data_trans_est_hechos)
    $eta = empty($_POST['eta']) ? NULL : htmlspecialchars($_POST['eta']);
    $etd = empty($_POST['etd']) ? NULL : htmlspecialchars($_POST['etd']);
    $num_opera = htmlspecialchars($_POST['num_opera']);
    $num_opera_anual = htmlspecialchars($_POST['num_opera_anual']);
    $viaje = htmlspecialchars($_POST['viaje']);
    $agencia = htmlspecialchars($_POST['agencia']);
    $lleg = empty($_POST['lleg']) ? NULL : htmlspecialchars($_POST['lleg']);

    if ($existente) {
        $query = "UPDATE data_trans_est_hechos
            SET eta = ?,
            etd = ?,
            num_opera = ?,
            num_opera_anual = ?,
            viaje = ?,
            agencia = ?,
            lleg = ?
            WHERE id_data_trans = ?;";
    
        $stat = $connection->prepare($query);
        $stat->bind_param('sssssssi', $eta, $etd, $num_opera, $num_opera_anual, $viaje, $agencia, $lleg, $id_data_trans);
    } else {
        $query = "INSERT INTO data_trans_est_hechos(id_data_trans, eta, etd, num_opera, num_opera_anual, viaje, agencia, lleg) VALUES (?, ?, ?, ?, ?, ?, ?, ?);";

        $stat = $connection->prepare($query);
        $stat->bind_param('isssssss', $id_data_trans, $eta, $etd, $num_opera, $num_opera_anual, $viaje, $agencia, $lleg);
    }

    if (!$stat->execute()) {
        if ($existente) {
            echo '<script>
                form.action = "../unfinished_form.php?form_error=information_data";
                form.submit();
            </script>';
        } else {
            echo '<script>
                form.action = "../new_form.php?form_error=information_data";
                form.submit();
            </script>';
        }
    }
    
    // Borrado de datos almacenados en el formulario
    /* echo '<script>
        localStorage.removeItem("staFacDetails");
        localStorage.removeItem("staFacEvents");
        localStorage.removeItem("staFacNewEvents");
        localStorage.removeItem("staFacShipment");
    </script>'; */

    // Redirección a la lista de formularios sin terminar
    if ($existente) {
        echo '<script> window.location.replace("../data_list_unfinished.php?data_list_success=data_edited"); </script>';
    } else {
        echo '<script> window.location.replace("../data_list_unfinished.php?data_list_success=data_saved"); </script>';
    }
?>