$(function () {
    console.log('asdasd');
    $('#image').change((event) => {
        var file = event.target.files[0];
        var reader = new FileReader();
        console.log('chanfe');
        if (file) {
            reader.readAsDataURL(file);
        }

        setTimeout(function () {
            $('#preview').attr('src', URL.createObjectURL(event.target.files[0]));
            $('#imgdata').val(reader.result);

        }, 300);
    })

});
function cargarSugerencia(){
    Swal.fire({
        title: 'Seguro que desea guardar esta información?',
        text: 'Se guardará la información de sugerencias del chef',
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Si, guardar!',
        cancelButtonText: 'Cancelar'
    }).then((result) => {
        if (result.value) {

            let imagen = $('#imgdata').val();

            if (imagen === '') {
                Swal.fire('Error..', 'Datos incorrectos, intentalo nuevamente', 'warning');
                return false;
            }

            let data = {
                '_token': $("input:hidden[name='_token']").val(),
                'img': imagen
            };

            $.ajax({
                type: 'post',
                url: '/sugerencias-chef/cargarSugerencia',
                data: data,
                success: function (res) {
                    console.log(res);
                    Swal.fire(
                        'Operación Exitosa!',
                        'Inforamación guardada.',
                        'success'
                    );
                    setTimeout(function(){
                        location.reload();
                    }, 350);
                    console.log(res);
                },
                error: function (xhr, ajaxOptions, thrownError) {
                    console.log(xhr);
                    Swal.fire('Error..', 'Algo salío mal, intentalo nuevamente', 'error');
                }
            });
        }
    });

    return false;
}