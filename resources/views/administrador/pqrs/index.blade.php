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
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star text-yellow"></i></a></td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem...</td>
                            <td></td>
                            <td class="mailbox-date">5 mins ago</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a>
                            </td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem... </td>
                            <td></td>
                            <td class="mailbox-date">28 mins ago</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox"></td>
                            <td class="mailbox-star"><a href="#"><i class="fa fa-star-o text-yellow"></i></a>
                            </td>
                            <td class="mailbox-name"><a href="read-mail.html">Alexander Pierce</a></td>
                            <td><b>AdminLTE 2.0 Issue</b> - Trying to find a solution to this problem... </td>
                            <td></td>
                            <td class="mailbox-date">11 hours ago</td>
                        </tr>
                        </tbody>
                    </table>
                    <!-- /.table -->
                    <!-- /.mail-box-messages -->
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