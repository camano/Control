<?php

require_once "./Modelo/vistasModelo.php";

class vistasControlador extends vistasModelo
{
    /*-----Controlador para Obtener Plantilla----------*/
    public function obtener_plantilla_controlador()
    {
        return require_once "./Vistas/plantilla.php";
    }

    /*-----Metodo  para Obtener Vistas----------*/
    public function obtener_vistas_controlador()
    {
        if (isset($_GET['url'])) {
            $ruta = explode("/", $_GET['url']);
            $respuesta = vistasModelo::obtener_vistas_modelo($ruta[0]);
        } else {
            $respuesta = "login";
        }
        return $respuesta;
    }
}
