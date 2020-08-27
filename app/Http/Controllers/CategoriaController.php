<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\categorias;
use Illuminate\Support\Facades\Validator;

class CategoriaController extends Controller
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
    public function index()
    {
        $categoria = categorias::where('id_user',Auth::user()->id)->paginate(5);
        return view('categorias.CategoriaIndex' ,compact('categoria'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
       
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
            'nom_categoria' => 'required|max:50',
            
        ],[
            'nom_categoria.required' => 'El nombre de la categoria no debe estar vacio',
            'nom_categoria.max' => 'El nombre de la categoria no debe exceder los :max caracteres',
        ]);
       
       
        if ($validatedData->passes()) {
            $categoria = $request->all();
           categorias::create($categoria);

           return redirect()->route('categoria.index')->with('datos','Registro guardado correctamente');
           
        }
     
        return response()->json(['error'=>$validatedData->errors()->all()]);
        
        
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       
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
        $categoria =array(

            "nom_categoria"=>$request->nom_categoria,
            
        );
        
        categorias::findOrFail($request->id_categoria)->update($categoria);
        
        return redirect()->route('categoria.index')->with('datos','Registro actualizado correctamente');
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

        $eliminarC = categorias::findOrFail($id->id_categoria);
        $eliminarC->delete();

        return redirect()->route('categoria.index')->with('datos','Registro eliminado correctamente');
        
    }
}
