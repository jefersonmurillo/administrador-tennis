$(function () {
    $(document).ready(function () {
        $('.mailbox-messages input[type="checkbox"]').iCheck({
            checkboxClass: 'icheckbox_flat-blue',
            radioClass: 'iradio_flat-blue'
        });

        //Enable check and uncheck all functionality
        $(".checkbox-toggle").click(function () {
            var clicks = $(this).data('clicks');
            if (clicks) {
                //Uncheck all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("uncheck");
                $(".fa", this).removeClass("fa-check-square-o").addClass('fa-square-o');
            } else {
                //Check all checkboxes
                $(".mailbox-messages input[type='checkbox']").iCheck("check");
                $(".fa", this).removeClass("fa-square-o").addClass('fa-check-square-o');
            }
            $(this).data("clicks", !clicks);
        });

        //Handle starring for glyphicon and font awesome
        $(".mailbox-star").click(function (e) {
            e.preventDefault();
            //detect type
            var $this = $(this).find("a > i");
            var glyph = $this.hasClass("glyphicon");
            var fa = $this.hasClass("fa");

            //Switch states
            if (glyph) {
                $this.toggleClass("glyphicon-star");
                $this.toggleClass("glyphicon-star-empty");
            }

            if (fa) {
                $this.toggleClass("fa-star");
                $this.toggleClass("fa-star-o");
            }
        });

        $('#tabla').dataTable({
            "columns": [
                {"width": "2%"},
                {"width": "2%"},
                {"width": "16%"},
                {"width": "50%"},
                {"width": "15%"},
                {"width": "10%"},
            ],
        });

        cargarTablaMensajes();
    });

});

function cargarTablaMensajes() {
    $.ajax({
        type: 'get',
        url: '/pqrs/obtenerMensajes',
        success: function (mensajes) {
            console.log(mensajes);

            let t = $('#tabla').DataTable({
                "destroy": true,
                "lengthMenu": [[5, 10, 15, -1], [5, 10, 15, "Todos"]],
                language: {
                    "decimal": "",
                    "emptyTable": "No hay información",
                    "info": "Mostrando _START_ a _END_ de _TOTAL_ Entradas",
                    "infoEmpty": "Mostrando 0 to 0 of 0 Entradas",
                    "infoFiltered": "(Filtrado de _MAX_ total entradas)",
                    "infoPostFix": "",
                    "thousands": ",",
                    "lengthMenu": "Mostrar _MENU_ ",
                    "loadingRecords": "Cargando...",
                    "processing": "Procesando...",
                    "search": "Buscar:",
                    "zeroRecords": "Sin resultados encontrados",
                    "paginate": {
                        "first": "Primero",
                        "last": "Ultimo",
                        "next": "Siguiente",
                        "previous": "Anterior"
                    }
                },
                "columns": [
                    {"width": "2%"},
                    {"width": "2%"},
                    {"width": "16%"},
                    {"width": "15%"},
                    {"width": "35%"},
                    {"width": "15%"},
                ],
            }).clear().draw();

            for (let i = 0; i < mensajes.length; i++) {
                let mensaje = mensajes[i];
                t.row.add([
                    '',
                    '<td class="mailbox-star"><a href="#" onclick="modalMensaje(\''+mensaje.asunto+'\', \''+mensaje.mensage+'\', \''+mensaje.usuario.nombres + ' ' + mensaje.usuario.apellidos+'\', \''+mensaje.usuario.codigo_afiliado+'\')"><i class="fa fa-external-link text-yellow"></i></a></td>\n',
                    '<td class="mailbox-name"><a href="#" onclick="modalMensaje(\''+mensaje.asunto+'\', \''+mensaje.mensage+'\', \''+mensaje.usuario.nombres + ' ' + mensaje.usuario.apellidos+'\', \''+mensaje.usuario.codigo_afiliado+'\')">' + mensaje.usuario.nombres + ' ' + mensaje.usuario.apellidos + '</a></td>\n',
                    '<td><b>'+mensaje.asunto+'</b></td>\n',
                    '<td>'+mensaje.mensage+'</td>\n',
                    '<td class="mailbox-date">'+mensaje.created_at+'</td>'
                ]).draw();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function modalMensaje(asunto, mensaje, nombres, codigo_afiliado){
    $('#nombres').val(nombres);
    $('#asunto').val(asunto);
    $('#mensaje').val(mensaje);
    $('#codigo').val(codigo_afiliado);
    $('#exampleModalLabel').empty().append(asunto);
    $('#modalMensaje').modal().show();
}