<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class InscritosController extends Controller
{
    public function index(){
    	 return view('prueba/prueba');

    }
    public function hola(){ 

    	 return ['TE DIJE HOLA'];
    }

    public function prueba1(){
    	 return view('prueba/prueba1');

    }

    public function postCreate()
    {
        
            $inscritos = new Inscrito;
            $inscritos->fecha = Input::get('fecha');
            $inscritos->documento = Input::get('documento');
            $inscritos->nombre = Input::get('nombre');
            $inscritos->correo = Input::get('correo');
            $inscritos->telefono = Input::get('telefono');
            $inscritos->save();
            
    }

    public function destroy($id, Request $request)
    {
        //
        if($request->ajax())
        {
            try {

                Role::findOrFail($id)->delete();

                $result = [
                        'tipo'          => 'Exito',
                        'message'       => 'Registro eliminado correctamente',
                        'iconoMensaje'  => 'icon fa fa-ban',
                        'tabla'         =>  true,
                        'divDestino'    => 'divMensaje'                
                        ];

                return response()->json($result);

            }catch (\Illuminate\Database\QueryException $e) {

                /*En caso de poder eliminar el registro, capturo la excepcion y envio un mensaje con el
                * Codigo del error, y estatus 500 para que la aplicacion sepa que se trata de un error
                */

                $result = [
                        'tipo'          => 'Error',
                        'message'       => $e->errorInfo[1].', no fue posible eliminar el registro',
                        'iconoMensaje'  => 'icon fa fa-ban',
                        'tabla'         => false,
                        'divDestino'    => 'divMensaje'                
                        ];

                return response()->json($result,500);
            }

        }
    }
}
