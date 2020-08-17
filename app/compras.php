<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class compras extends Model
{
    protected $primaryKey="id_compra";

    public $table="compras";

    protected $fillable=['id_proveedor','fecha_factura','id_metodo_pago','precio_total','subtotal','pagado','descuento','devuelto','total_sin_descuento','iva','valor_iva','descripcion'];

    public function relacion()
    {

        return $this->belongsToMany('App\productos','detalle_compras','id_compra','id_producto')->withPivot(['cantidad','total_p_producto']);
  
    }
    
}
