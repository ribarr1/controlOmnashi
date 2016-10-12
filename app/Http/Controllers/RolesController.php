<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use Bican\Roles\Models\Role;
//Fin modelos

use App\Http\Requests;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class RolesController extends Controller
{


    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $tituloPagina = 'Listado de Roles de Usuarios';

        return view('roles.indexRoles',compact('tituloPagina'));
    }

    /**
     * Muesta el listado general de roles
     *
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        
        $tabla = new Role();

        if($request->ajax())
        {
            
            $roles = $tabla->all();
     
            return Datatables::of($roles)
            ->setRowId('id')
            ->addColumn('id',function($role){
                return $role->id;
            })
            ->addColumn('name',function($role){
                return $role->name;
            })
            ->addColumn('slug',function($role){
                return $role->slug;
            })
            ->addColumn('description',function($role){
                return $role->description;
            })
            ->addColumn('action', function ($role) {
                
                $ruta = route('roles.edit',$role->id);

                $strHtml = sprintf('<a href="#" class="btn btn-warning btn-sm btn-edit" title="Editar" data-id="%d"><i class="fa fa-pencil"></i></a> ',$role->id);
                $strHtml .= sprintf('<button type="button" class="btn btn-danger btn-sm btn-delete"   title="Eliminar" data-id="%d" onclick="$(this).eliminar()"><i class="fa fa-trash"></i></button>',$role->id);

                return $strHtml;
            })
            ->make(true);
        }

        return view('roles.indexRoles');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        //
        if($request->ajax())
        {

            $view = view('roles.partials.rolesModal');
            
            $sections = $view->renderSections();
               
            return response()->json($sections['renderFormulario']); 
            
        } else {

            return view('roles');

        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[

            'name'         =>  'required',
            'slug'         =>  'required',
            'description'  =>  'required',
            
            ],

            [
            'name.required'        => "El campo nombre es requerido",
            'slug.required'        => "El campo slug es requerido",
            'description.required' => "El campo descripcion es requerido",

            ]

            );

        $role = new Role();

        if($request->ajax())
        {

            $data = $request->all();

            $role->create($data);

            $result = [
                'tipo'          =>'Exito',
                'message'       =>'Registro creado correctamente',
                'iconoMensaje'  =>'icon fa fa-check'
                ];

            return response()->json($result); 
            
        } else {
            return view('roles');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id, Request $request)
    {
        //

        $role = Role::find($id);


        if($request->ajax())
        {

            if(!empty($role))
            {

                $accion = 'Editar';
                
                $view = view('roles.partials.rolesModal',compact('accion','role'));
            
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

            return view('roles');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $role = Role::findOrFail($id);

        try{

            if($request->ajax())
            {

                $data = $request->all();


                if(empty($role))
                {
                    $result = [
                        'tipo'          =>'Error',
                        'message'       =>'No existe el registro indicado',
                        'iconoMensaje'  =>'icon fa fa-bang'
                    ];

                    return response()->json($result);
                
                } else {

                    //Actualizo con el metodo fill
                    $role->fill($data);
                    $role->touch();
                    $role->save(); 

                    $result = [
                        'tipo'          =>'Exito',
                        'message'       =>'Registro actualizado correctamente',
                        'iconoMensaje'  =>'icon fa fa-check'
                    ];

                    return response()->json($result);

                }

            } else {

                return view('roles.index');

            }

        } catch (\Illuminate\Database\QueryException $e) {

            //Genero el mensaje de exito
            Session::flash('message',$e->errorInfo[1].', no fue posible actualizar');
            Session::flash('error', 'alert-danger');

            return redirect()->to('/roles/');
            

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id, Request $request)
    {
        //
        if($request->ajax())
        {
            try {

                //Role::findOrFail($id)->delete();

                return response()->json(['tipo'=>'Exito','message'=>'Registro eliminado correctamente']);

            }catch (\Illuminate\Database\QueryException $e) {

                /*En caso de poder eliminar el registro, capturo la excepcion y envio un mensaje con el
                * Codigo del error, y estatus 500 para que la aplicacion sepa que se trata de un error
                */

                return response()->json(['tipo','message'=>$e->errorInfo[1].', no fue posible eliminar el registro'],500);
            }

        }
    }

}
