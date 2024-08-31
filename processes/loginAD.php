<?php
    /* Código a cambiar para conectarse con el servidor de OTAS
    - ldap_connect('codex.code'): poner dominio de ANJOR
    - En el formulario de inicio de sesión poner en el 
    post el nombre de este archivo, lo mismo para el cierre de sesión
    - Colocar correctamente el nombre de oficina y departamento */

    // Se podria optimizar el dominio y otros 
    if (empty($_POST['usuario']) || empty($_POST['clave']) || empty($_POST['dominio']) || empty($_POST['oficina']) || empty($_POST['departamento'])) {
        header('Location: ../signin.php?error=login_error');
        exit();
    } else {
        $ldap_con = ldap_connect('codex.code');
        $user = $_POST['usuario'];
        $clave = $_POST['clave'];
        $dominio = $_POST['dominio'];
        $dc = explode(".", $dominio);
        $oficina = $_POST['oficina'];
        $departamento = $_POST['departamento'];

        $ldap_dn = "CN=$user, OU=$departamento, OU=$oficina, DC=$dc[0],DC=$dc[1]";

        // Inicio de sesión
        ldap_set_option($ldap_con, LDAP_OPT_PROTOCOL_VERSION, 3);
        $ldap_password = "$pass";

        if (@ldap_bind($ldap_con, $ldap_dn, $ldap_password)) {
            session_start();
            //el usuario ahora es conocido como correo para coincidir con el codigo de session y otros
            $_SESSION["correoAD"] = $user;
            $_SESSION["departamento"] = $departamento;
            $_SESSION["oficina"] = $oficina;
            $_SESSION["dc1"] = $dc[0];
            $_SESSION["dc2"] = $dc[1];
            
            // Redireccionamiento según el tipo de usuario
            if ($departamento == "departamento1" && $oficina == "oficina1") {
                header('Location: ../roles/loading-master/menu.php');
                exit();
            } else if ($departamento == "departamento2" && $oficina == "oficina2") {
                header('Location: ../roles/land-inspector/menu.php');
                exit();
            } else if ($departamento == "departamento3" && $oficina == "oficina3") {
                header('Location: ../roles/administrator/menu.php');
                exit();
            } else {
                header('Location: ../signin.php?error=session_error');
                exit();
            }
            
        } else {
            // Si los datos de sesión son incorrectos
            header('Location: ../signin.php?error=login_error');
            exit();
        }
    }
?>