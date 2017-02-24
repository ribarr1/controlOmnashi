@extends('layouts.app')

@section('htmlheader_title')
    Listado de Inscritos
@endsection


@section('titulo_pagina')

Usuarios Inscritos
    
@endsection

@section('main-content')

    <div class="row">

        <div class="col-xs-12">
            <div class="box box-primary">
                <div class="box-header">
                    <h3 class="box-title">Listado de Usuarios</h3>
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
                                    <th width="15%">Fecha</th>
                                    <th width="15%">Documento</th>
                                    <th width="40%">Nombre</th>
                                    <th width="20%">Correo</th>
                                    <th width="20%">Telefono</th>
                                    
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
    {!! Form::open(['route' => ['InscritosController.destroy',':ID'], 'method' => 'DELETE', 'id' => 'frmDelete']) !!}

    {!! Form::close() !!}

    
    <!--Formulario para agregar o editar  -->

    <div id="divRenderFormulario">
       
        @include('inscritos.partials.inscritosModal')

    </div>
@endsection