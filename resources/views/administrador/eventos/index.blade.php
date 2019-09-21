@extends('administrador.index')

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Listado de eventos</h3>
                        <button type="button" class="btn bg-olive btn-flat margin" style="float: right;margin-top: 0px; margin-bottom: 0px;" onclick="location.href='https://appadministrador.tennisgolfclub.com.co/eventos/create'">
                            Nuevo Evento
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <div class="callout callout-info">
                            <h4>Para tener en cuenta</h4>
                            <p>La primera imagen que aparece de izquierda a derecha corresponde a la imagen establecída como destacada para la app movil</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div id="eventos"></div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/eventos-list.js') }}"></script>
@endsection