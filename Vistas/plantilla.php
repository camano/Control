<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo COMPANY ?></title>

</head>
<?php include "./Vistas/Modulo/links.php"; ?>

<body>

    <?php
    $peticionAjax = false;
    include "./Vistas/Modulo/modal.php";
    require_once "./Controlador/vistasControlador.php";

    $IV = new vistasControlador();
    $vistas = $IV->obtener_vistas_controlador();
    if ($vistas == "login" || $vistas == "404") {
        require_once "./Vistas/Contenidos/" . $vistas . "-vista.php";
    } else {

        session_start(['name' => 'CTL']);
        $pagina = explode("/", $_GET['url']);

        require_once "./Controlador/loginControlador.php";
        $lc = new loginControlador();
        if (!isset($_SESSION['token_CTL']) || !isset($_SESSION['nombre_CTL']) || !isset($_SESSION['id_CTL'])) {
            echo $lc->forzar_cierre_sesion_controlador();
            exit();
        }
    ?>
        <?php include "./Vistas/Modulo/modal.php"; ?>
        <div class="d-flex" id="wrapper">
            <!-- Sidebar -->
            <?php include "./Vistas/Modulo/nav.php"; ?>
          
            <!-- /#sidebar-wrapper -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <?php include "./Vistas/Modulo/navbar.php"; ?>
                <!-- /#page-content-wrapper -->
                <div class="container">
                    <br>
                    <?php require_once $vistas; ?>
                </div>
            </div>
        </div>
    <?php
        include "./Vistas/Modulo/logout.php";
    }

    include "./Vistas/Modulo/scripts.php";
    ?>
</body>

</html>