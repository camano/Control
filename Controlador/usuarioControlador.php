<?php

if ($peticionAjax) {
    require_once "../Modelo/usuarioModelo.php";
} else {
    require_once "./Modelo/usuarioModelo.php";
}

class usuarioControlador extends usuarioModelo
{
    /*----- Agregar Usuario Controlador-----*/
    public function agregar_usuario_controlador()
    {
        $nombre = mainModel::limpiar_cadena($_POST['Nombre']);
        $contraseña = mainModel::limpiar_cadena($_POST['Contraseña']);
        $estado = mainModel::limpiar_cadena($_POST['Estado']);
        $rol = mainModel::limpiar_cadena($_POST['Rol']);
        $region=mainModel::limpiar_cadena($_POST['Region']);



        if ($nombre == "" || $contraseña == "") {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No se ha llenado todos los campos",
                "Tipo" => "error"
            ];

            echo json_encode($alerta);
            exit();
        }


        $check_usuario = mainModel::ejecutar_consulta_simples("SELECT usuario_nombre FROM usuario
        WHERE usuario_nombre='$nombre'");
        if ($check_usuario->rowCount() > 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "El Nombre de usuario ya existe",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $clave = mainModel::encryption($contraseña);

        $datos_usuario = [
            "Nombre" => $nombre,
            "Contraseña" => $clave,
            "Estado" => $estado,
            "Rol" => $rol,
            "Region"=>$region,

        ];


        $agregarusuario = usuarioModelo::agregar_usuario_modelo($datos_usuario);

        if ($agregarusuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "limpiar",
                "Titulo" => "Usuario regristado",
                "Texto" => "Sus datos han sido regristados",
                "Tipo" => "succes"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No hemos podido regristar usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    /*----- FIN Metodo Agregar Usuario Controlador-----*/

    /*----- Paginador Usuario Controlador-----*/
    public function paginador_usuario_controlador($pagina, $regristo, $privilegio, $id, $url, $busqueda)
    {
        $pagina = mainModel::limpiar_cadena($pagina);
        $regristo = mainModel::limpiar_cadena($regristo);
        $privilegio = mainModel::limpiar_cadena($privilegio);
        $id = mainModel::limpiar_cadena($id);
        $url = mainModel::limpiar_cadena($url);
        $url = SERVERURL . $url . "/";
        $busqueda = mainModel::limpiar_cadena($busqueda);

        $tabla = "";
        $pagina = (isset($pagina) && $pagina > 0) ? (int) $pagina : 1;
        $inicio = ($pagina > 0) ? (($pagina * $regristo) - $regristo) : 0;

        if (isset($busqueda) && $busqueda != "") {
            $consulta = "SELECT SQL_CALC_FOUND_ROWS * FROM usuario WHERE ((usuario_id!='$id' 
            AND usuario_id!='1') AND (usuario_nombre LIKE '%$busqueda%')) ORDER BY usuario_nombre ASC LIMIT $inicio,$regristo";
        } else {
            $consulta = "CALL listarusuarios($id, $inicio, $regristo)";
        }

        $conexion = mainModel::conectar();
        $datos = $conexion->query($consulta);
        $datos = $datos->fetchAll();
        $total = $conexion->query("SELECT  FOUND_ROWS()");
        $total = (int) $total->fetchColumn();
        $NPagina = ceil($total / $regristo);

        $tabla .= '<div class="table-responsive">
        <table class="table table-borderless">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">Nombre</th>
                <th scope="col">Estado</th>
                <th scope="col">Rol</th>
                <th scope="col">Actualizar</th>
                <th scope="col">Eliminar</th>
            </tr>
        </thead><tbody>';
        if ($total >= 1 && $pagina <= $NPagina) {
            $contador = $inicio + 1;
            foreach ($datos as $rows) {
                $tabla .= '
            <tr>
                <td>' . $contador . '</td>  
                <td>' . $rows['usuario_nombre'] . '</td>
                <td>' . $rows['usuario_estado'] . '</td>
                <td>' . $rows['rol_Nombre'] . '</td>
                <td>
                </td>
                <td>
                <form action="' . SERVERURL . 'Ajax/usuarioAjax.php" method="POST" class="FormularioAjax" data-form="delete">
                <input type="hidden" name="usuario_id_del" value="' . mainModel::encryption($rows['usuario_id']) . '">
                <button type="submit" class="btn btn-warning">
                Eliminar
                </button>
                </form>
                </td>

            </tr>';

                $contador++;
            }
        } else {
            if ($total >= 1) {
                $tabla .= '<tr><td colspan="0">
                <a href="' . $url . '" class="btn btn-raised btn-primary btn-sm">Recargar Listado</a>
                </td></tr>';
            } else {
                $tabla .= '<tr><td colspan="0">NO hay regristos en el sistema</td></tr>';
            }
        }
        $tabla .= ' </tbody></table><div>';

        if ($total >= 1 && $pagina <= $NPagina) {
            $tabla .= mainModel::paginador_tablas($pagina, $NPagina, $url, 7);
        }

        return $tabla;
    }
    /*----- FIN Metodo Paginador Usuario Controlador-----*/

    /*----- Eliminar Usuario Controlador-----*/
    public function eliminar_usuario_controlador()
    {
        $id = mainModel::decryption($_POST['usuario_id_del']);
        $id = mainModel::limpiar_cadena($id);
        
        if ($id == 1) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No podemos eliminar el usuario principal del sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }

        $check_usuario = mainModel::ejecutar_consulta_simples("SELECT usuario_id FROM usuario WHERE usuario_id='$id'");
        if ($check_usuario->rowCount() <= 0) {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "El usuario que intenta eliminar no existe en el sistema",
                "Tipo" => "error"
            ];
            echo json_encode($alerta);
            exit();
        }


        $eliminar_usuario = usuarioModelo::eliminar_usuario_modelo($id);
        if ($eliminar_usuario->rowCount() == 1) {
            $alerta = [
                "Alerta" => "recargar",
                "Titulo" => "Usuario Eliminado",
                "Texto" => "EL usuario ha sido eliminado Correctamente",
                "Tipo" => "succes"
            ];
        } else {
            $alerta = [
                "Alerta" => "simple",
                "Titulo" => "Ocurrio un error",
                "Texto" => "No podemos eliminar el usuario",
                "Tipo" => "error"
            ];
        }
        echo json_encode($alerta);
        exit();
    }
    /*----- Fin Metodo Eliminar Usuario Controlador-----*/
}
