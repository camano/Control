<?php
require_once "./Config/APP.php";

echo "rama oe";
require_once "./Controlador/vistasControlador.php";

$plantilla = new vistasControlador();
$plantilla->obtener_plantilla_controlador();
