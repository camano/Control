/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(document).ready(function () {
    $.ajax({
        type: "POST",
        url: " Controlador_Departamentos",
        data: {action: "departamentos"}
    })
            .done(function (dpl) {
                $("#departamento").html(dpl);
            })
    $("#departamento").on('change', function () {
        var id = $('#departamento').val()

        $.ajax({
            type: "POST",
            url: " Controlador_Departamentos",
            data: {action: "ciudad", idDep: id}
        })
                .done(function (cil) {
                    $("#ciudad").html(cil);
                })
    })
});
function consultarusuario() {
    $.ajax({
        method: "POST",
        url: "consultar",
        data: {},
        datatype: 'json',
        success: function (resultado) {

            $("input[name='correo']").val(resultado.Correo)
            $("input[name='telefono']").val(resultado.Telefono)
            $("#name").val(resultado.Nombres)
            $("#idusuario").val(resultado.id)


        },
        error: function (error) {
            console.log(error)
        }
    })


}
$(document).ready(function () {

    $("#btnEditarUsuario").click(function () {
        EditarUsuario();
    }),
    $("#btnclave").click(function () {
        consultarclave();
    }),
    $("#btnCorreo").click(function () {
        Recuperar();
    })


});

function EditarUsuario() {

    $.ajax({
        method: "POST",
        url: "editarusuario",
        data: $('#formEditarUsuario').serialize(),
        success: function (resultado) {

            desplejarmodal("Se actualizaron los datos");
            location.href = "inicio";
        },
        error: function (error) {
            desplejarmodal("no Se pudo Editar");

        }

    });

}
function Recuperar() {

    $.ajax({
        method: "POST",
        url: "../../recuperclave",
        data: $('#formcorreo').serialize(),
        success: function (resultado) {

            desplejarmodal("Se Envio A su Correo");
          
        },
        error: function (error) {
            desplejarmodal("no Se pudo Editar");

        }

    });

}
consultarusuario();

function consultarclave(){
     $.ajax({
        method: "POST",
        url: "clave",
        data: {claveanterior: $("#claveanterior").val(), clavenueva: $("#nuevaclave").val(),confirmarclave: $("#confirmarclave").val()}
       
    })
            .done(function (resultado) {
                $("#errores").html(resultado);
            });
}


