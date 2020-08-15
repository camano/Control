const btnabrirmodal = document.getElementById("btnagregarusuario");

btnabrirmodal.addEventListener("click", (e) => {
    $(".modal-body").load("../Vistas/Contenidos/agregarusuario-vista.php");
    $(".modal-title").html("Agrega");
    $(".modal-footer").hide();
    $("#Modal").modal();

});