@if(isset($accion))

  {!! Form::model($paquete, ['route' => ['paquetes.update', $paquete->id],'method'=>'put','id'=>'frm'])!!}
@else
  {!! Form::open(['route'=>'paquetes.store','id'=>'frm'])!!}
@endif
  <div class="form-group">

    
    <label for="nombre">Nombre</label>

    {!! Form::hidden('id',null, ['id'=>'id']) !!}

    {!! Form::text('nombre',null, ['class'=>"form-control",'placeholder'=>'Nombre','id'=>'nombre']) !!}

    <span class="help-block name hidden text-red"></span>
  
  </div>
  
  <div class="form-group">
    <label for="precio">Precio</label>
    {!! Form::text('precio',null, ['class'=>"form-control",'placeholder'=>'precio','id'=>'precio']) !!}
    <span class="help-block slug hidden text-red"></span>
  </div>
  
  
  
{!! Form::close() !!}