<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class categorias extends Model
{
    //
    protected $primaryKey = 'id_categoria';
    protected $fillable =['id_user','nom_categoria'];
}
