$(function () {
    $(document).ready(function () {
        cargarDatos();
    });
});

function cargarDatos() {
    let instalacnes = instalaciones;
    console.log(instalaciones);
    let html = '';

    for (let i = 0; i < instalacnes.length; i++) {
        html += '' +
            '<div class="col-md-6" id="instalacion_'+instalacnes[i].id+'">\n' +
            '    <!-- Box Comment -->\n' +
            '    <div class="box box-widget">\n' +
            '        <div class="box-header with-border">\n' +
            '            <div class="user-block">\n' +
            '                <img class="img-circle" src="https://appadministrador.tennisgolfclub.com.co/template/dist/img/user2-160x160.jpg"\n' +
            '                     alt="User Image">\n' +
            '                <span class="username"><a href="#">' + instalacnes[i].nombre + '</a></span>\n' +
            '                <span class="description">' + instalacnes[i].created_at + '</span>\n' +
            '            </div>\n' +
            '            <!-- /.user-block -->\n' +
            '            <div class="box-tools">\n' +
            '                 <div class="btn-group">\n' +
            '                  <button type="button" class="btn btn-default">Opciones</button>\n' +
            '                  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">\n' +
            '                    <span class="caret"></span>\n' +
            '                    <span class="sr-only">Toggle Dropdown</span>\n' +
            '                  </button>\n' +
            '                  <ul class="dropdown-menu" role="menu">\n' +
            '                    <li><a href="https://appadministrador.tennisgolfclub.com.co/instalaciones/'+instalacnes[i].id+'">Modificar</a></li>\n' +
            '                    <li class="divider"></li>\n' +
            '                    <li><a href="#" onclick="eliminarInstalacion('+instalacnes[i].id+')">Eliminar</a></li>\n' +
            '                  </ul>\n' +
            '                </div>' +
            '            </div>\n' +
            '            <!-- /.box-tools -->\n' +
            '        </div>\n' +
            '        <!-- /.box-header -->\n' +
            '        <div class="box-body">\n' +
            '            <img class="img-responsive pad" src="https://appadministrador.tennisgolfclub.com.co/' + instalacnes[i].imagen_destacada + '" alt="Photo">\n' +
            '\n' +
            '            <p>' + instalacnes[i].descripcion + '</p>\n' +
            '            <button type="button" class="btn btn-default btn-xs"><i class="fa fa-info"></i>' + instalacnes[i].tipo_instalacion.tipo + '</button>\n' +
            '        </div>\n' +
            '\n' +
            '    </div>\n' +
            '    <!-- /.box -->\n' +
            '</div>'
    }

    $('#instalaciones').empty().append(html);
}

function eliminarInstalacion(id){
    Swal.fire({
        title: 'Está seguro?',
        text: 'Se eliminará la instalación seleccionada!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: '/instalaciones/' + id,
                data: {'_token': $("input:hidden[name='_token']").val()},
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'IInstalación eliminada!',
                        'La información de la instalación ha sido borrada.',
                        'success'
                    );

                    $('#instalacion_'+id).remove();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                }
            });
        }
    });
}