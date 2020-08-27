@extends('layouts.dashboard')
@section('content')
<div class="container-fluid">
    <!--Alerta para peticiones exitosas-->
    @if (session('datos') )

    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{session('datos')}}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    @endif
    <!--Mensaje para cliente registrado correctamente-->
    <div id="msg" style="display:none" class="alert alert-success alert-dismissible fade show" role="alert">

        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <form action="{{ route('venta.store')}}" id="form_venta" class="form-submit-limitV" method="POST">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Ventas</h4>

                    </div>
                    <div class="card-body">


                        <div class="form-group">
                            <label for="">Cantidad pagada</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" class="form-control" id="pagado" name="pagado" placeholder="0.00">
                            </div>

                        </div>


                        <div class="form-group">
                            <label for="">Metodo de pago</label>
                            <select class="form-control selectpicker" name="id_metodo_pago">
                                <option value="">Elija el metodo de pago</option>
                                @foreach ($metodos as $m)
                                <option value="{{ $m->id_metodo_pago }}">
                                    {{ $m->nom_metodo_pago }}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="">Porcentaje IVA</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img src="https://img.icons8.com/material/20/000000/percentage--v1.png" />
                                </span>
                                <input type="number" class="form-control" name="iva" id="piva" placeholder="0">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Valor IVA</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" id="iva" name="valor_iva" placeholder='0.00' class="form-control" readonly />
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Porcentaje descuento</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <img src="https://img.icons8.com/material/20/000000/percentage--v1.png" />
                                </span>
                                <input type="number" id="pdescuento" name="descuento" placeholder='0' class="form-control" />
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Valor descuento</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" id="vdescuento" placeholder='0' class="form-control" readonly />
                            </div>
                        </div>

                        <br>
                        <br>
                        <div class="form-group">
                            <label for="">Debe</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="text" class="form-control" id="deuda" name="devuelto" placeholder="0.00" readonly>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Subtotal</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" class="form-control" name="subtotal" id="sub_total" placeholder="0.00" readonly>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Total sin descuento</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" name="total_sin_descuento" id="tdescuento" placeholder='0.00' class="form-control" readonly />
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="">Monto total</label>
                            <div class="input-group-prepend">
                                <span class="input-group-text">
                                    <i class="material-icons">attach_money</i>
                                </span>
                                <input type="number" placeholder='0.00' name="precio_total" class="form-control" id="total" readonly>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <!--Lista de productos -->

            <div class="col-md-8">

                <div class="card">
                    <div class="card-header card-header-primary ">
                        <h4 class="card-title">Lista de productos </h4>
                        <p class="category"></p>
                    </div>
                    <div class="card-body">
                        <!--Inicio Body-->
                        <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                        @csrf
                        <div class="table-responsive">
                            <table class="table" id="products_table">
                                <thead>
                                    <tr>
                                        <th>Producto</th>
                                        <th>Precio</th>
                                        <th>Cantidad</th>
                                        <th>Total</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr id="product0">
                                        <td>
                                            <select name="products[]" data-live-search="true" data-container="body" form="form_venta" class="form-control  selectpicker product">
                                                <option value="">-- Elegir producto --</option>
                                                @foreach ($products as $product)
                                                <option value="{{ $product->id_producto }}" precio_venta="{{$product->precio_venta}}">
                                                    {{ $product->nombre }} (${{ number_format($product->precio_venta, 2) }})
                                                </option>

                                                @endforeach
                                            </select>
                                        </td>
                                        <td>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">attach_money</i>
                                                </span>
                                                <input type="number" name="precio[]" id="precioP" class="form-control  precio" readonly />
                                            </div>

                                        </td>
                                        <td>
                                            <input type="number" name="cantidad[]" class="form-control cantidad" value="0" min="0" />
                                        </td>
                                        <td>
                                            <div class="input-group-prepend">
                                                <span class="input-group-text">
                                                    <i class="material-icons">attach_money</i>
                                                </span>
                                                <input type="number" name="total[]" class="form-control total" readonly />
                                            </div>

                                        </td>
                                    </tr>
                                    <tr id="product1"></tr>
                                </tbody>
                            </table>
                        </div>


                        <div class="col-md-12">

                            <div class="row">
                                <div class="col-md-12">
                                    <button type="" id="add_row" class="btn btn-primary float-right"><i class="material-icons">add</i>Agregar</button>
                                    <button type="" id="delete_row" class="btn btn-primary float-right"><i class="material-icons">delete</i>Eliminar</button>
                                    <!--<button type="button" class="btn btn-primary float-right" data-toggle="modal" id="imprimir" data-target="#"><i class="material-icons">print</i>Imprimir </button>-->
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-title">Cliente</div>
                                </div>
                                <div class="col-md-12 lista">
                                    <div class="form-group">
                                        <select class="form-control selectpicker selec_cliente" id="aaa" name="id_documento" data-live-search="true">

                                            @include('ventas.Listaclientes')
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"><button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#InsertCliente"><i class="material-icons">add</i>Agregar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="form-group"><button type="submit" class="btn btn-primary btn-lg button-submit-limitV " value="{{trans('global.save')}}">Realizar venta</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

    </form>
