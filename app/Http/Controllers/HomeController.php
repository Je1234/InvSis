<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
       
        $Mesactual = date('m');
        $Añoactual = date('Y');
        $ventas = DB::table('ventas')
                    ->where('id_user',Auth::user()->id)
                    ->whereRaw('YEAR(created_at)= ? and MONTH(created_at) = ?',[$Añoactual,$Mesactual])
                    ->pluck('precio_total');
    
       
        return view('ini',compact('ventas'));
    }
    public function ReUsuario()
    {
        
        return view('Auth.register');
    }
    public function RolesYperm()
    {
        /*$rolA = Role::create(['name' => 'admin']);
        $rolCliente = Role::create(['name' => 'cliente']);
        $permisoA = Permission::create(['name' => 'crear-user']);

       
        $permisoA->assignRole($rolA);*/

        /*$Admin = User::find(1);

        $Admin->assignRole('admin');*/

        /*$cliente = User::find(2);

        $cliente->assignRole('cliente');*/

        //$ventas= DB::table('ventas')->pluck('precio_total');
        return redirect()->route('ini');
    }
}
