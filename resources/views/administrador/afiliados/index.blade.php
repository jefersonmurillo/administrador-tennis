@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Usuarios y afiliados</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-afiliados" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Codigo Afiliado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($afiliados as $afiliado)
                        <tr>
                            <td>{{ $afiliado['codigo_afiliado'] }}</td>
                            <td>{{ $afiliado['nombres'] }}</td>
                            <td>{{ $afiliado['apellidos'] }}</td>
                            <td>{{ $afiliado['telefono'] }}</td>
                            <td>
                                <span class="pull-right-container">
                                     @if($afiliado['email_verified_at'] == null)
                                        <small class="label pull-right bg-yellow">No verificado</small>
                                    @else
                                        <small class="label pull-right bg-green">Verificado</small>
                                    @endif
                                </span>
                                {{ $afiliado['email'] }}
                            </td>
                            <td>{{ $afiliado['tipo_usuario']['tipo'] }}</td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning">Opciones</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li><a href="{{ env('APP_URL') }}/afiliados/{{ $afiliado['id'] }}">Ver datos</a>
                                        </li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="eliminarAfiliado('{{$afiliado['id']}}')">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach

                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Codigo Afiliado</th>
                        <th>Nombres</th>
                        <th>Apellidos</th>
                        <th>Telefono</th>
                        <th>Correo</th>
                        <th>Tipo</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/afiliados.js') }}"></script>

    <script>
        $(function () {
            $('#table-afiliados').DataTable();
        });
    </script>
@endsection