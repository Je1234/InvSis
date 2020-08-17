<option value="" selected>-- Elegir producto --</option>
@foreach ($products as $product)
<option value="{{ $product->id_producto }}" precio_venta="{{$product->precio_compra}}">
    {{ $product->nombre }} (${{ number_format($product->precio_compra, 2) }})
</option>
@endforeach