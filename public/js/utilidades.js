/**
 * Created by jcrojas on 09/10/16.
 */

/**
 * Funcion generica que permite eliminar un registro desde un datatable
 *
 */
//Funcion para eliminar
jQuery.fn.eliminar = function() {
    var form = $('#frmDelete');
    var row  = $(this).parents('tr');
    var id   = $(this).data('id');
    var ruta = form.attr('action').replace(':ID',id);
    var data = form.serialize();

    if(confirm("Estas seguro de eliminar este registro?"))
    {
        $.ajax({
            url: ruta,
            type: 'post',
            dataType: 'json',
            data: data,

        }).done(function(respuesta){

            $('#mensaje').html(' ');

            $('#divMensaje').removeClass('hidden').addClass('alert-success').fadeIn();

            $('#tipo').html('Exito');

            $('#iconoMensaje').removeClass().addClass('icon fa fa-check');

            $("#mensaje").html(respuesta.message);

            //Desvanezco el row
            row.fadeOut();


        }).fail(function(respuesta){

            var json = JSON.parse(respuesta.responseText);

            $('#mensaje').html(' ');

            $('#divMensaje').removeClass('hidden').addClass('alert-danger').fadeIn();

            $('#iconoMensaje').removeClass().addClass('icon fa fa-ban');

            $('#tipo').html(json.tipo);

            $("#mensaje").html(json.message);

        });
    }
};

/**
 * Funcion para agregar o modificar mediante ajax
 *
 */

$.grabarRegistro = function(formulario,token){

    var form = $('#'+formulario);
    var ruta = form.attr('action');
    var data = form.serialize();

    $.ajax({
        url: ruta,
        headers: {'X-CSRF-TOKEN': token},
        type: 'post',
        dataType: 'json',
        data: data,
        beforeSend:  function(){
            $('span.help-block').addClass('hidden');
        },

    }).done(function(res) {

        imprimirMensaje(res.tipo,res.message,res.tabla,res.divDestino);


    }).fail(function(res){

        

        $.each(res.responseJSON,function (ind, elem) { 
        
            $('div.'+ind).removeClass('hidden');
            
            $('span.'+ind).removeClass('hidden');

            $('span.'+ind).html(' ');
            $('span.'+ind).html('<strong>'+elem+'</strong>');

        });

        imprimirMensaje('Error',res.message,false,'divMensajeModal');
            
    
    });

}

//Funcion imprimir mensajes
var imprimirMensaje = function(tipo,mensaje,tabla=true,divDestino='divMensajeModal'){

    var icono      = '';
    var alerta     = '';
    var divMensaje = '';
    var divTipo    = '';
    var divIcono   = '';

   //Recargo los datos en datatable para que muestre los cambios recientes
    if(tabla)
        $('#tabla').DataTable().ajax.reload();
        
    
    if(divDestino!='divMensajeModal'){
        //Desvanecemos la ventana modal
        $('#myModal').modal('hide');
        divMensaje = 'mensaje';
        divTipo    = 'tipo';
        divIcono   = 'iconoMensaje';
    } else {

        divMensaje = 'mensajeModal';
        divTipo    = 'tipoModal';
        divIcono   = 'iconoMensajeModal';
    }
        

    if(tipo=='Exito'){
        
        icono  = 'icon fa fa-check';
        alerta = 'alert-success';
    
    }else{
    
        icono = 'icon fa fa-ban';
        alerta = 'alert-danger';
        mensaje = 'Error al procesar el formulario';
    }

  
    $('#'+divMensaje).html(' ');

    $('#'+divDestino).removeClass('hidden').addClass(alerta).fadeIn();

    $('#'+tipoModal).html(tipo);

    $('#'+divIcono).removeClass().addClass(icono);

    $("#"+divMensaje).html(mensaje);
}