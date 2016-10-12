@extends('layouts.app')

@section('htmlheader_title')
    Listado de Roles de Usuarios
@endsection

@section('scriptsjQuery')

    <script type="text/javascript">

        $(document).ready(function () {

            $('#tabla').DataTable({
                responsive: true,
                stateSave:  true,
                "language": { "url": "/i18n/dataTable.spanish.lang"},
                "processing": true,
                "serverSide": true,
                "ajax": "/roles/listado",
                "columns": [
                    {data: 'id'},
                    {data: 'name'},
                    {data: 'slug'},
                    {data: 'description'},
                    {data: 'action'}

                ],
            });

            //Funcion para llamar al formulario EDITAR
            $('#tabla').on('click','a.btn-edit',function(){
                
                var ruta  = "{{ route("roles.index") }}/"+ $(this).data('id')+"/edit";
                

                //lamado ajax metodo get para tomar el formulario
                $.get(ruta,'',function(data) {

                    $('#divRenderFormulario').empty().append($(data));
                    
                    //Muestro la ventana modal
                    $('#myModal').modal('toggle');

                });
            
            });

            //Funcion para llamar al formulario NUEVO
            $('#btn-nuevo').click(function(){
                
                var ruta  = "{{ route("roles.create") }}";
                
                //lamado ajax metodo get para tomar el formulario
                $.get(ruta,'',function(data) {

                    $('#divRenderFormulario').empty().append($(data));
                    
                    //Muestro la ventana modal
                    $('#myModal').modal('toggle');

                });
            
            });

            //Funcion para guardar el registro
            //Funcion para crear o modificar color
            $('#divRenderFormulario').on('click','a.btn-guardar',function(){
                
                var token = $("input[name=_token]").val(); 
                
                $.grabarRegistro('frm', token)
                
            });

        });

    </script>
@endsection

@section('main-content')

    <div class="row">

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Listado de Roles</h3>
                    <div class="box-tools pull-right">
                        <button type="button" class="btn btn-sm btn-primary btn-flat" id="btn-nuevo">Nuevo</button>
                    </div>
                </div>
                <!-- /.box-header -->
                <div class="box-body">

                    <div class="dataTables_wrapper form-inline dt-bootstrap">


                        <div class="row">

                            <div class="col-sm-12">
                                <table class="table table-bordered table-hover dataTable" role="grid" id="tabla">
                                <thead>
                                <tr>
                                    <th width="10%">ID</th>
                                    <th width="15%">Nombre</th>
                                    <th width="15%">Slug</th>
                                    <th width="40%">Descripci&oacute;n</th>
                                    <th width="20%">Opciones</th>
                                </tr>
                                </thead>
                                <tbody>

                                </tbody>
                                </table>

                            </div>
                            <!-- /div col-sm-12 -->
                        </div>
                        <!-- /div row -->
                    </div>
                    <!-- /.dataTable_wrapper -->


                </div>
                <!-- /. box-body -->
            </div>
            <!-- /.box-primary-->


        </div>
        <!-- /.row -->

    </div>

    <!-- formulario para eliminar item -->
    {!! Form::open(['route' => ['roles.destroy',':ID'], 'method' => 'DELETE', 'id' => 'frmDelete']) !!}

    {!! Form::close() !!}

    
    <!--Formulario para agregar o editar  -->

    <div id="divRenderFormulario">
       
        @include('roles.partials.rolesModal')

    </div>
@endsection