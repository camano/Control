<?php

$peticionAjax = true;
require_once "../Config/APP.php";

if (isset($_POST['token']) && isset($_POST['usuario'])) {
    require_once "../Controlador/loginControlador.php";
    $ins_login = new loginControlador();
    echo $ins_login->cerrar_session_controlador();
} else {
    session_start(['name' => 'CTL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();
}
