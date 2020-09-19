<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Validator;
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
        $products =DB::table('productos')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
        $clientes =DB::table('clientes')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();

        $metodos =DB::table('metodo_pagos')->get();
     
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

           $clientes =DB::table('clientes')->where('id_user',Auth::user()->id)->get();
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
           
           return response()->json(array('html'=>$lista2));
        }else{
     
        return response()->json(['error'=>$validatedData->errors()->all()]);
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
        $venta = ventas::create($request->all());

        $products = $request->input('products', []);
        $clientes = $request->input('id_documento');
        $ptotal = $request->input('precio_total');
        $quantities = $request->input('cantidad', []);
        $total_p_producto=$request->input('total',[]);


        //Restar stock al hacer una venta
        $stockA=0;

        for ($i = 0; $i < count($products); $i++) {
            $stockA = DB::table('productos')
            ->select('stock')
            ->where('id_producto',  $products[$i])
            ->first();
            if ($stockA->stock - $quantities[$i] <= 0) {
                DB::table('productos')
                ->where('id_producto', $products[$i])
                ->update(array('stock' =>  0 ));
            } else {

                DB::table('productos')
                ->where('id_producto', $products[$i])
                ->update(array('stock' => $stockA->stock - $quantities[$i]));
            }
        }
           
        
        for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $venta->products()->attach($products[$product], [
                'cantidad' => $quantities[$product],
                'total_p_producto' => $total_p_producto[$product],
              ]);

        }
        return redirect()->route('venta.index')->with('datos','Venta realizada correctamente');
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
        $clientes =DB::table('clientes')->whereNull('deleted_at')->get();
        $fecha = date('m-d-Y');
        $PdfV= PDF::loadView('ventas.VentaPdf', compact('ventas','ventaR','clientes'));
        return $PdfV->download('venta_'.$fecha.'_N°'.$ventas->id_venta.'.pdf');
           
    }
    
    public function descargaExcel(Request $id)
    {
        $ventas = ventas::findOrFail($id->id_venta);
        $fecha = date('m-d-Y');
        return Excel::download(new VentasExport, 'Venta_'.$fecha.'_N°'.$ventas->id_venta.'.xlsx');
           
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
