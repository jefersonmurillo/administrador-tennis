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
                    '        10 Feb. 2014\n' +
                    '      </span>\n' +
                    '    </li>\n' ;

                for (let j = 0; j < evento.length; j++) {
                    console.log(evento[j]);

                    let tipo = '';

                    if(evento[j].tipo_evento_id === 1) tipo = 'fa fa-group bg-blue';
                    else if(evento[j].tipo_evento_id === 2) tipo = 'fa fa-child bg-yellow';
                    else if(evento[j].tipo_evento_id === 3) tipo = 'fa fa-hand-peace-o bg-maroon';

                    console.log(tipo, evento[i].tipo_evento_id);
                    html += '' +
                        '    <li>\n' +
                        '        <i class="'+tipo+'"></i>\n' +
                        '        <div class="timeline-item">\n' +
                        '            <span class="time"><i class="fa fa-clock-o"></i> 12:05</span>\n' +
                        '            <h3 class="timeline-header"><a href="#">Support Team</a> sent you an email</h3>\n' +
                        '            <div class="timeline-body">\n' +
                        '                <div>\n' +
                        '                    Etsy doostang zoodles disqus groupon greplin oooj voxy zoodles,\n' +
                        '                    weebly ning heekya handango imeem plugg dopplr jibjab, movity\n' +
                        '                    jajah plickers sifteo edmodo ifttt zimbra. Babblely odeo kaboodle\n' +
                        '                    quora plaxo ideeli hulu weebly balihoo...\n' +
                        '                </div>\n' +
                        '                <div>\n' +
                        '                    <img src="http://placehold.it/150x100" alt="..." class="margin">\n' +
                        '                    <img src="http://placehold.it/150x100" alt="..." class="margin">\n' +
                        '                    <img src="http://placehold.it/150x100" alt="..." class="margin">\n' +
                        '                    <img src="http://placehold.it/150x100" alt="..." class="margin">\n' +
                        '                </div>' +
                        '            <div class="timeline-footer">\n' +
                        '                <a class="btn btn-primary btn-xs">Read more</a>\n' +
                        '                <a class="btn btn-danger btn-xs">Delete</a>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </li>\n';
                }
            }

            // fecha


            // final

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

function armarEventoFamiliar() {

}

function armarEventoNinios() {

}

function armarEventoAdultos() {

}