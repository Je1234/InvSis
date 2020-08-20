<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ventas extends Model
{
    protected $primaryKey="id_venta";

    public $table="ventas";
    protected $fillable=['id_user','id_documento','fecha_factura','id_metodo_pago','precio_total','subtotal','pagado','descuento','devuelto','total_sin_descuento','iva','valor_iva','descripcion'];
    public function products()
    {

        return $this->belongsToMany('App\productos','detalle_ventas','id_venta','id_producto')->withPivot(['cantidad','total_p_producto']);
  
    }
    

   

}
