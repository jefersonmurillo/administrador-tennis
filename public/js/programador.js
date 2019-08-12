$(function () {
    $(document).ready(function () {
        cargarTablaDiasEscenario();
        $('#table-reservaciones').DataTable({
            "scrollY": 370,
            "columns": [
                { "width": "15%" },
                { "width": "10%" },
                { "width": "10%" },
                { "width": "60%" },
                { "width": "5%" },
            ],
        });
    });
});

function cargarTablaDiasEscenario() {
    let id = $('#id-escenario').val();
    $.ajax({
        type: 'post',
        url: '/tee-time/fechasProgramadasEscenario/' + id,
        data: {'_token': $("input:hidden[name='_token']").val()},
        success: function (res) {
            $('#body-table-fechas').empty().append('<center>' +
                '<table id="table-fechas" class="table table-bordered table-striped">\n' +
                '    <thead>\n' +
                '    <tr>\n' +
                '        <th>Fecha</th>\n' +
                '        <th>Acciones</th>\n' +
                '    </tr>\n' +
                '    </thead>\n' +
                '    <tbody id="table-fechas-rows" style="font-size: 12px;">\n' +
                '\n' +
                '    </tbody>\n' +
                '</table>' +
                '</center>');

            let t = $('#table-fechas').DataTable({
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
                "scrollY": 370,
            }).clear().draw();

            for (let i = 0; i < res.length; i++) {
                t.row.add([
                    res[i].fecha,
                    '<div class="btn-group">\n' +
                    '  <button type="button" class="btn btn-default">Opciones</button>\n' +
                    '  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">\n' +
                    '    <span class="caret"></span>\n' +
                    '    <span class="sr-only">Toggle Dropdown</span>\n' +
                    '  </button>\n' +
                    '  <ul class="dropdown-menu" role="menu" style="min-width: 0px;">\n' +
                    '    <li><a href="#" onclick="cargarTablaReservaciones(\'' + id + '\', \'' + res[i].fecha + '\')">Ver</a></li>\n' +
                    '    <li class="divider"></li>\n' +
                    '    <li><a href="#" onclick="eliminarDiaHoraProgramada(\''+res[i].id+'\',  \''+res[i].fecha+'\')">Eliminar</a></li>\n' +
                    '  </ul>\n' +
                    '</div>'
                ]).draw();
            }

            $('#table-fechas_filter label').remove();
            $('#table-fechas_filter').append(' <a href="#" onclick="abrirModal()"><input type="button" value="Registrar Nueva   " class="btn btn-block btn-success"></a>');

        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function cargarTablaReservaciones(id, fecha) {
    $.ajax({
        type: 'post',
        url: '/tee-time/reservacionesEscenarioFecha/' + id + '/' + fecha,
        data: {'_token': $("input:hidden[name='_token']").val()},
        success: function (res) {

            $('#body-table-reservaciones').empty().append('' +
                '<table id="table-reservaciones" class="table table-bordered table-striped">\n' +
                '    <thead>\n' +
                '    <tr>\n' +
                '        <th>Fecha</th>\n' +
                '        <th>Hora</th>\n' +
                '        <th>Estado</th>\n' +
                '        <th>Jugadores</th>\n' +
                '        <th>Acciones</th>\n' +
                '    </tr>\n' +
                '    </thead>\n' +
                '    <tbody>\n' +
                '\n' +
                '    </tbody>\n' +
                '</table>');

            let t = $('#table-reservaciones').DataTable({
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
                "scrollY": 370,
                "columns": [
                    { "width": "15%" },
                    { "width": "10%" },
                    { "width": "10%" },
                    { "width": "60%" },
                    { "width": "5%" },
                ],
            }).clear().draw();

            for (let i = 0; i < res.length; i++) {
                let estado = '';
                if (res[i].estado === 'DISPONIBLE')
                    estado = '<span class="badge bg-red;" style="background-color: #00a65a !important">DISPONIBLE</span>';
                else if (res[i].estado === 'APROBADO')
                    estado = '<span class="badge bg-red;" style="background-color: #00c0ef !important;">APROBADO</span>';
                else if (res[i].estado === 'DESAPROBADO')
                    estado = '<span class="badge bg-red;" style="background-color: #dd4b39 !important;">DESAPROBADO</span>';
                else if (res[i].estado === 'RESERVADO')
                    estado = '<span class="badge bg-red;" style="background-color: #f39c12 !important;">RESERVADO</span>';

                let grupo = '';

                if (res[i].jugador1 !== null) {
                    grupo += res[i].jugador1.nombres + ' ' + res[i].jugador1.apellidos + ' - ';
                    grupo += res[i].jugador2.nombres + ' ' + res[i].jugador2.apellidos + ' - ';
                    if (res[i].jugador4 !== null) {
                        grupo += res[i].jugador3.nombres + ' ' + res[i].jugador3.apellidos + ' - ';
                        grupo += res[i].jugador4.nombres + ' ' + res[i].jugador4.apellidos + ' ';
                    } else {
                        grupo += res[i].jugador3.nombres + ' ' + res[i].jugador3.apellidos + '  ';
                    }
                }

                let hora = res[i].hora.split('.');

                t.row.add([
                    res[i].fecha,
                    hora[0],
                    estado,
                    grupo,
                    '<div class="btn-group">\n' +
                    '  <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown">\n' +
                    '    <span class="caret"></span>\n' +
                    '    <span class="sr-only">Toggle Dropdown</span>\n' +
                    '  </button>\n' +
                    '  <ul class="dropdown-menu" role="menu" style="min-width: 0px;">\n' +
                    '    <li><a href="#" onclick="cambiarEstado(\''+res[i].id+'\', '+'\'APROBADO\''+', \''+res[i].fecha+'\')">Aprobar</a></li>\n' +
                    '    <li><a href="#" onclick="cambiarEstado(\''+res[i].id+'\', '+'\'DESAPROBADO\''+', \''+res[i].fecha+'\')">Desaprobar</a></li>\n' +
                    '    <li class="divider"></li>\n' +
                    '    <li><a href="#" onclick="eliminarDiaHoraProgramada(\''+res[i].id+'\',  \''+res[i].fecha+'\')">Eliminar</a></li>\n' +
                    '  </ul>\n' +
                    '</div>'
                ]).draw();
            }
        },
        error: function (xhr, ajaxOptions, thrownError) {
            console.log(xhr);
        }
    });
}

function registrarProgramacion(){
    Swal.fire({
        title: 'Seguro que desea guardar esta información?',
        text: 'Se guardarán datos del escenario',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let fecha = $('#fecha_programacion').val();
            let hora = $('#hora_programacion').val();
            let escenario = $('#id-escenario').val();

            if(fecha === '' || hora === '' || escenario === '' || escenario === undefined){
                Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                return false;
            }

            let data = {
                '_token': $("input:hidden[name='_token']").val(),
                id: escenario,
                fecha: fecha,
                hora: hora
            };

            $.ajax({
                type: 'post',
                url: '/tee-time/registrarProgramacionEscenario',
                data: data,
                success: function (res) {
                    Swal.fire(
                        'Operación Exitosa!',
                        'Inforamación guardada.',
                        'success'
                    );

                    cargarTablaDiasEscenario();
                    $('#table-reservaciones').DataTable({
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
                        "scrollY": 370,
                        "columns": [
                            { "width": "15%" },
                            { "width": "10%" },
                            { "width": "10%" },
                            { "width": "60%" },
                            { "width": "5%" },
                        ],
                    }).clear().draw();
                    $('#fecha_programacion').val('');
                    $('#hora_programacion').val('');
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(thrownError, xhr);
                    Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                }
            });
        }

    });

    return false;
}

function abrirModal() {
    $('#exampleModal').modal().show();
}

function cambiarEstado(id, estado, fecha){
    Swal.fire({
        title: 'Está seguro?',
        text: 'Se cambiará el estado de la reservación!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, cambiar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let data = {
                'id': id,
                'estado': estado,
                '_token': $("input:hidden[name='_token']").val(),
            };

            $.ajax({
                type: 'post',
                url: '/tee-time/cambiarEstadoDiaProgramado',
                data: data,
                success: function (res) {
                    Swal.fire(
                        'Actualizado!',
                        'Estado actualizado.',
                        'success'
                    );

                    let id_escenario = $('#id-escenario').val();
                    cargarTablaReservaciones(id_escenario, fecha);
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

function eliminarDiaHoraProgramada(id = undefined, fecha){
    Swal.fire({
        title: 'Está seguro que quiere eliminar esta hora programada?',
        text: 'Se borraran los datos de la reservación',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let data = {
                'id': id,
                '_token': $("input:hidden[name='_token']").val(),
                'fecha': fecha
            };

            $.ajax({
                type: 'delete',
                url: '/tee-time/eliminarFechaDiaHoraProgramada',
                data: data,
                success: function (res) {
                    Swal.fire(
                        'Dia programado eliminado!',
                        'Datos borrados.',
                        'success'
                    );

                    let id_escenario = $('#id-escenario').val();
                    cargarTablaDiasEscenario()
                    cargarTablaReservaciones(id_escenario, fecha);
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