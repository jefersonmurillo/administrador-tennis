@extends('administrador.index')

@section('css')
    <link rel="stylesheet"
          href="{{ asset('template/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css') }}">
@endsection

@section('contenido')
    <section class="content">
        <div id="alerta"></div>
        <div class="box">
            <div class="box-header">
                <h3 class="box-title">Disciplinas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <table id="table-disciplinas" class="table table-bordered table-striped">
                    <thead>
                    <tr>
                        <th>Disciplina</th>
                        <th>Acciones</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($disciplinas as $disciplina)
                        <tr>
                            <th>{{$disciplina['nombre']}}</th>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-warning">Opciones</button>
                                    <button type="button" class="btn btn-warning dropdown-toggle"
                                            data-toggle="dropdown">
                                        <span class="caret"></span>
                                        <span class="sr-only">Toggle Dropdown</span>
                                    </button>
                                    <ul class="dropdown-menu" role="menu">
                                        <li onclick="abrirModal('{{$disciplina['id']}}', '{{$disciplina['nombre']}}')">
                                            <a href="#">Ver
                                                datos</a></li>
                                        <li class="divider"></li>
                                        <li><a href="#" onclick="eliminarDisciplina('{{$disciplina['id']}}')">Eliminar</a>
                                        </li>
                                    </ul>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                    <tfoot>
                    <tr>
                        <th>Disciplina</th>
                        <th>Acciones</th>
                    </tr>
                    </tfoot>
                </table>
            </div>
            <!-- /.box-body -->
        </div>
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id="form-actualizar" role="form" enctype="multipart/form-data">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Actualizar Disciplina</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="recipient-name" class="col-form-label">Disciplina:</label>
                                <input type="text" class="form-control" id="nombre_disciplina">
                                <input type="hidden" class="form-control" id="id_disciplina">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-primary" value="Actualizar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <script src="{{ asset('template/bower_components/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('template/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js') }}"></script>

    <script src="{{ asset('js/disciplinas.js') }}"></script>

    <script>
        $(function () {
            $('#table-disciplinas').DataTable();
        });
    </script>
@endsection