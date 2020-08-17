<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\categorias;
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
        $categoria = categorias::paginate(5);
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

        $categoria= new categorias;
        $categoria->nom_categoria=$request->nombre;
        $categoria->save();

        return redirect()->route('categoria.index')->with('datos','Registro guardado correctamente');
        
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
