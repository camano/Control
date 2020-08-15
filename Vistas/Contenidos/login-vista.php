<?php
session_start(['name' => 'CTL']);
require_once "./Controlador/loginControlador.php";
$lc = new loginControlador();
if (isset($_SESSION['token_CTL']) || isset($_SESSION['nombre_CTL']) || isset($_SESSION['id_CTL'])) {
    header("Location:" . SERVERURL . "home/");
}
?>

<br>
<br>
<br>
<div class="row">
    <div class="col-md-4"></div>
    <div class="col-md-4">
        <div id="error_login" role="alert" class="">
            
        </div>
        <form method="POST" action="" class="" id="">
            <div class="form-group col-md-10">
                <label for="exampleInputEmail1">Nombre de Usuario </label>
                <input type="text" class="form-control" id="exampleInputEmail1" name="Nombre_log" aria-describedby="emailHelp">
            </div>
            <div class="form-group col-md-10">
                <label for="exampleInputPassword1">Password</label>
                <input type="password" class="form-control" name="Clave_log" id="exampleInputPassword1">
            </div>
            <div class="col-md-10">
                <button type="submit" class="btn btn-danger form-control">Ingresar</button>
            </div>
        </form>

    </div>
    <div class="col-md-4"></div>
</div>
<?php
if (isset($_POST['Nombre_log']) && isset($_POST['Clave_log'])) {
    require_once "./Controlador/loginControlador.php";

    $inst_login = new loginControlador();
    echo $inst_login->iniciar_sesion_controlador();
}
?>