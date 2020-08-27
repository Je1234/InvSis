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
use Illuminate\Support\Facades\Validator;

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

        $metodos =DB::table('metodo_pagos')->get();

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
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|max:80',
            'direccion' => 'nullable|max:80',
            'telefono' => 'nullable|max:20',
        ],[
            'nombre.required' => 'El nombre del proveedor es requerido',
            'nombre.max' => 'El nombre del proveedor no debe exceder los :max caracteres',
            'direccion.max' => 'La direccion no debe exceder los :max caracteres',
            'telefono.max' => 'El telefono no debe exceder los :max caracteres',
            

        ]);

        if ($validatedData->passes()) {
            $proveedores = $request->all();
           proveedores::create($proveedores);

           $proveedores =DB::table('proveedores')->where('id_user',Auth::user()->id)->get();
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
   
               
           
           return response()->json(array('html'=>$lista));
           
        }else{
     
        return response()->json(['error'=>$validatedData->errors()->all()]);
    }
        

    }

    public function storeProducto(Request $request)
    {
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|max:20',
            'precio_venta' => 'nullable|digits_between:1,10',
            'precio_compra' => 'nullable|digits_between:1,10',
            'stock' => 'nullable|digits_between:1,11',
            'marca' => 'nullable|max:60',
            'ruta_imagen' => 'nullable|mimes:jpeg,jpg,png|max:5000'
        ],[
            'nombre.required' => 'El nombre del producto es requerido',
            'nombre.max' => 'El nombre del producto no debe exceder los :max caracteres',
            'precio_venta.digits_between' => 'El precio de venta no debe exceder los 15 digitos',
            'precio_compra.digits_between' => 'El precio de compra no debe exceder los 15 digitos',
            'stock.digits_between' => 'La cantidad de stock no debe exceder los 15 digitos',
            'marca.max' => 'La marca no debe exceder los :max caracteres',
            'ruta_imagen.mimes' => 'La imagen solo puede ser formato. jpeg,png,jpg',
            'ruta_imagen.max' => 'La imagen no puede exceder los 5Mb de peso',
           


        ]);

        if ($validatedData->passes()) {

            $entrada = $request->all();
            if ($archivo = $request->file('ruta_imagen')) {
                $archivo = $request->imagen->store('uploads', 'public');
                $nombre = $request->imagen->hashName();
               

                $entrada['ruta_imagen'] = $nombre;
               
            }


            productos::create($entrada);
            $products =DB::table('productos')->where('id_user',Auth::user()->id)->get();
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

            return response()->json(array('html'=>$lista));
        } else {

            return response()->json(['error' => $validatedData->errors()->all()]);
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
