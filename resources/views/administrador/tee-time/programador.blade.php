@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div class="row">
            <div class="col-sm-5">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">{{ $escenario['nombre'] }}</h3>
                        <input type="hidden" name="id-escenario" id="id-escenario" value="{{$escenario['id']}}">
                    </div>
                    <div class="box-body" id="body-table-fechas">
                        <table id="table-fechas" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-sm-7">
                <div class="box">
                    <div class="box-header">
                        <h3 class="box-title">Reservaciones</h3>
                    </div>
                    <div class="box-body" id="body-table-reservaciones">
                        <table id="table-reservaciones" class="table table-bordered table-striped">
                            <thead>
                            <tr>
                                <th>Fecha</th>
                                <th>Hora</th>
                                <th>Estado</th>
                                <th>Jugadores</th>
                                <th>Acciones</th>
                            </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
         aria-hidden="true">
        <div class="modal-dialog" role="document">
            <form id="form-actualizar" role="form" enctype="multipart/form-data">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Nueva programación</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Fecha</label>
                            <div class="input-group">
                                <div class="input-group-addon">
                                    <i class="fa fa-calendar"></i>
                                </div>
                                <input id="fecha_programacion" type="date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="recipient-name" class="col-form-label">Hora</label>
                            <div class="input-group">
                                <input id="hora_programacion" type="text" class="form-control timepicker">
                                <div class="input-group-addon">
                                    <i class="fa fa-clock-o"></i>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <input type="button" class="btn btn-primary" onclick="registrarProgramacion()" value="Registrar">
                    </div>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('js')
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/programador.js') }}"></script>
    <script>
        $(function () {
            $('.timepicker').timepicker({
                showInputs: false
            })
        })
    </script>
@endsection