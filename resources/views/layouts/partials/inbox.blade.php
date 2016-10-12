
<div class="row">

    <div class="col-md-9">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Inbox</h3>

                <div class="box-tools pull-right">
                    <div class="box-tools pull-right">
                        <div class="has-feedback">
                            <input type="text" class="form-control input-sm" placeholder="{{ trans('adminlte_lang::message.search') }}">
                            <span class="glyphicon glyphicon-search form-control-feedback"></span>
                        </div>
                    </div>
                </div>

            </div>
            <!-- /.box-header -->
            <div class="box-body">

                <div class="mailbox-controls">
                    <!-- Check all button -->

                    <!-- /.btn-group -->
                    <button type="button" class="btn btn-success btn-flat btn-sm">{{ trans('adminlte_lang::message.refresh') }} <i class="fa fa-refresh"></i></button>
                    <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>

                <div class="table-responsive">
                    <table class="table table-hover no-margin">
                        <thead>
                        <tr>
                            <th>ID</th>
                            <th>Descripcion</th>
                            <th>Prioridad</th>
                            <th>Estatus</th>
                            <th>Opciones</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td><a href="pages/examples/invoice.html" data-toggle="modal" data-target="#myModal">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="label label-primary">Baja</span></td>
                            <td>
                                <i class="fa fa-list-ul"> </i> Despliegue
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm btn-flat" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="label label-warning">Media</span></td>
                            <td>

                                <i class="fa fa-eye"> </i> Revisi&oacute;n

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">Historial <i class="fa fa-clock-o"></i></button>
                                    <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="label label-danger">Alta</span></td>
                            <td>

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm btn-flat" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><a href="pages/examples/invoice.html">OR1848</a></td>
                            <td>Samsung Smart TV</td>
                            <td><span class="label label-warning">Media</span></td>
                            <td>

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm btn-flat" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR7429</a></td>
                            <td>iPhone 6 Plus</td>
                            <td><span class="label label-danger">Alta</span></td>
                            <td>

                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm btn-flat" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><a href="pages/examples/invoice.html">OR9842</a></td>
                            <td>Call of Duty IV</td>
                            <td><span class="label label-primary">Baja</span></td>
                            <td>
                                <span class="text-danger"> <i class="fa fa-stop-circle"></i> Stop</span>
                            </td>
                            <td>
                                <div class="btn-group">
                                    <button type="button" class="btn btn-default btn-sm btn-flat" data-toggle="modal" data-target="#myModal">Editar <i class="fa fa-edit"></i></button>
                                </div>
                            </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <!-- /.table-responsive -->
            </div>
            <!-- /.box-body -->
            <div class="box-footer clearfix">
                <div class="mailbox-controls">

                    <!-- /.btn-group -->

                    <div class="pull-right">
                        1-50/200
                        <div class="btn-group">
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-left"></i></button>
                            <button type="button" class="btn btn-default btn-sm"><i class="fa fa-chevron-right"></i></button>
                        </div>
                        <!-- /.btn-group -->
                    </div>
                    <!-- /.pull-right -->
                </div>
            </div>
            <!-- /.box-footer -->
        </div>
        <!-- /. box -->
    </div>
    <!-- /.col -->

    <div class="col-md-3">
        <div class="box box-primary">
            <div class="box-header with-border">
                <h3 class="box-title">Folders</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li class="active"><a href="#"><i class="fa fa-inbox"></i> Inbox
                            <span class="label label-primary pull-right">12</span></a>
                    </li>
                    <li><a href="#"><i class="fa fa-eye"></i> Revisi&oacute;n</a></li>
                    <li><a href="#"><i class="fa fa-list-ol"></i> Despliegue</a></li>
                    <li><a href="#"><i class="fa fa-gears"></i> Ejecuci&oacute;n Pruebas</a></li>
                    <li><a href="#"><i class="fa fa-stop-circle"></i> Stop <span class="label label-danger pull-right">65</span></a>
                    </li>

                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /. box -->
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title">Labels</h3>

                <div class="box-tools">
                    <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                    </button>
                </div>
            </div>
            <div class="box-body no-padding">
                <ul class="nav nav-pills nav-stacked">
                    <li><a href="#"><i class="fa fa-circle-o text-red"></i> Alta</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-yellow"></i> Media</a></li>
                    <li><a href="#"><i class="fa fa-circle-o text-light-blue"></i> Baja</a></li>
                </ul>
            </div>
            <!-- /.box-body -->
        </div>
        <!-- /.box -->
    </div>
    <!-- /.col -->
</div>
<!-- /.row -->
