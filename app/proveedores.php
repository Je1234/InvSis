<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class proveedores extends Model
{
    protected $primaryKey ='id_proveedor';
    protected $fillable = ['nombre','direccion','telefono','estado'];

    public function proveedores()
    {
        return $this->hasOne('App\productos','id_proveedor');
    }

    public function scopeBuscarP($query, $nombre){

        if(($nombre)){
            return $query->where('nombre','like',"%$nombre%"); 
        }

    }

}
