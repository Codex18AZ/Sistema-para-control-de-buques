<?php
    if (isset($_GET["list_success"])) {
        switch ($_GET["list_success"]) {
            case 'access_changed':
                echo "El acceso del usuario ha sido cambiado correctamente.";
                break;
            default:
                echo "Código no válido";
                break;
        }
    }

    if (isset($_GET["statement_success"])) {
        switch ($_GET["statement_success"]) {
            case 'statement_saved':
                echo "El estado de hechos ha sido guardado correctamente.";
                break;
            case 'statement_edited':
                echo "El estado de hechos ha sido editado correctamente.";
                break;
            default:
                echo "Código no válido";
                break;
        }
    }

    if (isset($_GET["summary_success"])) {
        switch ($_GET["summary_success"]) {
            case 'summary_saved':
                echo "El resumen de transferencia ha sido guardado correctamente.";
                break;
            case 'summary_edited':
                echo "El resumen de transferencia ha sido editado correctamente.";
                break;
            default:
                echo "Código no válido";
                break;
        }
    }

    if (isset($_GET["safety_list_success"])) {
        switch ($_GET["safety_list_success"]) {
            case 'list_saved':
                echo "La Safety Check List ha sido guardada correctamente.";
                break;
            case 'list_edited':
                echo "La Safety Check List ha sido editada correctamente.";
                break;
            default:
                echo "Código no válido";
                break;
        }
    }

    if (isset($_GET["data_list_success"])) {
        switch ($_GET["data_list_success"]) {
            case 'data_saved':
                echo "Los datos de la transferencia han sido guardados correctamente.";
                break;
            case 'data_edited':
                echo "Los datos de la transferencia han sido editados correctamente.";
                break;
            default:
                echo "Código no válido";
                break;
        }
    }
?>