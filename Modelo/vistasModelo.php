<?php

class vistasModelo
{

    /*-----Modelo para Obtener Vistas----------*/

    protected static function obtener_vistas_modelo($vistas)
    {
        $listaBlanca = ["agregarusuario","home","usuariolist"];
        if (in_array($vistas, $listaBlanca)) {
            if (is_file("./Vistas/Contenidos/" . $vistas . "-vista.php")) {
                $contenido = "./Vistas/Contenidos/" . $vistas . "-vista.php";
            } else {
                $contenido="404";
            }
        } elseif ($vistas == "login" || $vistas == "index") {
            $contenido = "login";
        } else {
            $contenido = "404";
        }
        return $contenido;
    }
}
