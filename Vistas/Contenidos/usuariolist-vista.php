<div class="container">
    <?php if ($_SESSION['rol_CTL'] == 1) { ?>
        <center>
            <div>
                <a href="<?php echo SERVERURL; ?>agregarusuario/" class="btn btn-primary btnagregar">Agregar</a>
                <button type="button" id="btnagregarusuario" class="btn btn-secondary">Secondary</button>
            </div>
        </center>
        <br>
    <?php
    }
    require_once "./Controlador/usuarioControlador.php";
    $ins_usuario = new usuarioControlador();
    echo $ins_usuario->paginador_usuario_controlador(
        $pagina[1],
        10,
        $_SESSION['rol_CTL'],
        $_SESSION['id_CTL'],
        $pagina[0],
        ""
    );

    ?>




</div>