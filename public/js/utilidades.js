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

//Funcion para agregar o modificar mediante ajax
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
            $('div').removeClass('text-red');
        },

    }).done(function(respuesta) {

        //Recargo los datos en datatable para que muestre los cambios recientes
        $('#tabla').DataTable().ajax.reload();
        
        //Desvanecemos la ventana modal
        $('#myModal').modal('hide');

        $('#mensaje').html(' ');

        $('#divMensaje').removeClass('hidden').addClass('alert-success').fadeIn();

        $('#tipo').html('Exito');

        $('#iconoMensaje').removeClass().addClass('icon fa fa-check');

        $("#mensaje").html(respuesta.message);


    }).fail(function(respuesta){

        $('#mensaje').html(' ');

        $('#divMensaje').removeClass('hidden alert-success').addClass('alert-danger').fadeIn();

        $('#tipo').html('Error');

        $('#iconoMensaje').removeClass().addClass('icon fa fa-ban');

        $("#mensaje").html('No se pudo procesar el formulario, por favor revise los errores indicados');

        $.each(respuesta.responseJSON,function (ind, elem) { 
        
            $('div.'+ind).removeClass('hidden').addClass('text-red');
            
            $('span.'+ind).removeClass('hidden');

            $('span.'+ind).html(' ');
            $('span.'+ind).html('<strong>'+elem+'</strong>');

        });
            
    
    });

}