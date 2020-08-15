<script>
    let btn_salir = document.querySelector(".btnsalir");

    btn_salir.addEventListener("click", function(e) {
        e.preventDefault();
        Swal.fire({
            title: '¿Estás seguro?',
            text: "Seguro quiere salir",
            type: 'question',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Aceptar',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let url = '<?php echo SERVERURL; ?>Ajax/loginAjax.php';
                let token = '<?php echo $lc->encryption($_SESSION['token_CTL']); ?>';
                let usuario = '<?php echo $lc->encryption($_SESSION['nombre_CTL']); ?>';

                let datos = new FormData();
                datos.append('token', token);
                datos.append('usuario', usuario);
                fetch(url, {
                        method: 'POST',
                        body: datos
                    })
                    .then(respuesta => respuesta.json())
                    .then(respuesta => {
                        return alertas_ajax(respuesta);
                    });
            }
        });

    });
   
</script>