@if(isset($accion))
  {!! Form::model($inscrito, ['route' => ['inscritos.update', $inscrito->id],'method'=>'put','id'=>'frm'])!!}
@else
  {!! Form::open(['route'=>'inscrito.store','id'=>'frm'])!!}
@endif
  <div class="form-group">

    
    <label for="exampleInputEmail1">fecha</label>

    {!! Form::hidden('id',null, ['id'=>'id']) !!}

    {!! Form::text('fecha',null, ['class'=>"form-control",'placeholder'=>'fecha','id'=>'fecha']) !!}

    <span class="help-block fecha hidden text-red"></span>
  
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">documento</label>
    {!! Form::text('documento',null, ['class'=>"form-control",'placeholder'=>'documento','id'=>'documento']) !!}
    <span class="help-block documento hidden text-red"></span>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">nombre</label>
    {!! Form::text('nombre',null, ['class'=>"form-control",'placeholder'=>'nombre','id'=>'nombre']) !!}
    <span class="help-block nombre hidden text-red"></span>
  </div>
  
{!! Form::close() !!}