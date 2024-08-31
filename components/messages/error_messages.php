<?php
    if (isset($_GET["error"])) {
        switch ($_GET["error"]) {
            case 'login_error':
                echo "Correo o contraseña no válidos. Por favor, inténtelo nuevamente.";
                break;
            case 'session_error':
                echo "Hubo un error al iniciar sesión. Por favor, inténtelo nuevamente.";
                break;
            case 'empty_fields':
                echo "Uno o más campos obligatorios están vacíos";
                break;
            case 'no_valid_data':
                echo "Uno o más campos contienen datos no válidos";
                break;
            default:
                echo "Código de error no válido";
                break;
        }
    }

    if (isset($_GET["form_error"])) {
        switch ($_GET["form_error"]) {
            case 'accordance_data':
                echo "Uno o más campos de conformidad están vacíos o contienen datos no válidos";
                break;
            case 'details_data':
                echo "No se pudieron ingresar los detalles del formulario. Por favor, inténtelo nuevamente.";
                break;
            case 'information_data':
                echo "No se pudo ingresar la información del formulario. Por favor, inténtelo nuevamente.";
                break;
            case 'events_data':
                echo "No se pudieron ingresar los eventos del formulario. Por favor, inténtelo nuevamente.";
                break;
            case 'signatures_data':
                echo "No se pudieron ingresar las firmas del formulario. Por favor, inténtelo nuevamente.";
                break;
            case 'sending_error':
                echo "No se pudo enviar el formulario. Por favor, inténtelo nuevamente.";
                break;
            default:
                echo "Código de error no válido";
                break;
        }
    }

    if (isset($_GET["list_error"])) {
        switch ($_GET["list_error"]) {
            case 'user_not_found':
                echo "El usuario no ha sido encontrado.";
                break;
            case 'access_not_changed':
                echo "El acceso del usuario no pudo ser cambiado. Por favor, inténtelo nuevamente.";
                break;
            default:
                echo "Código de error no válido";
                break;
        }
    }
?>