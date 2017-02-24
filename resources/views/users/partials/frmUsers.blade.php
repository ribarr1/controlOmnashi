@if(isset($accion))
  {!! Form::model($role, ['route' => ['users.update', $role->id],'method'=>'put','id'=>'frm'])!!}
@else
  {!! Form::open(['route'=>'users.store','id'=>'frm'])!!}
@endif
  <div class="form-group">

    
    <label for="nombres">Nombres</label>

    {!! Form::hidden('id',null, ['id'=>'id']) !!}

    {!! Form::text('name',null, ['class'=>"form-control",'placeholder'=>'Nombre','id'=>'name']) !!}

    <span class="help-block name hidden text-red"></span>
  
  </div>
  
  <div class="form-group">
    <label for="email">Email</label>
    {!! Form::text('email',null, ['class'=>"form-control",'placeholder'=>'Email','id'=>'email']) !!}
    <span class="help-block slug hidden text-red"></span>
  </div>
  
  <div class="form-group">
    <label for="rol">Rol</label>
      @if(isset($roles))
        @if(isset($rolUsuario))
          {!! Form::select('rol_id',$roles,null,['id'=>'rol_id','selected'=>$rol_id,'class'=>'form-control']) !!}
        @else
          {!! Form::select('rol_id',$roles,null,['id'=>'rol_id','class'=>'form-control']) !!}
        @endif
      @endif

    <span class="help-block description hidden text-red"></span>
  </div>
  
{!! Form::close() !!}