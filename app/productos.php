<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\UploadedFile;
class productos extends Model
{
    protected $primaryKey = 'id_producto';
    public $table="productos";
    protected $fillable=["id_ubicacion","id_user","id_proveedor","ruta_imagen","nombre","marca","precio_venta","precio_compra","id_categoria","stock","descripcion"];
    public function compras()
    {

        return $this->belongsToMany('App\compras');
  
    }
    public function categorias()
    {
        return $this->hasOne('App\categorias','id_categoria');
    }
    public function ventas()
    {

        return $this->belongsToMany('App\ventas');
  
    }
    


    
 //Funcion para busqueda de productos
    public function scopeBuscar($query, $tipo,$busqueda){

        if(($tipo) && ($busqueda)){
            return $query->where($tipo,'like',"%$busqueda%")->where('id_user',Auth::user()->id); 
        }

    }
}
    
    
    
