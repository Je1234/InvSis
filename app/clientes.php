<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class clientes extends Model
{
    protected $primaryKey="id_documento";

    protected $fillable =['id_user','id_documento','id_tipo_documento','nombres','apellidos','correo','direccion','telefono','celular','fecha_nacimiento'];

    //Funcion para busqueda de productos
    public function scopeBuscar($query, $tipoB,$busqueda){

        if(($tipoB) && ($busqueda)){
            return $query->where($tipoB,'like',"%$busqueda%")->where('id_user',Auth::user()->id); 
        }

    }
}
