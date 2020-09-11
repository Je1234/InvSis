<?php

namespace App;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ubicaciones extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'id_ubicacion';

    protected $fillable = ['nombre_bodega','seccion','direccion','id_user'];
    protected $dates = ['deleted_at'];

    public function scopeBuscarUb($query, $nombre){

        if(($nombre)){
            return $query->where('nombre','like',"%$nombre%")->where('id_user',Auth::user()->id); 
        }

    }
}
