<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class categorias extends Model
{
    //
    use SoftDeletes;
    protected $primaryKey = 'id_categoria';
    protected $fillable =['id_user','nom_categoria'];

    protected $dates = ['deleted_at'];
}
