<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class proveedores extends Model
{
    use SoftDeletes;
    protected $primaryKey ='id_proveedor';
    protected $fillable = ['id_user','nombre','direccion','telefono','estado'];
    protected $dates = ['deleted_at'];
    
    public function proveedores()
    {
        return $this->hasOne('App\productos','id_proveedor');
    }

    public function scopeBuscarP($query, $nombre){

        if(($nombre)){
            return $query->where('nombre','like',"%$nombre%")->where('id_user',Auth::user()->id); 
        }

    }

    public function scopeBuscarRecoveryP($query, $nombre){

        if(($nombre)){
            return $query->where('nombre','like',"%$nombre%")->onlyTrashed()->where('id_user',Auth::user()->id); 
        }

    }

}
