@extends('administrador.index')

@section('contenido')
    <section class="content">
        <form id="form-registro-evento" role="form" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-12">
                    <div class="box box-warning">
                        <div class="box-header with-border">
                            <h3 class="box-title">{{ isset($event) ? $event['nombre']: 'Registro de eventos' }}</h3>
                        </div>
                        <!-- /.box-header -->
                        <div class="box-body" id="box-body">

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>Nombres</label>
                                    <input id="nombre" type="text" name="nombre" class="form-control"
                                           placeholder="Ingrese el nombre del evento..."
                                           value="{{ isset($evento) ? $evento['nombres'] : '' }}" required>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div id="selectTipoEvento">
                                    <div class="form-group">
                                        <label>Tipo de evento</label>
                                        <select id="tipo-evento" class="form-control" name="tipo-evento" required>
                                            <option value="0">Seleccione</option>
                                            @foreach($tiposEvento as $tipoEvento)
                                                <option value="{{ $tipoEvento['id'] }}"> {{ $tipoEvento['tipo'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div id="selectPrioridad">
                                    <div class="form-group">
                                        <label>Prioridad</label>
                                        <select id="prioridad" class="form-control" name="prioridad" required>
                                            <option value="0">Seleccione</option>
                                            @foreach($prioridades as $prioridad)
                                                <option value="{{ $prioridad['id'] }}"> {{ $prioridad['prioridad'] }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Fecha de inicio</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="fecha_inicio" type="date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="recipient-name" class="col-form-label">Fecha de fin</label>
                                    <div class="input-group">
                                        <div class="input-group-addon">
                                            <i class="fa fa-calendar"></i>
                                        </div>
                                        <input id="fecha_fin" type="date" class="form-control" data-inputmask="'alias': 'mm/dd/yyyy'" data-mask="">
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="exampleInputFile">Imagen destacada</label>
                                    <input accept="image/jpg" type="file" id="imagenDesatacada"
                                           name="img-destacada" required>
                                    <input type="hidden" name="imgdestacada" id="imgdestacada">
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <div id="btnNuevasImagenes">
                                        <a class="btn btn-app"
                                           style="padding-top: 1px; padding-bottom: 1px; height: 37px;"
                                           onclick="$('#modalPreview').modal().show();">
                                            <i class="fa fa-play"></i> Vista Previa img destacada
                                        </a>
                                    </div>
                                </div>
                            </div>

                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label>Descripciónes</label>
                                    <textarea class="form-control" rows="3"
                                              placeholder="Ingrese una breve descripción del evento ..."
                                              id="descripcion"></textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div id="btnRegistrar">
                <div class="row">
                    <div class="col-md-12">
                        <div class="box">
                            <div class="box-body">
                                <form role="form">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <input type="submit"
                                                       value="Registrar"
                                                       class="btn btn-block btn-success">
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div id="imgsEvento"></div>

        <div id="btnActualizar"></div>

        {{-- Modal preview imagen principal --}}
        <div class="modal fade" id="modalPreview" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Imagen destacada</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <img id="output" src="" alt="" width="100%" height="100%">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>


        {{-- Modal FileUpload --}}
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">CARGUE LAS IMAGENES DEL EVENTO</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="box">
                                    <div class="box-body">
                                        <p>
                                            Haga click y selecione las imagenes del evento, cada una no mayor
                                            a 2.5MB de
                                            tamaño.
                                        </p>
                                        <form action="../eventos/upload" method="post" class="dropzone"
                                              id="dropzone_example">
                                            {{ csrf_field() }}
                                            <input id="id_evento" type="hidden" name="id_evento">
                                            <div class="fallback">
                                                <input accept=".pdf" name="file" type="file" multiple/>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('js')
    <link rel="stylesheet" href="{{ asset('plugins/dropzone/dropzone.css') }}">
    <script src="{{ asset('plugins/dropzone/dropzone.js') }}"></script>
    <script src="{{ asset('js/evento.js') }}"></script>
@endsection