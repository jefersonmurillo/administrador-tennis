@extends('administrador.index')

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Listado de eventos</h3>
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