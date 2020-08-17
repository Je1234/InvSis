<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    //
    protected $primaryKey = 'id_categoria';
    protected $fillable =['nom_categoria'];
}
