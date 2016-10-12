@if(isset($accion))
  {!! Form::model($role, ['route' => ['roles.update', $role->id],'method'=>'put','id'=>'frm'])!!}
@else
  {!! Form::open(['route'=>'roles.store','id'=>'frm'])!!}
@endif
  <div class="form-group">

    
    <label for="exampleInputEmail1">Nombre</label>

    {!! Form::hidden('id',null, ['id'=>'id']) !!}

    {!! Form::text('name',null, ['class'=>"form-control",'placeholder'=>'Nombre','id'=>'name']) !!}

    <span class="help-block name hidden"></span>
  
  </div>
  
  <div class="form-group">
    <label for="exampleInputPassword1">Slug</label>
    {!! Form::text('slug',null, ['class'=>"form-control",'placeholder'=>'Slug','id'=>'slug']) !!}
    <span class="help-block slug hidden"></span>
  </div>
  
  <div class="form-group">
    <label for="exampleInputFile">Descripci&oacute;n</label>
    {!! Form::text('description',null, ['class'=>"form-control",'placeholder'=>'Descripcion','id'=>'description']) !!}
    <span class="help-block description hidden"></span>
  </div>
  
{!! Form::close() !!}