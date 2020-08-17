<!DOCTYPE html>
<html lang="es">

<head>
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Factura Venta</title>
</head>

<body>
    @foreach($ventaR as $v)
    @if($v->id_venta== $ventas->id_venta)
    <div class="container-fluid">
        <div class="row">
            <div class="col-xs-10 ">
                <h1>Factura Venta</h1>
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
                {{$v->fecha_factura}}
                <br>
                <strong>Factura No.</strong>
                <br>
                {{$v->id_venta}}
            </div>
        </div>
        <hr>
        <div class="row text-center" style="margin-bottom: 2rem;">
            <div class="col-xs-6">
                @foreach($clientes as $cli)
                @if($v->id_documento== $cli->id_documento)
                <h1 class="h2">N° Documento</h1>
                <strong>{{$v->id_documento}}</strong>

            </div>
            <div class="col-xs-6">
                <h1 class="h2">Nombres y apellidos</h1>
                <strong>{{$cli->nombres}} {{$cli->apellidos}}</strong>
            </div>
            @endif
            @endforeach
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
                        @foreach($v->products as $item)


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
            </div>
        </div>
        @endif
        @endforeach
        <div class="row">
            <div class="col-xs-12 text-center">
                <p class="h5">Venta realizada</p>
            </div>
        </div>
    </div>
</body>

</html>