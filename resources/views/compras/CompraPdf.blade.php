<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura Compra</title>
</head>

<body>
    @foreach($compraR as $c)
    @if($c->id_compra== $compras->id_compra )
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 ">
                <h1>Factura compra</h1>
                <strong>InvSis</strong>
            </div>
            <div class="col-xs-2">
                <img class="img img-circle img-responsive" src="assets/img/logoAD.jpg" alt="Logotipo">
            </div>
        </div>
        <hr>
        <div class="row">
            <div class="col-xs-10">
                <h1 class="h6"></h1>
                <h1 class="h6"></h1>
            </div>
            <div class="col-xs-2 text-center">
                <strong>Fecha</strong>
                <br>
                {{$c->fecha_factura}}
                <br>
                <strong>Factura No.</strong>
                <br>
                {{$c->id_compra}}
            </div>
        </div>
        <hr>
        <div class="row text-center" style="margin-bottom: 2rem;">
            <div class="col-xs-6">
                @foreach($proveedores as $p)
                @if($c->id_proveedor== $p->id_proveedor)
                <h1 class="h2">Proveedor</h1>
                <strong>{{$p->nombre}}</strong>
                @endif
                @endforeach
            </div>
            <div class="col-xs-6">

            </div>
        </div>
        <div class="row">
            <div class="col-xs-12">
                <table class="table table-condensed table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Nombre Producto</th>
                            <th>Cantidad</th>
                            <th>Precio unitario</th>
                            <th>Total</th>
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
            </div>
        </div>
        @endif
        @endforeach
        <div class="row">
            <div class="col-xs-12 text-center">
                <p class="h5">Gracias por su compra</p>
            </div>
        </div>
    </div>
</body>

</html>