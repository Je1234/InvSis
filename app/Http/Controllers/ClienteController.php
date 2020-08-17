<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\clientes;
class ClienteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $tipoB=$request->get('tipo');
        $busqueda=$request->get('buscarPor');
        $variablesurl = $request->only(['tipo','buscarPor']);
        $clientes= clientes::paginate(5);
        $tipos=DB::table('tipo_documentos')->get();
        $clientesB = clientes::buscar($tipoB, $busqueda)->paginate(10)->appends($variablesurl);

        return view ('clientes.ClienteIndex',compact('clientes','tipos','tipoB','busqueda','clientesB'));
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
        $clientes= new clientes;
        $clientes->id_documento=$request->documento;
        $clientes->id_tipo_documento=$request->tipo_documento;
        $clientes->nombres=$request->nombre;
        $clientes->apellidos=$request->apellido;
        $clientes->correo=$request->correo;
        $clientes->direccion=$request->direccion;
        $clientes->telefono=$request->telefono;
        $clientes->celular=$request->celular;
        $clientes->fecha_nacimiento=$request->fecha;
        $clientes->save();
        return redirect()->route('cliente.index')->with('datos','Registro agregado correctamente');

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
        $cliente= array(

            "id_documento"=>$request->documento,
            "id_tipo_documento"=>$request->tipo_documento,
            "nombres"=>$request->nombre,
            "apellidos"=>$request->apellido,
            "correo"=>$request->correo,
            "direccion"=>$request->direccion,
            "telefono"=>$request->telefono,
            "celular"=>$request->celular,
            "fecha_nacimiento"=>$request->fecha

        );

       

        clientes::findOrFail($request->id_documento)->update($cliente);

        return redirect()->route('cliente.index')->with('datos','Registro guardado correctamente');
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

        $eliminarC= clientes::findOrFail($id->id_documento);

        $eliminarC->delete();

        return redirect()->route('cliente.index')->with('datos','Registro eliminado correctamente');
    }
}
