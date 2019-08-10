$(function () {
    $(document).ready(function () {
        $('#table-disciplinas_wrapper .dataTables_filter').append(' <a href="#" onclick="abrirModal()"><input type="button" value="Registrar Nueva   " class="btn btn-block btn-success"></a>');
    });

    $('#form-actualizar').submit((e) => {
        e.preventDefault();

        Swal.fire({
            title: 'Seguro que desea guardar esta información?',
            text: 'Se guardarán datos personales del usaurio',
            type: 'warning',
            showCancelButton: true,
            confirmButtonText: 'Si, guardar!',
            cancelButtonText: 'Cancelar'
        }).then((result) => {
            if (result.value) {
                let disciplina = $('#nombre_disciplina').val();
                let id = $('#id_disciplina').val();
                let token = $("input:hidden[name='_token']").val();
                let data = {
                    '_token': token,
                    id: id,
                    disciplina: disciplina
                };

                if (disciplina === '') {
                    $('#alerta').empty().append('' +
                        '<div class="alert alert-warning alert-dismissible">\n' +
                        '    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>\n' +
                        '    <h4><i class="icon fa fa-warning"></i> Datos incorrectos! por favor revisan la información suministrada.</h4>\n' +
                        '</div>');
                    return false;
                }

                if (id !== undefined) console.log('post'); else console.log('put');

                $.ajax({
                    type: id === undefined || id === '' ? 'post' : 'put',
                    url: '/disciplinas/' + id,
                    data: data,
                    success: function (res) {
                        console.log(res);
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

                        setTimeout(function () {
                            location.reload()
                        }, 1500);
                    },
                    error: function (xhr, ajaxOptions, thrownError) {
                        console.log(thrownError, xhr);
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

        return false;
    })
});

function abrirModal(id, disciplina) {
    if (id !== undefined && disciplina !== undefined) {
        $('#nombre_disciplina').val(disciplina);
        $('#id_disciplina').val(id);
    }

    $('#exampleModal').modal().show();
}

function eliminarDisciplina(id) {
    Swal.fire({
        title: 'Está seguro?',
        text: 'Se eliminará el usuario seleccionado!',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, eliminar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {
            $.ajax({
                type: 'delete',
                url: '/disciplinas/' + id,
                data: {'_token': $("input:hidden[name='_token']").val()},
                success: function (res) {
                    Swal.fire(
                        'Disciplina eliminado!',
                        'Los datos de la disciplina han sido borrados.',
                        'success'
                    );

                    setTimeout(function () {
                        location.reload()
                    }, 1500);
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