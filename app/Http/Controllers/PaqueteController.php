<?php

namespace App\Http\Controllers;
	
use Illuminate\Http\Request;

use App\Paquete;


use App\Http\Requests;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Database\Eloquent\ModelNotFoundException;

class PaqueteController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        //Hago la consulta general
        
       //return view('paquetes.indexPaquetes');
       $tituloPagina = 'Listado de Paquetes';

        return view('paquetes.indexPaquetes',compact('tituloPagina'));
        
    }

     /**
     * Muesta el listado general de mascotas
     *
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        $tabla = new Paquete();
        if($request->ajax())
        {   
            
             $paquetes = $tabla->all();  

            //$paquetes = $tabla->listadoGeneral();
          
            return Datatables::of($paquetes)
            ->setRowId('id')
            ->addColumn('id',function($paquete){
                return $paquete->id;
            })
            ->addColumn('nombre',function($paquete){
                return $paquete->nombre;
            })
            
            ->addColumn('precio',function($paquete){
                return $paquete->precio;
            })
            ->addColumn('action', function ($paquete) {            
                $ruta = route('paquetes.edit',$paquete->id);

               $strHtml = sprintf('<a href="#" class="btn btn-warning btn-sm btn-edit" title="Editar" data-id="%d"><i class="fa fa-pencil"></i></a> ',$paquete->id);
                $strHtml .= sprintf('<button type="button" class="btn btn-danger btn-sm btn-delete"   title="Eliminar" data-id="%d" onclick="$(this).eliminar()"><i class="fa fa-trash"></i></button>',$paquete->id);

                return $strHtml;
            })
            ->make(true);
        }

        return view('paquetes.indexPaquetes');

    }

    public function create(Request $request)
    {
        if($request->ajax())
        {

            $view = view('paquetes.partials.paquetesModal');
            
            $sections = $view->renderSections();
               
            return response()->json($sections['renderFormulario']); 
            
        } else {

            return view('indexPaquetes');

        }
    }

	public function store(Request $request)
	{

        $this->validate($request,[

            'nombre'         =>  'required',
            'precio'         =>  'required',
                        
            ],

            [
            'nombre.required'        => "El campo nombre es requerido",
            'precio.required'        => "El campo precio es requerido",
            
            ]

            );

        $paquete = new Paquete();

        if($request->ajax())
        {

            $data = $request->all();

            $paquete->create($data);

            $result = [
                'tipo'          =>'Exito',
                'message'       =>'Registro creado correctamente',
                'iconoMensaje'  =>'icon fa fa-check',
                'tabla'         =>'true',
                'divDestino'    => 'divMensajeModal'                
                ];

            return response()->json($result); 
            
        } else {
            return view('indexPaquetes');

        }

    

	}
    public function show($id)
    {
       
    }
	
	public function edit(Request $request, $id)
	{
   		$paquete = Paquete::find($id);

        if($request->ajax())
        {

            if(!empty($paquete))
            {

                $accion = 'Editar';
                
                $view = view('paquetes.partials.paquetesModal',compact('accion','Paquete'));
            
                $sections = $view->renderSections();
               
                return response()->json($sections['renderFormulario']); 

            } else {

                $result = [
                'tipo'          =>'Error',
                'message'       =>'No existe el registro indicado',
                'iconoMensaje'  =>'icon fa fa-bang'
                ];

                return response()->json($result);

            }

            
        } else {

            return view('paquetes/indexPaquetes');

        }
	}


	public function update(Request $request, $id)
    {
        //
        $paquete = Paquete::findOrFail($id);

        try{

            if($request->ajax())
            {

                $data = $request->all();


                if(empty($paquete))
                {
                    $result = [
                        'tipo'          => 'Error',
                        'message'       => 'No existe el registro indicado',
                        'iconoMensaje'  => 'icon fa fa-ban',
                        'tabla'         =>  false,
                        'divDestino'    => 'divMensaje'
                    ];

                    return response()->json($result);
                
                } else {

                    //Actualizo con el metodo fill
                    $paquete->fill($data);
                    $paquete->touch();
                    $paquete->save(); 

                    $result = [
                        'tipo'          => 'Exito',
                        'message'       => 'Registro actualizado correctamente',
                        'iconoMensaje'  => 'icon fa fa-check',
                        'tabla'         =>  true,
                        'divDestino'    => 'divMensaje'                
                        ];

                    return response()->json($result);

                }

            } else {

                return view('paquetes/indexPaquetes');

            }

        } catch (\Illuminate\Database\QueryException $e) {

            //Genero el mensaje de exito
            Session::flash('message',$e->errorInfo[1].', no fue posible actualizar');
            Session::flash('error', 'alert-danger');

            return redirect()->to('/paquete/');
            

        }
    }

public function destroy($id, Request $request)
    {
        //
        if($request->ajax())
        {
            try {

                Paquete::findOrFail($id)->delete();

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

	/*public function index(){
    	$paquetes = Paquete::all(); 
    	return \View::make('paquetes/indexPaquetes',compact('paquetes'));
	}/*

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    

    
    

		
}
