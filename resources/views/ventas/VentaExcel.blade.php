@foreach($ventas as $v)


<table class="table table-condensed table-bordered table-striped">
    <thead>
        <tr>
            <th>Nombre Producto</th>
            <th>Cantidad</th>
            <th>Precio unitario</th>
            <th>Total</th>
            <th>N° Factura venta</th>
            <th>Fecha factura</th>
            <th>N° Documento Cliente</th>
            <th>Nombres y apellidos</th>
        </tr>
        
            

        
    </thead>
    <tbody>
        @foreach($v->products as $item)


        <tr>
            <td>{{ $item->nombre }}</td>
            <td>x{{ $item->pivot->cantidad}}</td>
            <td>${{ $item->precio_venta }}</td>
            <td>${{ $item->pivot->total_p_producto }}</td>
        </tr>
        @endforeach

        <td>{{$v->id_venta}}</td>

        <td>{{$v->fecha_factura}}</td>
        @foreach($clientes as $cli)
        @if($v->id_documento== $cli->id_documento)

        <td>{{$v->id_documento}}</td>

        <td>{{$cli->nombres}} {{$cli->apellidos}}</td>
       
        @endif
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <td colspan="3" class="text-right">Subtotal</td>
            <td>${{$v->subtotal}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Descuento</td>
            <td>{{$v->descuento}}%</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Total sin descuento</td>
            <td>${{$v->total_sin_descuento}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">IVA</td>
            <td>{{$v->iva}}%</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Valor IVA</td>
            <td>${{$v->valor_iva}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Pagado</td>
            <td>${{$v->pagado}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">Devuelto</td>
            <td>${{$v->devuelto}}</td>
        </tr>
        <tr>
            <td colspan="3" class="text-right">
                <h4>Total</h4>
            </td>
            <td>
                <h4>${{$v->precio_total}}</h4>
            </td>
        </tr>
    </tfoot>
</table>

@endforeach