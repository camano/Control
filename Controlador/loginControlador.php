<?php
if ($peticionAjax) {
    require_once "../Modelo/loginModelo.php";
} else {
    require_once "./Modelo/loginModelo.php";
}

class loginControlador extends loginModelo
{
    /*----- Agregar Usuario Controlador-----*/

    public function iniciar_sesion_controlador()
    {
        $nombre = mainModel::limpiar_cadena($_POST['Nombre_log']);
        $contraseña = mainModel::limpiar_cadena($_POST['Clave_log']);


        if ($nombre == "" || $contraseña == "") {

            echo '
            <script>
            
            
            </script>
            ';
        }

        $clave = mainModel::encryption($contraseña);


        $datos_login = [
            "Usuario" => $nombre,
            "Contraseña" => $clave,
        ];

        $m = loginModelo::iniciar_sesion_modelo($datos_login);


        if ($m->rowCount() == 1) {
            $row = $m->fetch();
            session_start(['name' => 'CTL']);
            $_SESSION['id_CTL'] = $row['usuario_id'];
            $_SESSION['nombre_CTL'] = $row['usuario_nombre'];
            $_SESSION['rol_CTL'] = $row['usuario_rol'];
            $_SESSION['token_CTL'] = md5(uniqid(mt_rand(), true));

            return header("Location:" . SERVERURL . "home");
        } else {
            echo '
            <script>
            
            mensaje();
            </script>';
        }
    }
    /*----- Final Usuario COntrolador-----*/


    /*----- Controlador Forzar Cierre session-----*/

    public function forzar_cierre_sesion_controlador()
    {
        session_unset();
        session_destroy();
        if (headers_sent()) {
            return "<script>window.location.href='" . SERVERURL . "login/';</script>";
        } else {
            return header("Location:" . SERVERURL . "login/");
        }
    }
    /*----- Final Controlador Forzar  COntrolador-----*/


    /*----- Controlador  Cerra session-----*/

    public function cerrar_session_controlador()
    {
        session_start(['name' => 'CTL']);
        $token = mainModel::decryption($_POST['token']);
        $usuario = mainModel::decryption($_POST['usuario']);
        if ($token == $_SESSION['token_CTL'] && $usuario == $_SESSION['nombre_CTL']) {
            session_unset();
            session_destroy();
            $alerta = [
                "Alerta" => "redireccionar",
                "URL" => SERVERURL . "login/"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No se Pudo cerrar la session",
                "Tipo" => "error"
            ];
        }

        echo json_encode($alerta);
        exit();
    }
    /*----- Final Controlador Forzar Cierre session-----*/
}
