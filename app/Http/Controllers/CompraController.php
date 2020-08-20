<?php

namespace App\Http\Controllers;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ComprasExport;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\productos;
use App\proveedores;
use App\compras;
use Barryvdh\DomPDF\Facade as PDF;
class CompraController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $compra = compras::where('id_user',Auth::user()->id)->with('relacion')->paginate(5);
        $products =DB::table('productos')->where('id_user',Auth::user()->id)->get();
        $proveedores =DB::table('proveedores')->where('id_user',Auth::user()->id)->get();
        $categoria =DB::table('categorias')->where('id_user',Auth::user()->id)->get();
        $ubicacion =DB::table('ubicaciones')->where('id_user',Auth::user()->id)->get();

        $metodos =DB::table('metodo_pagos')->where('id_user',Auth::user()->id)->get();

         return view('compras.CompraIndex',compact('compra','metodos','products','proveedores','categoria','ubicacion'));
        
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
        $compra = compras::create($request->all());
        $products = $request->get('products',[]);
        $quantities = $request->input('cantidad', []);
        $total_p_producto=$request->input('total',[]);
        

        for ($product=0; $product < count($products); $product++) {
        if ($products[$product] != '') {
            $compra->relacion()->attach($products[$product], [
                'cantidad' => $quantities[$product],
                'total_p_producto' => $total_p_producto[$product],
              ]);
            }
        }
        
        return redirect()->route('compra.index')->with('datos','Compra realizada correctamente');
    }

    public function storeProveedor(Request $request)
    {
        $proveedor= new proveedores;
        $proveedor->nombre=$request->nombre;
        $proveedor->direccion=$request->direccion;
        $proveedor->telefono=$request->telefono;
        $proveedor->estado=$request->estado;
        $proveedor->save();
        
        $proveedores =DB::table('proveedores')->get();
        $lista = view('compras.ListaProveedores', compact('proveedores'))->render();
        
        $utf8_ansi2 = array(
            '/ "} /'=> '',
            '/\u00f1/' =>'ñ',
            '/\u00d1/' =>'Ñ',
            '/<\/option>/'=>'',
            '/<\/option>"}/'=>'',
            '/\r\n/'=>'',
            );
            $lista = preg_replace(array_keys($utf8_ansi2),array_values($utf8_ansi2),$lista);

            
        
        return response()->json(compact('lista'));

    }

    public function storeProducto(Request $request)
    {
        $entrada=$request->all();
        if($archivo=$request->file('imagen')){
            $archivo = $request->imagen->store('uploads','public');
            $nombre = $request->imagen->hashName();
            //$formato = $request->imagen->extension();

            $entrada['ruta_imagen']=$nombre;
            //$entrada['tipo']=$formato;
        }
       
        productos::create($entrada);
        $products =DB::table('productos')->get();
        $lista = view('compras.ListaProductos', compact('products'))->render();
        
        $utf8_ansi2 = array(
            '/ "} /'=> '',
            '/\u00f1/' =>'ñ',
            '/\u00d1/' =>'Ñ',
            '/<\/option>/'=>'',
            '/<\/option>"}/'=>'',
            '/\r\n/'=>'',
            );
            $lista = preg_replace(array_keys($utf8_ansi2),array_values($utf8_ansi2),$lista);
        
        return response()->json(compact('lista'));

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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descargaPDF(Request $id)
    {
        $compraR = compras::with('relacion')->get();
        $delete = $id->all();

        $compras = compras::findOrFail($id->id_compra);
        $proveedores =DB::table('proveedores')->get();
        
        $PdfC= PDF::loadView('compras.CompraPdf', compact('compras','compraR','proveedores'));
        return $PdfC->download('compra.pdf');       
       
    }
    public function descargaExcel()
    {      
       
        return Excel::download(new ComprasExport, 'compra.xlsx');
           
    }

    public function destroy(Request $id)
    {
        $delete = $id->all();

        $eliminarC = compras::findOrFail($id->id_compra);
        $eliminarC->relacion()->detach();
        $eliminarC->delete();

        return redirect()->route('compra.index')->with('datos','Registro eliminado correctamente');
    }
}
