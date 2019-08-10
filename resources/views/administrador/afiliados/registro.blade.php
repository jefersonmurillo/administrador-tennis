@extends('administrador.index')

@section('css')
    <!-- DataTables -->
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div id="alerta"></div>

        <form id="form-registro-afiliados" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ isset($afiliado) ? $afiliado['nombres'].' '.$afiliado['apellidos']: 'Registro de afiliados' }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="nombres" type="text" name="nombres" class="form-control"
                                           placeholder="Ingrese los nombres..."
                                           value="{{ isset($afiliado) ? $afiliado['nombres'] : '' }}" required>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Apellidos</label>
                                    <input id="apellidos" type="text" name="apellidos" class="form-control"
                                           placeholder="Ingrese los apellidos ..."
                                           value="{{ isset($afiliado) ? $afiliado['apellidos'] : ''}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de documento</label>
                                    <select id="tipo-documento" class="form-control" name="tipo-documento" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($tiposDocumento as $tipo)
                                            @if(isset($afiliado) and $tipo['id'] == $afiliado['tipo_documento_id'])
                                                <option value="{{ $tipo['id'] }}" selected>{{ $tipo['tipo'] }}</option>
                                            @else
                                                <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Documento</label>
                                    <input id="documento" name="documento" type="number" class="form-control"
                                           placeholder="Ingrese el documento de identidad ..."
                                           value="{{ isset($afiliado) ? $afiliado['documento'] : ''}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Correo electronico</label>
                                    <input id="email" name="email" type="email" class="form-control"
                                           placeholder="Ingrese el correo electronico ..."
                                           value="{{ isset($afiliado) ? $afiliado['email'] : ''}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Fecha de nacimiento</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="fecha-nacimiento" name="fecha-nacimiento" type="text"
                                               class="form-control" data-inputmask="'alias': 'dd/mm/yyyy'" data-mask
                                               value="{{ isset($afiliado) ? $afiliado['fecha_naci'] : ''}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Genero</label>
                                    <select id="genero" name="genero" class="form-control" required>
                                        <option value="0">Selecciones</option>

                                        @if(isset($afiliado))
                                            @if($afiliado['genero'] == 'MASCULINO')
                                                <option value="MASCULINO" selected>MASCULINO</option>
                                                <option value="FEMENINO">FEMENINO</option>
                                            @else
                                                <option value="MASCULINO">MASCULINO</option>
                                                <option value="FEMENINO" selected>FEMENINO</option>
                                            @endif
                                        @else
                                            <option value="MASCULINO">MASCULINO</option>
                                            <option value="FEMENINO">FEMENINO</option>
                                        @endif
                                    </select>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Teléfono</label>
                                    <input id="telefono" name="telefono" type="number" class="form-control"
                                           placeholder="Ingrese numero de telefono ..."
                                           value="{{ isset($afiliado) ? $afiliado['telefono'] : ''}}" required>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div class="form-group">
                                        <label>Dirección</label>
                                        <input id="direccion" name="direccion" type="text" class="form-control"
                                               placeholder="Ingrese la dirección ..."
                                               value="{{ isset($afiliado) ? $afiliado['direccion'] : ''}}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Tipo de usuario</label>
                                    <select id="tipo-usuario" name="tipo-documento" class="form-control" required>
                                        <option value="0">Seleccione</option>
                                        @foreach($tiposUsuario as $tipo)
                                            @if(isset($afiliado) and $tipo['id'] == $afiliado['tipo_usuario_id'])
                                                <option value="{{ $tipo['id'] }}" selected>{{ $tipo['tipo'] }}</option>
                                            @else
                                                <option value="{{ $tipo['id'] }}">{{ $tipo['tipo'] }}</option>
                                            @endif
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div id="campos-golfista"></div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-12">
                    <div class="box">
                        <div class="box-body">
                            <form role="form">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <input type="submit"
                                                   value="{{ isset($afiliado) ? 'Actualizar' : 'Registrar'}}"
                                                   class="btn btn-block btn-success">
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </form>

    </section>
@endsection

@section('js')
    {{--<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>--}}
    <!-- date-range-picker -->
    <script src="{{ asset('template/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>
    <!-- InputMask -->
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.js') }}"></script>
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.date.extensions.js') }}"></script>
    <script src="{{ asset('template/plugins/input-mask/jquery.inputmask.extensions.js') }}"></script>

    <!-- date-range-picker -->
    <script src="{{ asset('template/bower_components/moment/min/moment.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/bootstrap-daterangepicker/daterangepicker.js') }}"></script>

    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/afiliados.js') }}"></script>

    <script>
        $(function () {
            $('#example1').DataTable();

            //Datemask dd/mm/yyyy
            $('#datemask').inputmask('dd/mm/yyyy', {
                'placeholder': 'dd/mm/yyyy'
            })
        })
    </script>
@endsection