<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\VentasExport;
use App\ventas;
use App\clientes;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
class VentaController extends Controller
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
    {   $ventas = ventas::where('id_user',Auth::user()->id)->with('products')->paginate(5);
        $tipos =DB::table('tipo_documentos')->get();
        $products =DB::table('productos')->where('id_user',Auth::user()->id)->get();
        $clientes =DB::table('clientes')->where('id_user',Auth::user()->id)->get();

        $metodos =DB::table('metodo_pagos')->where('id_user',Auth::user()->id)->get();
     
        return view('ventas.VentaIndex',compact('products','clientes','metodos','tipos','ventas'));
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
    public function storeCliente(Request $request)
    {
        $clientesN= new clientes;
        $clientesN->id_documento=$request->id_documento;
        $clientesN->id_tipo_documento=$request->id_tipo_documento;
        $clientesN->nombres=$request->nombres;
        $clientesN->apellidos=$request->apellidos;
        $clientesN->correo=$request->correo;
        $clientesN->direccion=$request->direccion;
        $clientesN->telefono=$request->telefono;
        $clientesN->celular=$request->celular;
        $clientesN->fecha_nacimiento=$request->fecha_nacimiento;
        $clientesN->save();
        $clientes =DB::table('clientes')->get();
        $lista = view('ventas.Listaclientes', compact('clientes'))->render();
        
        $utf8_ansi2 = array(
            '/ "} /'=> '',
            '/\u00f1/' =>'ñ',
            '/\u00d1/' =>'Ñ',
            '/<\/option>/'=>'',
            '/<\/option>"}/'=>'',
            '/\r\n/'=>'',
            );
            $lista = preg_replace(array_keys($utf8_ansi2),array_values($utf8_ansi2),$lista);

            $lista2= $lista;
        
        return response()->json(compact('lista2'));

    }
  
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $venta = ventas::create($request->all());

        $products = $request->input('products', []);
        $clientes = $request->input('id_documento');
        $ptotal = $request->input('precio_total');
        $quantities = $request->input('cantidad', []);
        $total_p_producto=$request->input('total',[]);
        
        
        for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $venta->products()->attach($products[$product], [
                'cantidad' => $quantities[$product],
                'total_p_producto' => $total_p_producto[$product],
              ]);

        }

    }
   
    return redirect()->route('venta.index')->with('datos','Venta realizada correctamente');
        
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
        $ventaM =array(

            "id_documento"=>$request->id_documento,
            "id_metodo_pago"=>$request->id_metodo_pago,
            "fecha_factura"=>$request->fecha_factura,
            "precio_total"=>$request->precio_total,
            "subtotal"=>$request->subtotal,
            "pagado"=>$request->pagado,
            "devuelto"=>$request->devuelto,
            "descuento"=>$request->descuento,
            "total_sin_descuento"=>$request->total_sin_descuento,
            "iva"=>$request->iva
            
        );
        ventas::findOrFail($request->id_venta)->update($ventaM);

        return redirect()->route('venta.index')->with('datos','Venta actualizada correctamente');
       
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargaPDF(Request $id)
    {
        $ventaR = ventas::with('products')->get();
        $delete = $id->all();

        $ventas = ventas::findOrFail($id->id_venta);
        $clientes =DB::table('clientes')->get();
        
        $PdfV= PDF::loadView('ventas.VentaPdf', compact('ventas','ventaR','clientes'));
        return $PdfV->download('venta.pdf');
           
    }
    
    public function descargaExcel()
    {    
 
        return Excel::download(new VentasExport, 'Venta.xlsx');
           
    }

    public function destroy(Request $id)
    {
        $delete = $id->all();

        $eliminarV = ventas::findOrFail($id->id_venta);
        $eliminarV->products()->detach();
        $eliminarV->delete();

        return redirect()->route('venta.index')->with('datos','Registro eliminado correctamente');
    }
}
