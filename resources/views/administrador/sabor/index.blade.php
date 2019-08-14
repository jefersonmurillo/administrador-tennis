@extends('administrador.index')

@section('css')
@endsection

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Sabor Gourmet</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Selecionar</h3>
                    </div>
                    <div class="box-body" id="body-table-fechas">
                        <div class="col-sm-7">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label"></label>
                                <input type="file" class="form-control" id="image">
                                <input type="hidden" class="form-control" id="imgdata">
                            </div>
                        </div>
                        <div class="col-sm-5">
                            <div class="form-group">
                                <button type="button" class="btn bg-olive btn-flat margin"
                                        style="float: right;margin-top: 0px; margin-bottom: 0px;"
                                        onclick="cargarSabor()">
                                    Nuevo Evento
                                </button>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <div class="form-group">
                                <img src="" alt="" style="width: 100%;" id="preview">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Imagen actual</h3>
                    </div>
                    <div class="box-body" id="body-table-fechas">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <img src="http://localhost:8001/{{ count($sabore)>0? $sabore['url'] : '#' }}"
                                     alt="" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('js/sabor.js') }}"></script>
@endsection