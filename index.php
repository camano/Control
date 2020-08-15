<?php
require_once "./Config/APP.php";


require_once "./Controlador/vistasControlador.php";

$plantilla = new vistasControlador();
$plantilla->obtener_plantilla_controlador();