</div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header card-header-primary">
                <h4 class="card-title">Lista de ventas</h4>

            </div>
            <div class="card-body">
                @if($ventas->isEmpty())
                <div class="col-xs-12 col-md-12 error404 text center">
                    <h1>

                        <small>¡Oops!</small>

                    </h1>
                    <h2>Aun no se han realizado ventas</h2>
                </div>
                @else
                <div class="table-responsive">
                    <table class="table table-shopping">
                        <thead class=" text-primary">
                            <th>
                                ID
                            </th>
                            <th>
                                Documento cliente
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th class="text-left">
                                Apellido
                            </th>
                            <th>
                                Productos
                            </th>
                            <th class="text-right">
                                Actions
                            </th>
                        </thead>

                        <!--Imprimiendo lista de productos-->
                        <tbody>
                            @foreach($ventas as $v)
                            <tr>

                                <td>
                                    {{$v->id_venta}}
                                </td>
                                <td>
                                    {{$v->id_documento}}
                                </td>

                                <td>
                                    @foreach($clientes as $item)
                                    @if($v->id_documento == $item->id_documento)
                                    {{$item->nombres}}
                                    @endif
                                    @endforeach
                                </td>


                                <td>
                                    @foreach($clientes as $item)
                                    @if($v->id_documento == $item->id_documento)
                                    {{$item->apellidos}}
                                    @endif
                                    @endforeach
                                </td>




                                <td>
                                    @foreach($v->products as $item)
                                    <li>{{ $item->nombre }} c/u ${{ $item->precio_venta }} (x{{ $item->pivot->cantidad}} ${{ $item->pivot->total_p_producto }})</li>
                                    @endforeach

                                </td>
                                <!-- Botones de crud para modal -->
                                <td class="td-actions text-right">
                                    <!--Descargar excel-->
                                    <button type="button" data-toggle="modal" class="btn btn-black" data-id_venta="{{$v->id_venta}}" data-target="#ExcelVenta" rel="tooltip">
                                        <img src="https://img.icons8.com/color/19/000000/export-excel.png" />
                                    </button>
                                    <!--Descargar pdf-->
                                    <button type="button" data-toggle="modal" class="btn btn-black" data-id_venta="{{$v->id_venta}}" data-target="#PdfVenta" rel="tooltip">
                                        <img src="https://img.icons8.com/color/19/000000/pdf-2.png" />
                                    </button>
                                    <!--Ver-->
                                    <button type="button" data-toggle="modal" class="btn btn-jei" data-id_venta="{{$v->id_venta}}" data-id_documento="{{$v->id_documento}}" data-fecha="{{$v->fecha_factura}}" data-id_metodo_pago="{{$v->id_metodo_pago}}" data-precio_total="{{$v->precio_total}}" data-subtotal="{{$v->subtotal}}" data-pagado="{{$v->pagado}}" data-descuento="{{$v->descuento}}" data-devuelto="{{$v->devuelto}}" data-total_sin_descuento="{{$v->total_sin_descuento}}" data-iva="{{$v->iva}}" data-target="#VerVenta" rel="tooltip">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                    <!--Editar-->
                                    <button type="button" data-toggle="modal" data-id_venta="{{$v->id_venta}}" data-id_documento="{{$v->id_documento}}" data-fecha="{{$v->fecha_factura}}" data-id_metodo_pago="{{$v->id_metodo_pago}}" data-precio_total="{{$v->precio_total}}" data-subtotal="{{$v->subtotal}}" data-pagado="{{$v->pagado}}" data-descuento="{{$v->descuento}}" data-devuelto="{{$v->devuelto}}" data-total_sin_descuento="{{$v->total_sin_descuento}}" data-iva="{{$v->iva}}" data-target="#EditVenta" rel="tooltip" class="btn btn-jei">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    <!--Eliminar-->
                                    <button type="button" rel="tooltip" class="btn btn-jei" data-id_venta="{{$v->id_venta}}" data-toggle="modal" data-target="#EliminarVenta">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>


                            </tr>

                            @endforeach

                        </tbody>



                    </table>
                    {{$ventas}}
                </div>
                @endif
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal excel venta-->
<div class="modal fade" id="ExcelVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Descargar Excel</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{action('VentaController@descargaExcel','id_venta')}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="id_venta" name="id_venta">
                    <p class="text-center">¿Estas seguro de descargar en EXCEL?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Descargar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal pdf venta-->
