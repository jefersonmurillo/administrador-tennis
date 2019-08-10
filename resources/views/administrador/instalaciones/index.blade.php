@extends('administrador.index')

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Listado de instalaciones</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div id="instalaciones"></div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/instalaciones-list.js') }}"></script>
@endsection