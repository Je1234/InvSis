<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
        $clientes= clientes::where('id_user',Auth::user()->id)->paginate(5);
        $tipos=DB::table('tipo_documentos')->get();
        $clientesB = clientes::buscar($tipoB, $busqueda)->where('id_user',Auth::user()->id)->paginate(10)->appends($variablesurl);

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
        $validatedData = Validator::make($request->all(), [
            'id_documento' => 'required|min:8|max:20',
            'nombres' => 'required|max:80',
            'apellidos' => 'required|max:80',
            'correo' => 'nullable|email|max:90',
            'direccion' => 'nullable|max:80',
            'telefono' => 'nullable|max:15',
            'celular' => 'nullable|max:15',
            'fecha_nacimiento' => 'nullable|date'
        ],[
            'id_documento.required' => 'El N° de documento es requerido',
            'id_documento.max' => 'El N° de documento no debe exceder los :max caracteres',
            'id_documento.min' => 'El N° de documento debe tener minimo :min caracteres',
            'nombres.required' => 'Los nombres del cliente son requeridos',
            'nombres.max' => 'El nombre del cliente no debe exceder los :max caracteres',
            'apellidos.required' => 'Los apellidos del cliente son requeridos',
            'apellidos.max' => 'El apellido del cliente no debe exceder los :max caracteres',
            'correo.max' => 'El correo no debe exceder los :max caracteres',
            'correo.email' => 'El correo debe ser una direccion valida',
            'direccion.max' => 'La direccion no debe exceder los :max caracteres',
            'telefono.max' => 'El telefono no debe exceder los :max caracteres',
            'celular.max' => 'El celular no debe exceder los :max caracteres',
            'fecha_nacimiento.date' => 'La fecha debe estar en un formato valido'
            

        ]);

        if ($validatedData->passes()) {
            $cliente = $request->all();
           clientes::create($cliente);

           return redirect()->route('cliente.index')->with('datos','Registro guardado correctamente');
           
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
    public function update(Request $request)
    {
        $cliente= array(

            "id_documento"=>$request->id_documento,
            "id_tipo_documento"=>$request->id_tipo_documento,
            "nombres"=>$request->nombres,
            "apellidos"=>$request->apellidos,
            "correo"=>$request->correo,
            "direccion"=>$request->direccion,
            "telefono"=>$request->telefono,
            "celular"=>$request->celular,
            "fecha_nacimiento"=>$request->fecha_nacimiento

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
