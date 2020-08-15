<?php

$peticionAjax = true;
require_once "../Config/APP.php";

if (isset($_POST['Nombre']) || isset($_POST['usuario_id_del'])) {
    require_once "../Controlador/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();

    /*---Agregar Un usuario ---*/
    if (isset($_POST['Nombre']) && isset($_POST['Contraseña'])) {
        echo $ins_usuario->agregar_usuario_controlador();
    }

    /*---Eliminar Un usuario ---*/
    if (isset($_POST['usuario_id_del'])) {
        echo $ins_usuario->eliminar_usuario_controlador();
    }
} else {
    
    
    /*  session_start(['name' => 'CTL']);
    session_unset();
    session_destroy();
    header("Location: " . SERVERURL . "login/");
    exit();*/
}
