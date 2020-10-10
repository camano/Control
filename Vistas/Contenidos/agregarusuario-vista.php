<?php

?>

<form action="<?php echo SERVERURL; ?>Ajax/usuarioAjax.php" method="POST" class="FormularioAjax" data-form="save">
    <div class="form-row">
        <div class="form-group col-md-6">
            <label for="inputEmail4">Usuario</label>

            <div class="formulario__grupo-input">
                <input type="text" name="Nombre" class="form-control" id="inputEmail4">
                <i class="formulario__validacion-estado fas fa-times-circle"></i>
            </div>
            <p class="formulario__input-error">El usuario tiene que ser de 4 a 16 dígitos y solo puede contener numeros, letras y guion bajo.</p>
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Región</label>
            <input type="text" name="Region" class="form-control" id="inputPassword4">
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail4">Contraseña 1</label>
            <input type="password" name="Contraseña" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Contraseña 2</label>
            <input type="password" name="" class="form-control" id="inputPassword4">
        </div>
        <div class="form-group col-md-6">
            <label for="inputEmail4">Estado</label>
            <input type="text" name="Estado" class="form-control" id="inputEmail4">
        </div>
        <div class="form-group col-md-6">
            <label for="inputPassword4">Rol</label>
            <input type="text" name="Rol" class="form-control" id="inputPassword4">
        </div>

    </div>
   <input type="submit" class="btn btn-primary">
    </div>
</form>
<script src="<?php echo SERVERURL; ?>Vistas/Scripts/usuarios.js"></script>