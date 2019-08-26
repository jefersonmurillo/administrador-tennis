$(function () {
    $(document).ready(function () {
        cargarEventos();
    });
});

function cargarEventos() {
    $.ajax({
        type: 'get',
        url: '/eventos/shows',
        success: function (eventos) {
            console.log(eventos);

            let html = '' +
                '<ul class="timeline">\n';

            for (let i = 0; i < eventos.length; i++) {
                let evento = eventos[i].dias;

                html += '' +
                    '    <li class="time-label">\n' +
                    '      <span class="bg-red">\n' +
                    eventos[i].fecha +
                    '      </span>\n' +
                    '    </li>\n';

                for (let j = 0; j < evento.length; j++) {
                    console.log(evento[j]);

                    let tipo = '';

                    if (evento[j].tipo_evento_id === 1) tipo = 'fa fa-group bg-blue';
                    else if (evento[j].tipo_evento_id === 2) tipo = 'fa fa-child bg-yellow';
                    else if (evento[j].tipo_evento_id === 3) tipo = 'fa fa-hand-peace-o bg-maroon';

                    html += '' +
                        '    <li>\n' +
                        '        <i class="' + tipo + '"></i>\n' +
                        '        <div class="timeline-item">\n' +
                        '            <span class="time"><i class="fa fa-clock-o"></i> ' + evento[j].created_at + ' --- ' + evento[j].prioridad.prioridad + '</span>\n' +
                        '            <h3 class="timeline-header"><a href="#">' + evento[j].nombre + '</a></h3>\n' +
                        '            <div class="timeline-body">\n' +
                        '                <div>' + evento[j].descripcion + '</div>\n' +
                        '                <div>\n';

                    html += '<div class="row">';

                    html += '                ' +
                        '<div class="col-sm-3" style="height: 200px !important;">\n' +
                        '    <div class="alert alert-info alert-dismissible"\n' +
                        '         style="background-color: #ecf0f561 !important;\n' +
                        '                border-color: #ffffff00;\n' +
                        '                border-radius: 0px;\n' +
                        '                color: #31708f00 !important; padding: 0px !important;">\n' +
                        '        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"\n' +
                        '                style="color: #000;\n' +
                        '                opacity: .6;\n' +
                        '                font-size: 30px;">×\n' +
                        '        </button>\n' +
                        '         <img src="https://appadministrador.tennisgolfclub.com.co/' + evento[j].imagen_destacada + '" width="150" alt="Imagen Destacada" class="margin">' +
                        '    </div>\n' +
                        '</div>\n';

                    console.log(evento[j].imagenes_eventos);
                    for (let k = 0; k < evento[j].imagenes_eventos.length; k++) {
                        html += '' +
                            '<div class="col-sm-3" style="height: 200px !important;">\n' +
                            '    <div class="alert alert-info alert-dismissible"\n' +
                            '         style="background-color: #ecf0f561 !important;\n' +
                            '                border-color: #ffffff00;\n' +
                            '                border-radius: 0px;\n' +
                            '                color: #31708f00 !important; padding: 0px !important;">\n' +
                            '        <button type="button" class="close" ' +
                            '                style="color: #000;\n' +
                            '                opacity: .6;\n' +
                            '                font-size: 30px;" onclick="eliminarImagenEvento(' + evento[j].imagenes_eventos[k].id + ')">×\n' +
                            '        </button>\n' +
                            '         <img src="https://appadministrador.tennisgolfclub.com.co/' + evento[j].imagenes_eventos[k].url + '" width="150" alt="..." class="margin">' +
                            '    </div>\n' +
                            '</div>\n';
                    }

                    html += '</div>';

                    html += '                ' +
                        '                </div>' +
                        '            <div class="timeline-footer">\n' +
                        '                <a href="https://appadministrador.tennisgolfclub.com.co/' + evento[j].id + '" class="btn btn-primary btn-xs">Modificar</a>\n' +
                        '                <a class="btn btn-danger btn-xs" onclick="eliminarEvento(' + evento[j].id + ')">Aliminar</a>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </li>\n';
                }
            }

            html += '' +
                '    <li>\n' +
                '        <i class="fa fa-clock-o bg-gray"></i>\n' +
                '    </li>\n';

            html += '' +
                '</ul>';

            $('#eventos').empty().append(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(thrownError, xhr);

        }
    });
}

function eliminarEvento(id) {
    Swal.fire({
        title: 'Está seguro?',
        text: 'Se eliminará el evento seleccionado!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: '/eventos/' + id,
                data: {'_token': $("input:hidden[name='_token']").val()},
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Evento eliminado!',
                        'La información del evento ha sido borrado.',
                        'success'
                    );

                    cargarEventos();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                }
            });
        }
    });
}

function eliminarImagenEvento(id) {
    Swal.fire({
        title: 'Está seguro?',
        text: 'Se eliminará la imagen seleccionado!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: '/eventos/images/' + id,
                data: {'_token': $("input:hidden[name='_token']").val()},
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Imagen eliminada!',
                        'La imagen de la instalación ha sido borrada.',
                        'success'
                    );

                    cargarEventos();
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                }
            });
        }
    });
}
