<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

//Modelos
use Bican\Roles\Models\Role;
use App\User;
use App\RolUser;
//Fin modelos

use App\Http\Requests;

use Yajra\Datatables\Facades\Datatables;

use Illuminate\Database\Eloquent\ModelNotFoundException;


class UsersController extends Controller
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

        return view('users.indexUsers');
    }

    /**
     * Muesta el listado general de usuarios
     *
     * @return \Illuminate\Http\Response
     */
    public function listado(Request $request)
    {
        
        $tabla = new User();

        if($request->ajax())
        {
            
            $users = $tabla->all();
     
            return Datatables::of($users)
            ->setRowId('id')
            ->addColumn('id',function($user){
                return $user->id;
            })
            ->addColumn('email',function($user){
                return $user->email;
            })
            ->addColumn('nombre',function($user){
                return $user->name;
            })
            ->addColumn('action', function ($user) {
                
                $ruta = route('users.edit',$user->id);

                $strHtml = sprintf('<a href="#" class="btn btn-warning btn-sm btn-edit" title="Editar" data-id="%d"><i class="fa fa-pencil"></i></a> ',$user->id);
                $strHtml .= sprintf('<button type="button" class="btn btn-danger btn-sm btn-delete"   title="Eliminar" data-id="%d" onclick="$(this).eliminar()"><i class="fa fa-trash"></i></button>',$user->id);

                return $strHtml;
            })
            ->make(true);
        }

        return view('users.indexUsers');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        
        //
        $roles = Role::orderBy('name','asc')->pluck('name','id');

        if($request->ajax())
        {

            $view = view('users.partials.usersModal', compact('roles'));
            
            $sections = $view->renderSections();
               
            return response()->json($sections['renderFormulario']); 
            
        } else {

            return view('users');

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
            'email'         =>  'required',
           
            ],

            [
            'name.required'   => "El campo nombre es requerido",
            ]

            );

        $users = new User();
        //Qeude programando en este metodo
        if($request->ajax())
        {

            $data = $request->all();

            $data['password'] = $this->crearPassword();

            $users->create($data);

            $result = [
                'tipo'          =>'Exito',
                'message'       =>'Registro creado correctamente'.$data['password'],
                'iconoMensaje'  =>'icon fa fa-check',
                'tabla'         =>'true',
                'divDestino'    => 'divMensajeModal'                
                ];

            return response()->json($result); 
            
        } else {
            return view('users');

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

        $role = User::find($id);

        $objRolUser = new RolUser();
        $rolUsuario = $objRolUser->buscarRolUser($id);

        if($request->ajax())
        {

            if(!empty($role))
            {

                $accion = 'Editar';
                
                $view = view('users.partials.usersModal',compact('accion','role','rolUsuario'));
            
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

            return view('users');

        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $idusers * @return \Illuminate\Http\Response
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
                        'tipo'            => 'Error',
                        'message'         => 'No existe el registro indicado',
                        'iconoMensaje'    => 'icon fa fa-ban',
                        'tabla'           =>  false,
                        'divDestino'      => 'divMensaje'
                    ];

                    return response()->json($result);
                
                } else {

                    //Actualizo con el metodo fill
                    $role->fill($data);
                    $role->touch();
                    $role->save(); 

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

                return view('users.index');

            }

        } catch (\Illuminate\Database\QueryException $e) {

            //Genero el mensaje de exito
            Session::flash('message',$e->errorInfo[1].', no fue posible actualizar');
            Session::flash('error', 'alert-danger');

            return redirect()->to('/users/');
            

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

                Role::findOrFail($id)->delete();

                $result = [
                        'tipo'          => 'Exito',
                        'message'       => 'Registro eliminado correctamente',
                        'iconoMensaje'  => 'icon fa fa-ban',
                        'tabla'         =>  true,
                        'divDestino'    => 'divMensaje'                
                        ];

                return response()->json($result);

            } catch (\Illuminate\Database\QueryException $e) {

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

    public function generarPassword()
    {
        $letras = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstvwxyz';

        $signos = '$#&?!+*';

        $password = '';

        mt_srand((double)  microtime()*1000000);

        for($i=0;$i<5;$i++)
          $password .= $letras[mt_rand (0, strlen ($letras)-1)];

        for($i=5;$i<7;$i++)
          $password .= mt_rand(0, 9);

        $password .= $signos[mt_rand(0, strlen($signos)-1)];

        $password = str_shuffle($password);

        return $password;
    }

    public function enviarPassword($email,$password)
    {

        $emailRadar = sfConfig::get('app_email_acta');
        $asunto     = "Nuevo password para RadarSoft";

        $mensaje = "Se ha generado un nuevo password de acceso para usted en RadarSoft, los datos son: \n\n";
        $mensaje .= sprintf("\n Usuario: %s \n Clave de acceso: %s \n",$email,$password);
        $mensaje .= "\n\n Saludos cordiales,";
        $mensaje .= "\n\n RadarSoft";
  

    }

}
