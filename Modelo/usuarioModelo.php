<?php

require_once "mainModel.php";

class usuarioModelo extends mainModel
{

    /*----- Agregar Usuario -----*/
    protected static function agregar_usuario_modelo($datos)
    {
        $stmt = mainModel::conectar()->prepare("INSERT INTO usuario (usuario_nombre ,usuario_contraseña,usuario_estado,usuario_rol )
        VALUES (:nombre,:contra,:estado,:rol);");
        $stmt->bindParam(':nombre', $datos['Nombre']);
        $stmt->bindParam(':contra', $datos['Contraseña']);
        $stmt->bindParam(':estado', $datos['Estado']);
        $stmt->bindParam(':rol', $datos['Rol']);
        $stmt->execute();

        return $stmt;
    }
    /*----- Fin metodo Agregar Usuario -----*/

    /*----- Metodo Eliminar Usuario -----*/
    protected static function eliminar_usuario_modelo($id)
    {
        $sql = mainModel::conectar()->prepare("DELETE FROM usuario WHERE usuario_id=:ID");
        $sql->bindParam(':ID', $id);
        $sql->execute();
        return $sql;
    }

    /*----- Fin metodo Eliminar Usuario -----*/
}
