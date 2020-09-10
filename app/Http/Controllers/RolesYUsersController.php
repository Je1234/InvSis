<?php

namespace App\Http\Controllers;
use App\User;
use Carbon\Carbon;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class RolesYUsersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users=User::with('roles')->paginate(5);

        $roles=Role::with('permissions')->paginate(5);

        return view('roles.RolesYperm',compact('users','roles'));
    }

    public function indexRecoveryUsuarios()
    {
        $users=User::with('roles')->onlyTrashed()->paginate(5);


        return view('roles.RolesYpermRe',compact('users'));
    }


    public function RenovarUsuarios(Request $request)
    {
        User::withTrashed()->find($request->id)->restore();

        $newFecha=Carbon::now('GMT-5');

        $UserRenovado= array(
            "fecha_inicio"=>$newFecha,
            "tipo_plan"=>$request->tipo_plan
        );

        $user= User::withTrashed()->find($request->id);

        $user->update($UserRenovado);
   
        return redirect()->route('IndexRusuarios')->with('datos','Usuario renovado correctamente');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $permisos = $request->get('permisos',[]);
        $rolA = Role::create(['name' => $request->name]);

        $rolA->givePermissionTo($permisos);

        return redirect()->route('roles.index')->with('datos','registro guardado correctamente');
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
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $newFecha =  Carbon::now('GMT-5');
        $tipo_plan= $request->tipo_plan;
        
        if ( $tipo_plan == '') {
            $datos = array(
                "name" => $request->name,
                "email" => $request->email,
               
            );
        } else {
            $datos = array(
                "name" => $request->name,
                "email" => $request->email,
                "fecha_inicio" =>$newFecha,
                "tipo_plan" => $request->tipo_plan
            );
        }

     
            $user =User::findOrFail($request->id);
            $user->update($datos);

            return redirect()->route('roles.index')->with('datos','Registro actualizado correctamente'); 
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(request $id)
    {   $delete = $id->all();
        $eliminarR= Role::findOrFail($id->id);
        $eliminarR->delete();

        return redirect()->route('roles.index')->with('datos','Registro guardado correctamente');
    }

    public function destroyUser(request $id)
    {   $delete = $id->all();
        $eliminarR= User::findOrFail($id->id);
        $eliminarR->forceDelete();

        return redirect()->route('roles.index')->with('datos','Registro eliminado correctamente');
    }
}

