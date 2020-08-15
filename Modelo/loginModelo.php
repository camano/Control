<?php

require_once "mainModel.php";

class loginModelo extends mainModel
{
    /* ----- Modelo iniciar Sesion -----*/
    protected static function mensaje($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT  * FROM usuario
         WHERE usuario_nombre=:usuario and usuario_contraseña=:contraseña;");
        $sql->bindParam(':usuario', $datos['Usuario']);
        $sql->bindParam(':contraseña', $datos['Contraseña']);
        $sql->execute();

        return $sql;
    }
    /* ----- Modelo iniciar Sesion -----*/
    protected static function iniciar_sesion_modelo($datos)
    {
        $sql = mainModel::conectar()->prepare("SELECT  * FROM usuario
        WHERE usuario_nombre='" . $datos['Usuario'] . "' and usuario_contraseña='" . $datos['Contraseña'] . "';");

        $sql->execute();

        return $sql;
    }
}
