@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">

        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Tee-Time Escenenarios</h3>
                        <button type="button" class="btn bg-olive btn-flat margin" style="float: right;margin-top: 0px; margin-bottom: 0px;" onclick="cargarModalEscenario()">
                            Registrar Escenario
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div id="escenarios"></div>
        </div>

        <div id="modal">
            <div class="modal fade" id="modalRegistro" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                 aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <form id="form-registrar-escenario" role="form" enctype="multipart/form-data">
                        <div class="modal-content">
                            <div class="modal-header">
                                <div><h5 class="modal-title" id="tetleFormEscenario">Registrar Escenario</h5></div>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombre:</label>
                                    <input type="text" class="form-control" id="nombre">
                                    <input type="hidden" class="form-control" id="id">
                                </div>

                                <div class="form-group" id="disciplinas"></div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <input type="submit" class="btn btn-primary" value="Registrar" id="BotonFormRegistro">
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalDias" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 75%">
                <div class="modal-content">
                    <div class="modal-header">
                        <div><h5 class="modal-title" id="exampleModalLabel">Programador Escenario</h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group" id="modal-dias-table">

                        </div>

                        <div class="form-group" id="disciplinas"></div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="submit" class="btn btn-primary" value="Registrar">
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/tee-time.js') }}"></script>
@endsection