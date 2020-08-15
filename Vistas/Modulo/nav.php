<div class="bg-light border-right" id="sidebar-wrapper">
    <div class="sidebar-heading">Coopidrogas </div>
    <div class="list-group list-group-flush">
        <?php
        if ($_SESSION['rol_CTL'] == 1) {
        ?>
            <a href="<?php echo SERVERURL; ?>usuariolist/" class="list-group-item list-group-item-action bg-light">Administrador</a>
            <div class="collapse" id="collapseExample">
                <a href="<?php echo SERVERURL; ?>usuariolist/" class="list-group-item list-group-item-action bg-light">Lista de Usuarios</a>
                <a href="<?php echo SERVERURL; ?>agregarusuario/" class="list-group-item list-group-item-action bg-light">Agregar Usuarios</a>
            </div>
        <?php } ?>

        <a href="<?php echo SERVERURL; ?>usuariolist" class="list-group-item list-group-item-action bg-light">Colaboradores</a>
        <a href="<?php echo SERVERURL; ?>usuariolist" class="list-group-item list-group-item-action bg-light">Requerimientos</a>



    </div>
</div>