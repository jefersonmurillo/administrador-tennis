let instalacion = undefined;
try {
    instalacion = insta;
} catch (e) {
    instalacion = undefined;
}

$(function () {

    $(document).ready(function () {
        if (instalacion !== undefined) {
            llenarFormulario();
        }
    });

    $('#form-registro-instalacion').submit(function (e) {
        e.preventDefault();

        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardará la información de la instalación',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {

                let nombre = $('#nombre').val();
                let tipo = $('#tipo-instalacion').val();
                let descripcion = $('#descripcion').val();
                let imagenDestacada = $('#imgdestacada').val();

                if (nombre === '' || tipo === '0' || descripcion === '' || imagenDestacada === '') {
                    Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                    return false;
                }

                let data = {
                    '_token': $("input:hidden[name='_token']").val(),
                    'nombre': nombre,
                    'tipo': tipo,
                    'descripcion': descripcion,
                    'imgDestacada': imagenDestacada
                };

                $.ajax({
                    type: 'post',
                    url: '/instalaciones',
                    data: data,
                    success: function (res) {
                        $('#alerta').empty().append('' +
                            '<div class="alert alert-success alert-dismissible">\n' +
                            '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                            '    <h4><i class="icon fa fa-check"></i> Operación Exitosa!, información guardada</h4>\n' +
                            '</div>');

                        Swal.fire(
                            'Operación Exitosa!',
                            'Inforamación guardada.',
                            'success'
                        );

                        console.log(res.data.id, res.data.nombre);
                        $('#id_instalacion').val(res.data.id);
                        $('#exampleModal').modal().show();
                        cargarImagenesInstalacion();
                        mostarBotonActualizar();
                        mostarBotonNuevasImagenes();
                        /*if (instalacion === undefined) limpiarFormulario();*/
                        console.log(res);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(xhr);
                        $('#alerta').empty().append('' +
                            '<div class="alert alert-danger alert-dismissible">\n' +
                            '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                            '    <h4><i class="icon fa fa-ban"></i> Error... Algo salío mal, intentalo nuevamente</h4>' +
                            '</div>');
                        Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                    }
                });
            }
        });

        return false;
    });

    $('#imagenDesatacada').change((event) => {
        var file = event.target.files[0];
        var reader = new FileReader();

        if (file) {
            reader.readAsDataURL(file);
        }

        setTimeout(function () {
            $('#output').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#imgdestacada').val(reader.result);
            $('#modalPreview').modal().show();

        }, 300);
    })

});

function cargarImagenesInstalacion() {
    let id = $('#id_instalacion').val();
    console.log(id)
    let ajax = function () {
        $.ajax({
            type: 'get',
            url: '/instalaciones/images/' + id,
            success: function (res) {
                let html = '' +
                    '<div class="row">\n' +
                    '    <div class="col-md-12">\n' +
                    '        <div class="box">\n' +
                    '            <div class="box-body">\n';

                for (let i = 0; i < res.length; i++) {
                    html += '' +
                        '<div class="col-sm-4">\n' +
                        '    <div class="alert alert-info alert-dismissible"\n' +
                        '         style="background-color: #ecf0f561 !important;\n' +
                        '                border-color: #ffffff00;\n' +
                        '                border-radius: 0px;\n' +
                        '                color: #31708f00 !important;">\n' +
                        '        <button type="button" class="close" data-dismiss="alert" aria-hidden="true"\n' +
                        '                style="color: #000;\n' +
                        '                opacity: .6;\n' +
                        '                font-size: 30px;" onclick="eliminarImagenInstalacion(' + res[i]['id'] + ')">×\n' +
                        '        </button>\n' +
                        '        <img src="https://appadministrador.tennisgolfclub.com.co/' + res[i]['url'] + '" alt=""\n' +
                        '             style="width: 100%; height: 100%;">\n' +
                        '    </div>\n' +
                        '</div>\n';
                }

                html += '            </div>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '</div>';

                $('#imgsInstalacion').empty().append(html);
                console.log(res);
            },
            error: function (xhr, ajaxOptions, thrownError) {
                console.log(xhr);
            }
        });
    };

    setInterval(ajax, 900);
}

