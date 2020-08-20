<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\proveedores;
use Illuminate\Http\Request;
use vendor\laravel\framework\src\Illuminate\Pagination\Environment;
class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function __construct()
    {
        $this->middleware('auth');
    }
    public function index(Request $request)
    {
        $nombre=$request->get('buscarNom');
        $variableurl = $request->only(['buscarNom']);
        
        $products = DB::table('productos')->where('id_user',Auth::user()->id)->get();
        
        
        $categoria = DB::table('categorias')->where('id_user',Auth::user()->id)->get();
        $ubicacion = DB::table('ubicaciones')->where('id_user',Auth::user()->id)->get();

        $proveedorB= proveedores::buscarp($nombre)->where('id_user',Auth::user()->id)->paginate(5,['*'], 'prov')->appends($variableurl);
        $proveedor= proveedores::where('id_user',Auth::user()->id)->paginate(5); 
        return view('proveedores.ProveedorIndex',compact('proveedor','proveedorB','nombre','products','categoria','ubicacion'));

        
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

        $proveedor= new proveedores;
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->estado=$request->estado;
        $proveedor->id_user=$request->id_user;
        $proveedor->save();

        return redirect()->route('proveedor.index')->with('datos','Registro guardado correctamente');

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
    public function update(Request $request, $id)
    {
        $proveedor= array(

            "nombre"=>$request->nombre,
            "direccion"=>$request->direccion,
            "telefono"=>$request->telefono,
            "estado"=>$request->estado,
            
            
        );

        proveedores::findOrFail($request->id_proveedor)->update($proveedor);
        
        return redirect()->route('proveedor.index')->with('datos','Regitro actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $delete = $id->all();

        $eliminarProv= proveedores::findOrFail($id->id_proveedor);

        $eliminarProv->delete();

        return redirect()->route('proveedor.index')->with('datos','Registro eliminado correctamente');
    }
}
