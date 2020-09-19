<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use App\productos;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File; 
use Illuminate\Support\Facades\Validator;

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

        $productoB = productos::buscar($tipo, $busqueda)->where('id_user',Auth::user()->id)->paginate(10)->appends($variablesurl);  
            
        $producto = productos::where('id_user',Auth::user()->id)->paginate(5);

        $categoria = DB::table('categorias')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
        $ubicacion = DB::table('ubicaciones')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
        $proveedor = DB::table('proveedores')->where('id_user',Auth::user()->id)->whereNull('deleted_at')->get();
             
       
        return view('productos.ProductoIndex', compact('producto','categoria','ubicacion','tipo','busqueda','productoB','proveedor'));

        
    }

    public function indexRecoveryProducto(Request $request)
    {
        $busqueda = $request->get('buscarPor');
        $tipo = $request->get('tipo');
        $variablesurl = $request->only(['tipo','buscarPor']);
        $productoB = productos::buscarreproducto($tipo, $busqueda)->where('id_user',Auth::user()->id)->onlyTrashed()->paginate(10)->appends($variablesurl);  
        $producto = productos::where('id_user',Auth::user()->id)->onlyTrashed()->paginate(5);

             
       
        return view('productos.ProductoReIndex', compact('producto','tipo','busqueda','productoB'));

        
    }

    public function RecoveryProducto(request $request)
    {
        productos::withTrashed()->find($request->id_producto)->restore();
        return redirect()->route('IndexRproducto')->with('datos','Registro recuperado correctamente');
    }

    public function RecoveryAllProducto(request $request)
    {
        productos::where('id_user',Auth::user()->id)->onlyTrashed()->restore();
        return redirect()->route('producto.index')->with('datos','Todos los registros recuperados correctamente');
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
            'nombre' => 'required|max:80',
            'precio_venta' => 'nullable|digits_between:1,15',
            'precio_compra' => 'nullable|digits_between:1,15',
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
            if ($archivo = $request->file('imagen')) {
                $archivo = $request->imagen->store('uploads', 'public');
                $nombre = $request->imagen->hashName();
               

                $entrada['ruta_imagen'] = $nombre;
               
            }
            productos::create($entrada);
            return redirect()->route('producto.index')->with('datos', 'Registro guardado correctamente');
        } else {

            return response()->json(['error' => $validatedData->errors()->all()]);
        }

        /*$entrada=$request->all();
        if($archivo=$request->file('imagen')){
            $archivo = $request->imagen->store('uploads','public');
            $nombre = $request->imagen->hashName();
            //$formato = $request->imagen->extension();

            $entrada['ruta_imagen']=$nombre;
            //$entrada['tipo']=$formato;
        }
       
        
        productos::create($entrada);
        return redirect()->route('producto.index')->with('datos','Registro guardado correctamente');*/
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
        $validatedData = Validator::make($request->all(), [
            'nombre' => 'required|max:80',
            'precio_venta' => 'nullable|digits_between:1,15',
            'precio_compra' => 'nullable|digits_between:1,15',
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

            $es = productos::findOrFail($request->id_producto);
            $eliminarc = storage_path() . '/app/public/uploads/' . $es->ruta_imagen;


            //Eliminar imagen de producto si existe
            if (file_exists($eliminarc) && $es->ruta_imagen != 'default.png') {
                File::delete($eliminarc);
            }
            $es->update($producto);
            return redirect()->route('producto.index')->with('datos', 'Registro guardado correctamente');
        } else {

            return response()->json(['error' => $validatedData->errors()->all()]);
        }
       
        /*if($archivo=$request->hasFile('imagen')){
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

           }*/
        
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
        if (file_exists($eliminarc) && $eliminarP->ruta_imagen != 'default.png') 
        {
            File::delete($eliminarc);
        }
        $eliminarP->delete();
        
       
        return redirect()->route('producto.index')->with('datos','Registro Eliminado correctamente');
    }

}