function actualizarInstalacion() {
    Swal.fire({
        title: 'Seguro que desea guardar esta información?',
        text: 'Se guardará la información de la instalación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let nombre = $('#nombre').val();
            let tipo = $('#tipo-instalacion').val();
            let descripcion = $('#descripcion').val();
            let imagenDestacada = $('#imgdestacada').val();

            if (nombre === '' || tipo === '0' || descripcion === '') {
                Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                return false;
            }

            let data = {
                '_token': $("input:hidden[name='_token']").val(),
                'nombre': nombre,
                'tipo': tipo,
                'descripcion': descripcion,
                'imgDestacada': imagenDestacada
            };

            let id = $('#id_instalacion').val();

            $.ajax({
                type: 'put',
                url: '/instalaciones/' + id,
                data: data,
                success: function (res) {
                    $('#alerta').empty().append('' +
                        '<div class="alert alert-success alert-dismissible">\n' +
                        '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                        '    <h4><i class="icon fa fa-check"></i> Operación Exitosa!, información guardada</h4>\n' +
                        '</div>');

                    Swal.fire(
                        'Operación Exitosa!',
                        'Inforamación guardada.',
                        'success'
                    );

                    console.log(res);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    $('#alerta').empty().append('' +
                        '<div class="alert alert-danger alert-dismissible">\n' +
                        '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                        '    <h4><i class="icon fa fa-ban"></i> Error... Algo salío mal, intentalo nuevamente</h4>\n' +
                        '</div>');
                    Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                }
            });
        }
    });

}

function mostarBotonNuevasImagenes() {
    $('#btnNuevasImagenes').empty().append('' +
        '<a class="btn btn-app" style="padding-top: 1px; padding-bottom: 1px; height: 37px;"\n' +
        '   onclick="$(\'#modalPreview\').modal().show();">\n' +
        '    <i class="fa fa-play"></i> Vista Previa img destacada\n' +
        '</a>' +
        '<a class="btn btn-app" style="padding-top: 1px; padding-bottom: 1px; height: 37px;"\n' +
        '   onclick="$(\'#exampleModal\').modal().show();">\n' +
        '    <i class="fa fa-object-group"></i> Cargar nuevas imagenes\n' +
        '</a>');
}

function mostarBotonActualizar() {
    $('#btnRegistrar').empty();
    $('#btnActualizar').empty().append('' +
        '<div class="row">\n' +
        '    <div class="col-md-12">\n' +
        '        <div class="box">\n' +
        '            <div class="box-body">\n' +
        '                <form role="form">\n' +
        '                    <div class="row">\n' +
        '                        <div class="col-sm-12">\n' +
        '                            <div class="form-group">\n' +
        '                                <input type="button"\n' +
        '                                       value="Actualizar"\n' +
        '                                       class="btn btn-block btn-success" onclick="actualizarInstalacion()">\n' +
        '                            </div>\n' +
        '                        </div>\n' +
        '                    </div>\n' +
        '                </form>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '</div>');
}

function eliminarImagenInstalacion(id) {
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
                url: '/instalaciones/images/' + id,
                data: {'_token': $("input:hidden[name='_token']").val()},
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Imagen eliminada!',
                        'La imagen de la instalación ha sido borrada.',
                        'success'
                    );
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                }
            });
        }
    });
}

function llenarFormulario() {
    console.log(instalacion);
    $('#nombre').val(instalacion.nombre);

    let html = '' +
        '<div class="form-group">\n' +
        '    <label>Tipo de instalación</label>\n' +
        '    <select id="tipo-instalacion" class="form-control" name="tipo-instalacion" required>\n' +
        '        <option value="0">Seleccione</option>\n';

    for (let i = 0; i < tiposInstalacion.length; i++) {
        if (instalacion.tipo_instalacion_id === tiposInstalacion[i].id)
            html += '<option value="' + tiposInstalacion[i].id + '" selected>' + tiposInstalacion[i].tipo + '</option>';
        else html += '<option value="' + tiposInstalacion[i].id + '">' + tiposInstalacion[i].tipo + '</option>';
    }

    html += '' +
        '    </select>\n' +
        '</div>';

    $('#selectTipoInstalacion').empty().append(html);
    $('#id_instalacion').val(instalacion.id);
    $('#descripcion').val(instalacion.descripcion);
    $('#output').attr('src', 'https://appadministrador.tennisgolfclub.com.co/'+instalacion.imagen_destacada);
    cargarImagenesInstalacion();
    mostarBotonNuevasImagenes();
    mostarBotonActualizar();
}