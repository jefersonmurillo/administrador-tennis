$(function () {

    $(document).ready(function () {
        cargarEscenarios();
    });

    $('#form-registrar-escenario').submit((e) => {
        e.preventDefault();

        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardarán datos del escenario',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let disciplina = $('#disciplina').val();
                let nombre = $('#nombre').val();
                let id = $('#id').val();

                let token = $("input:hidden[name='_token']").val();
                let data = {};

                if (id !== '') {
                    data = {
                        '_token': token,
                        id: id,
                        disciplina: disciplina,
                        nombre: nombre
                    }
                } else {
                    data = {
                        '_token': token,
                        disciplina: disciplina,
                        nombre: nombre
                    }
                }

                if (disciplina === '0') {
                    Swal.fire('Error..', 'Datos incorrectos', 'error');
                    return false;
                }

                if (id !== undefined) console.log('post'); else console.log('put');

                $.ajax({
                    type: 'post',
                    url: '/tee-time/registrarEscenario',
                    data: data,
                    success: function (res) {
                        Swal.fire(
                            'Operación Exitosa!',
                            'Inforamación guardada.',
                            'success'
                        );

                        cargarEscenarios();
                        $('#form-registrar-escenario .close').click();
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError, xhr);
                        Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                    }
                });
            }

        });

        return false;
    })

});

function cargarModalEscenario(registrar = true, id = undefined, nombre = undefined, disciplina_id = undefined) {
    let disciplinas = [];
    $.ajax({
        type: 'get',
        url: 'http://localhost:8000/api/v1/disciplinas',
        success: function (res) {
            disciplinas = res.data;
            let html = '' +
                '    <label>Disciplina</label>\n' +
                '    <select id="disciplina" class="form-control" name="disciplina" required>\n' +
                '        <option value="0">Seleccione</option>\n';

            for (let i = 0; i < disciplinas.length; i++) {
                if (!registrar && disciplina_id === disciplinas[i].id+'')
                    html += '<option value="' + disciplinas[i].id + '" selected>' + disciplinas[i].nombre + '</option>';
                else html += '<option value="' + disciplinas[i].id + '">' + disciplinas[i].nombre + '</option>';
            }

            html += '' +
                '    </select>\n';

            if (!registrar) {
                $('#tetleFormEscenario').empty().append('Actualizar Escenario');
                $('#BotonFormRegistro').val('Actualizar');
                $('#id').val(id);
                $('#nombre').val(nombre);
            }

            $('#disciplinas').empty().append(html);
            $('#modalRegistro').modal().show();

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function cargarEscenarios() {
    let html = '';
    $.ajax({
        type: 'post',
        url: '/tee-time/escenarios',
        data: {'_token': $("input:hidden[name='_token']").val()},
        success: function (res) {
            console.log(res);
            for (let i = 0; i < res.length; i++) {
                html += '' +
                    '<div class="col-md-4">\n' +
                    '    <div class="box box-widget widget-user-2">\n' +
                    '        <!-- Add the bg color to the header using any of the bg-* classes -->\n' +
                    '        <div class="widget-user-header bg-green" style="padding: 5px !important;">\n' +
                    '            <a href="#" onclick="eliminarEscenario(\''+res[i].id+'\')" style="color: white; margin-right: 5px;"><i class="fa fa-remove" style="font-size: 20px;"></i></a>\n' +
                    '            <a href="#" onclick="cargarModalEscenario(false, \''+res[i].id+'\', \''+res[i].nombre+'\' , \''+res[i].disciplina_id+'\')" style="color: white; margin-right: 5px;"><i class="fa fa-pencil-square-o" style="font-size: 20px;"></i></a>\n' +
                    '            <a href="http://localhost:8000/tee-time/show/'+res[i].id+'" style="color: white; margin-right: 5px;"><i class="fa fa-tripadvisor" style="font-size: 20px;"></i></a>\n' +
                    '\n' +
                    '            <a href="" style="text-decoration: none; color: white"><h3 class="widget-user-username" onclick="">' + res[i].nombre + '</h3></a>\n' +
                    '            <a href="" style="text-decoration: none; color: white"><h5 class="widget-user-desc" onclick="">Disciplina: ' + res[i].disciplina.nombre + '</h5></a>\n' +
                    '        </div>\n' +
                    '        <div class="box-footer no-padding">\n' +
                    '            <ul class="nav nav-stacked">\n' +
                    '                <li><a href="#">Reservaciones Disponibles <span class="pull-right badge bg-green">' + res[i].disponibles.length + '</span></a></li>\n' +
                    '                <li><a href="#">Reservaciones Aprobadas <span class="pull-right badge bg-aqua">' + res[i].aprobados.length + '</span></a></li>\n' +
                    '                <li><a href="#">Reservaciones Desaprobadas <span class="pull-right badge bg-red">' + res[i].desaprobados.length + '</span></a></li>\n' +
                    '                <li><a href="#">Reservaciones Pendientes <span class="pull-right badge bg-yellow">' + res[i].pendientes.length + '</span></a>\n' +
                    '                </li>\n' +
                    '            </ul>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '</div>';
            }

            $('#escenarios').empty().append(html);
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });

}

function eliminarEscenario(id){
    Swal.fire({
        title: 'Está seguro que quiere eliminar este escenario?',
        text: 'Se borraran los datos el escenario y las reservaciones en caso de tenerlas',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let data = {
                'id': id,
                '_token': $("input:hidden[name='_token']").val(),
            };

            $.ajax({
                type: 'delete',
                url: '/tee-time/eliminarEscenario',
                data: data,
                success: function (res) {
                    Swal.fire(
                        'Escenario eliminado!',
                        'Datos borrados.',
                        'success'
                    );

                    cargarEscenarios();

                },
                error: function (xhr, ajaxOptions, thrownError) {
                    Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                    console.log(thrownError, xhr);
                }
            });
        }
    });

    return false;
}

function cargarTabla(id, estado) {
    $.ajax({
        type: 'post',
        url: '/tee-time/obtenerDiasEstado/' + id + '/' + estado,
        data: {'_token': $("input:hidden[name='_token']").val()},
        success: function (res) {
            console.log(res, estado, id);

            $('#modal-dias-table').empty().append('' +
                '<table id="table-dias" class="table table-bordered table-striped">\n' +
                '    <thead>\n' +
                '    <tr>\n' +
                '        <th>Fecha</th>\n' +
                '        <th>Hora</th>\n' +
                '        <th>Estado</th>\n' +
                '        <th>Jugadores</th>\n' +
                '        <th>Acciones</th>\n' +
                '    </tr>\n' +
                '    </thead>\n' +
                '    <tbody id="body_data_dias">\n' +
                '\n' +
                '    </tbody>\n' +
                '</table>');

            let t = $('#table-dias').DataTable({
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
                    "lengthMenu": "Mostrar _MENU_ Entradas",
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
            }).clear().draw();

            for (let i = 0; i < res.programador.length; i++) {
                t.row.add([
                    res.programador[i].fecha,
                    res.programador[i].hora,
                    res.programador[i].estado,
                    res.programador[i].grupo_jugadores_golf,
                    res.programador[i].grupo_jugadores_golf
                ]).draw();
            }

            $('#modalDias').modal().show();
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

