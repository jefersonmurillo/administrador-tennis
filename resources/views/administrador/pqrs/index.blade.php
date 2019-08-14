@extends('administrador.index')

@section('css')
    <link rel="stylesheet" href="{{ asset('template/plugins/iCheck/flat/blue.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="box">
                    <div class="box-body">
                        <h3 style="display: inline;">Listado de PQRS</h3>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-12">
                <div class="box-body no-padding">
                    <table class="table table-hover table-striped" id="tabla">
                        <thead>
                        <tr>
                            <th></th>
                            <th></th>
                            <th>Afiliado</th>
                            <th>Asunto</th>
                            <th>Mensaje</th>
                            <th>Fecha</th>
                        </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                    <!-- /.table -->
                    <!-- /.mail-box-messages -->
                </div>
            </div>
        </div>

        <div class="modal fade" id="modalMensaje" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document" style="width: 55%">
                <div class="modal-content">
                    <div class="modal-header">
                        <div><h5 class="modal-title" id="exampleModalLabel"></h5></div>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Nombres:</label>
                                    <input type="text" class="form-control" id="nombres" disabled="">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Codigo Afiliado:</label>
                                    <input type="text" class="form-control" id="codigo" disabled="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Asunto:</label>
                                    <input type="text" class="form-control" id="asunto" disabled="">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Mensaje:</label>
                                    <textarea class="form-control" rows="3" placeholder="Enter ..." disabled="" id="mensaje"></textarea>
                                </div>
                            </div>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('template/plugins/iCheck/icheck.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>
    <script src="{{ asset('js/pqrs.js') }}"></script>
@endsection