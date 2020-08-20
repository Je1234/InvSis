<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    protected $primaryKey ='id_proveedor';
    protected $fillable = ['id_user','nombre','direccion','telefono','estado'];

    public function proveedores()
    {
        return $this->hasOne('App\productos','id_proveedor');
    }

    public function scopeBuscarP($query, $nombre){

        if(($nombre)){
            return $query->where('nombre','like',"%$nombre%")->where('id_user',Auth::user()->id); 
        }

    }

}
