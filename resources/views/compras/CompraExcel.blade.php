@foreach($compras as $c)


<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
            <th>N° Factura venta</th>
            <th>Fecha factura</th>
            <th>N° proveedor</th>
            <th>Nombre proveedor</th>
        </tr>
        
            

        
    </thead>
    <tbody>
        @foreach($c->relacion as $item)


        <tr>
            <td>{{ $item->nombre }}</td>
            <td>x{{ $item->pivot->cantidad}}</td>
            <td>${{ $item->precio_venta }}</td>
            <td>${{ $item->pivot->total_p_producto }}</td>
        </tr>
        @endforeach

        <td>{{$c->id_compra}}</td>

        <td>{{$c->fecha_factura}}</td>
        @foreach($proveedores as $prov)
        @if($c->id_proveedor== $prov->id_proveedor)

        <td>{{$c->id_proveedor}}</td>

        <td>{{$prov->nombre}}</td>
       
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-right">Subtotal</td>
            <td>${{$c->subtotal}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Descuento</td>
            <td>{{$c->descuento}}%</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Total sin descuento</td>
            <td>${{$c->total_sin_descuento}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">IVA</td>
            <td>{{$c->iva}}%</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Valor IVA</td>
            <td>${{$c->valor_iva}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Pagado</td>
            <td>${{$c->pagado}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Devuelto</td>
            <td>${{$c->devuelto}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">
                <h4>Total</h4>
            </td>
            <td>
                <h4>${{$c->precio_total}}</h4>
            </td>
        </tr>
    </tfoot>
</table>

@endforeach