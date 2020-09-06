<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class clientes extends Model
{
    use SoftDeletes;
    protected $primaryKey="id_documento";

    protected $fillable =['id_user','id_documento','id_tipo_documento','nombres','apellidos','correo','direccion','telefono','celular','fecha_nacimiento'];
    protected $dates = ['deleted_at'];
    //Funcion para busqueda de productos
    public function scopeBuscar($query, $tipoB,$busqueda){

        if(($tipoB) && ($busqueda)){
            return $query->where($tipoB,'like',"%$busqueda%")->where('id_user',Auth::user()->id); 
        }

    }

    public function scopeBuscarRecovery($query, $tipoB,$busqueda){

        if(($tipoB) && ($busqueda)){
            return $query->where($tipoB,'like',"%$busqueda%")->where('id_user',Auth::user()->id); 
        }

    }
}
