<?php

namespace App\Http\Controllers;
use App\ubicaciones;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UbicacionController extends Controller
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

        $proveedor = DB::table('productos')->where('id_user',Auth::user()->id)->get();
        
        
        $categoria = DB::table('categorias')->where('id_user',Auth::user()->id)->get();
        $ubicacionP = DB::table('ubicaciones')->where('id_user',Auth::user()->id)->get();

        $ubicacionB= ubicaciones::buscarub($nombre)->where('id_user',Auth::user()->id)->paginate(5,['*'], 'prov')->appends($variableurl);
        $ubicacion= ubicaciones::where('id_user',Auth::user()->id)->paginate(5); 
        return view('ubicaciones.UbicacionIndex',compact('ubicacionP','proveedor','ubicacionB','nombre','products','categoria','ubicacion'));
    }

    public function indexRecoveryUbicaciones(Request $request)
    {
        $nombre=$request->get('buscarNom');
        $variableurl = $request->only(['buscarNom']);
        
        $products = DB::table('productos')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();

        $proveedor = DB::table('productos')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
        
        
        $categoria = DB::table('categorias')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
        $ubicacionP = DB::table('ubicaciones')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();

        $ubicacionB= ubicaciones::buscarub($nombre)->where('id_user',Auth::user()->id)->onlyTrashed()->paginate(5,['*'], 'prov')->appends($variableurl);
        $ubicacion= ubicaciones::where('id_user',Auth::user()->id)->onlyTrashed()->paginate(5); 
        return view('ubicaciones.UbicacionReIndex',compact('ubicacionP','proveedor','ubicacionB','nombre','products','categoria','ubicacion'));
    }

    public function RecoveryUbicacion(request $request)
    {
        ubicaciones::withTrashed()->find($request->id_ubicacion)->restore();
        return redirect()->route('IndexRubicacion')->with('datos','Registro recuperado correctamente');
    }

    public function RecoveryAllUbicacion(request $request)
    {
        ubicaciones::where('id_user',Auth::user()->id)->onlyTrashed()->restore();
        return redirect()->route('ubicacion.index')->with('datos','Todos los registros recuperados correctamente');
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
        $validatedData = Validator::make($request->all(), [
            'nombre_bodega' => 'required|max:80',
            'direccion' => 'nullable|max:80',
            'seccion' => 'nullable|max:80',
        ],[
            'nombre_bodega.required' => 'El nombre de la bodega es requerido',
            'nombre_bodega.max' => 'El nombre de la no debe exceder los :max caracteres',
            'direccion.max' => 'La direccion no debe exceder los :max caracteres',
            'seccion.max' => 'La seccion de bodega no debe exceder los :max caracteres',
            

        ]);

        if ($validatedData->passes()) {
            $ubicaciones = $request->all();
           ubicaciones::create($ubicaciones);

           return redirect()->route('ubicacion.index')->with('datos','Registro guardado correctamente');
           
        }else{
     
        return response()->json(['error'=>$validatedData->errors()->all()]);
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
        $validatedData = Validator::make($request->all(), [
            'nombre_bodega' => 'required|max:80',
            'direccion' => 'nullable|max:80',
            'seccion' => 'nullable|max:80',
        ],[
            'nombre_bodega.required' => 'El nombre de la bodega es requerido',
            'nombre_bodega.max' => 'El nombre de la no debe exceder los :max caracteres',
            'direccion.max' => 'La direccion no debe exceder los :max caracteres',
            'seccion.max' => 'La seccion de bodega no debe exceder los :max caracteres',
        ]);

        if ($validatedData->passes()) {
            $ubicaciones = $request->all();
            
            ubicaciones::findOrFail($request->id_ubicacion)->update($ubicaciones);

           return redirect()->route('ubicacion.index')->with('datos','Registro guardado correctamente');
           
        }else{
     
        return response()->json(['error'=>$validatedData->errors()->all()]);
    }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $id)
    {
        $destroy = $id->all();

        $eliminarUb=ubicaciones::findOrFail($id->id_ubicacion);
        $eliminarUb->delete();

        return redirect()->route('ubicacion.index')->with('datos','Registro eliminado correctamente');
    }
}
