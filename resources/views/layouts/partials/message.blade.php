<div class="alert {{ Session::has('error') ? 'alert-danger' : 'alert-success' }} alert-dismissible {{ Session::has('message') ? '' : ' hidden' }}" role="alert" id="{{ isset($divMensaje) ? $divMensaje : 'divMensaje' }}">

  	<button type="button" class="close" data-dismiss="alert" aria-hidden="true"><span aria-hidden="true">&times;</span></button>
  		
  	<h4><i class="icon fa fa-ban" id="iconoMensaje"></i><span id="tipo"></span></h4>
    
    <span id="mensaje">
    	@if(Session::has('message')) 
    	  {{ Session::get('message')}}
    	@endif
    </span> 
</div>
