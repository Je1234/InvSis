<?php

namespace App\Http\Controllers;

use App\productos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 

class ProductoController extends Controller
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
        $busqueda = $request->get('buscarPor');
        $tipo = $request->get('tipo');
        $variablesurl = $request->only(['tipo','buscarPor']);

        $productoB = productos::buscar($tipo, $busqueda)->paginate(10)->appends($variablesurl);
        
        $producto = productos::paginate(5);
        $results = productos::with('categorias')->get();
        $categoria = DB::table('categorias')->get();
        $ubicacion = DB::table('ubicaciones')->get();
        $proveedor = DB::table('proveedores')->get();
             
       
        return view('productos.ProductoIndex', compact('producto', 'results','categoria','ubicacion','tipo','busqueda','productoB','proveedor'));

        
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
        

        $entrada=$request->all();
        if($archivo=$request->file('imagen')){
            $archivo = $request->imagen->store('uploads','public');
            $nombre = $request->imagen->hashName();
            //$formato = $request->imagen->extension();

            $entrada['ruta_imagen']=$nombre;
            //$entrada['tipo']=$formato;
        }
       
        
        productos::create($entrada);
        return redirect()->route('producto.index')->with('datos','Registro guardado correctamente');
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
       
        if($archivo=$request->hasFile('imagen')){
            $archivo = $request->imagen->store('uploads','public');
            $nombre = $request->imagen->hashName();
            $entrada=$nombre;

            $producto =array(

                "id_ubicacion"=>$request->id_ubicacion,
                "id_proveedor"=>$request->id_proveedor,
                "nombre"=>$request->nombre,
                "marca"=>$request->marca,
                "precio_venta"=>$request->precio_venta,
                "precio_compra"=>$request->precio_compra,
                "id_categoria"=>$request->id_categoria,
                "stock"=>$request->stock,
                "descripcion"=>$request->descripcion,
                "ruta_imagen"=>$entrada
            );
        }else{
            $producto =array(

                "id_ubicacion"=>$request->id_ubica,
                "id_proveedor"=>$request->id_proveedor,
                "nombre"=>$request->nombre,
                "marca"=>$request->marca,
                "precio_venta"=>$request->precio_venta,
                "precio_compra"=>$request->precio_compra,
                "id_categoria"=>$request->id_categoria,
                "stock"=>$request->stock,
                "descripcion"=>$request->descripcion,
                
            );
        }

        $es=productos::findOrFail($request->id_producto);
        $es->update($producto);
           if(!$es){

            return redirect()->route('producto.index')->with('datos','Hubo un error');

           }else{

            productos::findOrFail($request->id_producto)->update($producto);

            return redirect()->route('producto.index')->with('datos','Registro actualizado correctamente');

           }
        
        //echo "<pre>"; print_r($producto); die;
       /* productos::findOrFail($request->id_producto)->update($producto);
     
        return redirect()->route('producto.index')->with('datos','Registro actualizado correctamente');*/
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

        $eliminarP = productos::findOrFail($id->id_producto);
        $eliminarc = storage_path() . '/app/public/uploads/' . $eliminarP->ruta_imagen;

        //Eliminar imagen de producto si existe
        if (file_exists($eliminarc)) 
        {
            File::delete($eliminarc);
        }
        $eliminarP->delete();
        
       
        return redirect()->route('producto.index')->with('datos','Registro Eliminado correctamente');
    }

}