<div class="modal fade" id="PdfVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Descargar PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{action('VentaController@descargaPDF','id_venta')}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="id_venta" name="id_venta">
                    <p class="text-center">¿Estas seguro de descargar en PDF?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Descargar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal agregar cliente-->
<div class="modal fade" id="InsertCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit">
                    @csrf
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                    <div class="form-group">
                        <label>N° documento</label>
                        <input type="text" name="id_documento" class="form-control" id="id_documento" placeholder="">
                    </div>
                    <div class="form-group ">
                        <label for="exampleFormControlSelect1">Tipo de documento</label>
                        <select class="form-control" name="id_tipo_documento" id="id_tipo_documento">
                            <option value="">Seleccionar tipo...</option>
                            @foreach($tipos as $t)
                            <option value="{{$t->id_tipo_documento}}">{{$t->nom_tipo_documento}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" id="apellido" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" id="correo" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" id="direccion" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="telefono" id="telefono" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Celular</label>
                        <input type="number" name="celular" id="celular" class="form-control" placeholder="">
                    </div>
                    <div class="form-group">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha" id="fecha" class="form-control" placeholder="">
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary gcliente button-submit-limit">Guardar</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal eliminar venta-->
<div class="modal fade" id="EliminarVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{route('venta.destroy','id_venta')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_venta" name="id_venta">
                    <p class="text-center">¿Estas seguro de eliminar la venta??</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Eliminar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal Editar venta-->
<div class="modal fade" id="EditVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Editar venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" method="POST" action="{{route('venta.update','id_venta')}}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id_venta" name="id_venta">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Documento cliente</label>
                            <input type="text" name="id_documento" id="id_documento" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label>Fecha factura</label>
                            <input type="datetime" name="fecha_factura" id="fecha_factura" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label>Metodo de pago</label>
                            <select class="form-control selectpicker" name="id_metodo_pago" id="id_metodo_pago">
                                <option value="">No tiene metodo de pago registrado</option>
                                @foreach ($metodos as $m)
                                <option value="{{ $m->id_metodo_pago }}">
                                    {{ $m->nom_metodo_pago }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                            <label>Porcentaje IVA</label>
                            <input type="number" name="iva" id="iva" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Subtotal</label>
                            <input type="number" name="subtotal" id="subtotal" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label>Devuelto</label>
                            <input type="number" name="devuelto" id="devuelto" class="form-control">
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Porcentaje descuento</label>
                            <input type="number" name="descuento" id="descuento" class="form-control">
                        </div>
                        <div class="form-group col">
                            <label>Total sin descuento</label>
                            <input type="number" name="total_sin descuento" id="total_sin_descuento" class="form-control">
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Total</label>
                            <input type="number" name="precio_total" id="precio_total" class="form-control">
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Productos</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                    </div>



                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit">Actualizar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<!-- Modal Ver venta-->
<div class="modal fade" id="VerVenta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Ver venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form method="GET" action="{{route('venta.update','id_venta')}}">
                    @csrf
                    <input type="hidden" id="id_venta" name="id_venta">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Documento cliente</label>
                            <input type="text" name="id_documento" id="id_documento" class="form-control" disabled>
                        </div>
                        <div class="form-group col">
                            <label>Fecha factura</label>
                            <input type="datetime" name="fecha_factura" id="fecha_factura" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Metodo de pago</label>
                            <select class="form-control selectpicker" name="id_metodo_pago" id="id_metodo_pago" disabled>
                                <option value="">No tiene metodo de pago registrado</option>
                                @foreach ($metodos as $m)
                                <option value="{{ $m->id_metodo_pago }}">
                                    {{ $m->nom_metodo_pago }}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group col">
                            <label>Porcentaje IVA</label>
                            <input type="number" name="iva" id="iva" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Subtotal</label>
                            <input type="number" name="subtotal" id="subtotal" class="form-control" disabled>
                        </div>
                        <div class="form-group col">
                            <label>Devuelto</label>
                            <input type="number" name="devuelto" id="devuelto" class="form-control" disabled>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Porcentaje descuento</label>
                            <input type="number" name="descuento" id="descuento" class="form-control" disabled>
                        </div>
                        <div class="form-group col">
                            <label>Total sin descuento</label>
                            <input type="number" name="total_sin descuento" id="total_sin_descuento" class="form-control" disabled>
                        </div>
                    </div>
                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label>Total</label>
                            <input type="number" name="precio_total" id="precio_total" class="form-control" disabled>
                        </div>
                    </div>



                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Productos</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                    </div>


                </form>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-dismiss="modal">Salir</button>
                </div>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
    function limpiar() {
        $("#id_documento").val("")
        $("#id_tipo_documento").val("");
        $("#nombre").val("");
        $("#apellido").val("");
        $("#correo").val("");
        $("#direccion").val("");
        $("#telefono").val("");
        $("#celular").val("");
        $("#fecha").val("");


    }


    $(".gcliente").click(function(event) {
        event.preventDefault();
        let documento = $("input[name=id_documento]").val();
        let tipo_documento = $("select[name=id_tipo_documento]").val();
        let nombre = $("input[name=nombre]").val();
        let apellido = $("input[name=apellido]").val();
        let correo = $("input[name=correo]").val();
        let direccion = $("input[name=direccion]").val();
        let telefono = $("input[name=telefono]").val();
        let celular = $("input[name=celular]").val();
        let id_user = $("input[name=id_user]").val();
        let fecha = $("input[name=fecha]").val();

        let _token = $('meta[name="csrf-token"]').attr('content');



        $.ajax({
            url: "{{route('clienteD')}}",
            type: "POST",
            data: {
                id_documento: documento,
                id_tipo_documento: tipo_documento,
                nombres: nombre,
                apellidos: apellido,
                correo: correo,
                direccion: direccion,
                telefono: telefono,
                celular: celular,
                fecha_nacimiento: fecha,
                id_user: id_user,
                _token: _token
            },
            dataType: 'json',


            success: function(data) {

                if (data.error) {
                    var values = '';

                    jQuery.each(data.error, function(key, value) {
                        values += value + "<br>"
                    });
                    console.log(values);
                    swal({
                        title: "Ocurrio un error",
                        html: values,
                        timer: 3000,
                        showConfirmButton: false,
                        type: "error"
                    })
                } else if (!data.error) {
                    limpiar();
                    $('#aaa').empty().append(data.html);
                    $('select').selectpicker('refresh');
                     //ALERTAR SUAVE REGISTRO CORRECTO 
                    Swal.fire({

                        type: 'success',
                        title: 'Cliente registrado correctamente',
                        showConfirmButton: false,
                        timer: 1500,

                    })
                    
                    
                    $('#InsertCliente').modal('hide');     
                }

                
                /*limpiar();

                $('#aaa').empty().append(data);
                $('#InsertCliente').modal('hide');
                $('select').selectpicker('refresh');*/

                //ALERTAR SUAVE REGISTRO CORRECTO 
                /*Swal.fire({

                    type: 'success',
                    title: 'Cliente registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500,

                })*/
                
            },
            error: function(data) {
                //ALERTAR SUAVE ERROR
                Swal.fire({

                    type: 'error',
                    title: 'Hubo un error al registrar',
                    showConfirmButton: false,
                    timer: 1500,

                })

            },
        });
    });
</script>
@endsection
@section('titulo','Ventas')