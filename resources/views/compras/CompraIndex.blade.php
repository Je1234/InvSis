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


    <form action="{{ route('compra.store')}}" class="form-submit-limitC" id="form_compra" method="POST">
        <div class="row">
            <div class="col-md-4">

                <div class="card">
                    <div class="card-header card-header-primary">
                        <h4 class="card-title">Compras</h4>

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
                                            <select name="products[]" data-live-search="true" data-container="body" id="product" class="form-control  selectpicker product">
                                                @include('compras.ListaProductos')
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
                                    <button type="button" class="btn btn-primary float-right" data-toggle="modal" id="imprimir" data-target="#InsertProduct"><i class="material-icons">add</i>Agregar producto </button>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-12">
                                    <div class="card-title">Proveedor

                                    </div>
                                </div>
                                <div class="col-md-12 lista">
                                    <div class="form-group">
                                        <select class="form-control selectpicker " id="provlist" name="id_proveedor" data-live-search="true">

                                            @include('compras.ListaProveedores')
                                        </select>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group"><button type="button" class="btn btn-primary float-right" data-toggle="modal" data-target="#InsertProv"><i class="material-icons">add</i>Agregar</button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-md-12 text-center">
                                            <div class="form-group"><button type="submit" class="btn btn-primary btn-lg button-submit-limitC" value="{{trans('global.save')}}">Realizar compra</button>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </form>
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Lista de compras</h4>

                </div>
                <div class="card-body">
                    @if($compra->isEmpty())
                    <div class="col-xs-12 col-md-12 error404 text center">
                        <h1>

                            <small>¡Oops!</small>

                        </h1>
                        <h2>Aun no se han realizado compras</h2>
                    </div>
                    @else
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <thead class="text-primary">
                                <th>
                                    ID
                                </th>

                                <th>
                                    Proveedor
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
                                @foreach($compra as $c)
                                <tr>

                                    <td>
                                        {{$c->id_compra}}
                                    </td>


                                    <td>
                                        @foreach($proveedores as $item)
                                        @if($c->id_proveedor == $item->id_proveedor)
                                        {{$item->nombre}}
                                        @endif
                                        @endforeach
                                    </td>
                                    <td>
                                        @foreach($c->relacion as $item)
                                        <li>{{ $item->nombre }} c/u ${{ $item->precio_venta }} (x{{ $item->pivot->cantidad}} ${{ $item->pivot->total_p_producto }})</li>
                                        @endforeach

                                    </td>
                                    <!-- Botones de crud para modal -->
                                    <td class="td-actions text-right">
                                        <button type="button" data-toggle="modal" class="btn btn-black" data-id_compra="{{$c->id_compra}}" data-target="#ExcelCompra" rel="tooltip">
                                            <img src="https://img.icons8.com/color/19/000000/export-excel.png" />
                                        </button>
                                        <button type="button" data-toggle="modal" class="btn btn-black" data-id_compra="{{$c->id_compra}}" data-target="#PdfCompra" rel="tooltip">
                                            <img src="https://img.icons8.com/color/19/000000/pdf-2.png" />
                                        </button>
                                        <!-- Ver-->
                                        <button type="button" data-toggle="modal" class="btn btn-jei" data-id_compra="{{$c->id_compra}}" data-id_proveedor="{{$c->id_proveedor}}" data-fecha="{{$c->fecha_factura}}" data-id_metodo_pago="{{$c->id_metodo_pago}}" data-precio_total="{{$c->precio_total}}" data-subtotal="{{$c->subtotal}}" data-pagado="{{$c->pagado}}" data-descuento="{{$c->descuento}}" data-devuelto="{{$c->devuelto}}" data-total_sin_descuento="{{$c->total_sin_descuento}}" data-iva="{{$c->iva}}" data-target="#VerCompra" rel="tooltip">
                                            <i class="material-icons">visibility</i>
                                        </button>

                                        <button type="button" data-toggle="modal" data-target="#EditCompra" rel="tooltip" class="btn btn-jei" data-id_compra="{{$c->id_compra}}" data-id_proveedor="{{$c->id_proveedor}}" data-fecha="{{$c->fecha_factura}}" data-id_metodo_pago="{{$c->id_metodo_pago}}" data-precio_total="{{$c->precio_total}}" data-subtotal="{{$c->subtotal}}" data-pagado="{{$c->pagado}}" data-descuento="{{$c->descuento}}" data-devuelto="{{$c->devuelto}}" data-total_sin_descuento="{{$c->total_sin_descuento}}" data-iva="{{$c->iva}}">
                                            <i class="material-icons">edit</i>
                                        </button>

                                        <button type="button" rel="tooltip" class="btn btn-jei" data-id_compra="{{$c->id_compra}}" data-toggle="modal" data-target="#EliminarCompra">
                                            <i class="material-icons">close</i>
                                        </button>

                                    </td>


                                </tr>

                                @endforeach

                            </tbody>



                        </table>
                        {{$compra}}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!-- Modal eliminar compra-->
<div class="modal fade" id="EliminarCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form action="{{route('compra.destroy','id_compra')}}" class="form-submit-limit" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_compra" name="id_compra">
                    <p class="text-center">¿Estas seguro de eliminar la compra??</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Eliminar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal excel compra-->
<div class="modal fade" id="ExcelCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                <form class="form-submit-limit" action="{{action('CompraController@descargaExcel','id_compra')}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="id_compra" name="id_compra">
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

<!-- Modal pdf compra-->
<div class="modal fade" id="PdfCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Descargar PDF</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{action('CompraController@descargaPDF','id_compra')}}">
                    @csrf
                    @method('POST')
                    <input type="hidden" id="id_compra" name="id_compra">
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

<!-- Modal Editar compra-->
<div class="modal fade" id="EditCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Editar compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form method="POST" class="form-submit-limit" action="{{route('venta.update','id_venta')}}">
                    @method('PUT')
                    @csrf
                    <input type="hidden" id="id_compra" name="id_compra">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Proveedor</label>
                            <select class="form-control selectpicker " id="id_proveedorVC" name="id_proveedor" data-live-search="true">
                                <option value="">No tiene proveedor registrado</option>
                                @foreach ($proveedores as $p)
                                <option value="{{ $p->id_proveedor}}">
                                    {{ $p->nombre }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col">
                            <label>Metodo de pago</label>
                            <select name="id_metodo_pago" data-live-search="true" data-container="body" form="form_venta" id="id_metodo_pago" class="form-control  selectpicker product">
                                <option value="">No tiene metodo de pago registrado</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id_producto }}" precio_venta="{{$product->precio_venta}}">
                                    {{ $product->nombre }} (${{ number_format($product->precio_venta, 2) }})
                                </option>

                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Fecha factura</label>
                            <input type="datetime" name="fecha_factura" id="fecha_factura" class="form-control">
                        </div>
                        <div class="form-group col">
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
                        <textarea class="form-control" id="descripcion" name="descripcionC" rows="3"></textarea>
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

<!-- Modal Ver compra-->
<div class="modal fade" id="VerCompra" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header modal-header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Ver compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form>
                    @csrf
                    <input type="hidden" id="id_compra" name="id_compra">
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Proveedor</label>
                            <select class="form-control selectpicker " id="id_proveedorVC" name="id_proveedor" data-live-search="true" disabled>
                                <option value="">No tiene proveedor registrado</option>
                                @foreach ($proveedores as $p)
                                <option value="{{ $p->id_proveedor}}">
                                    {{ $p->nombre }}
                                </option>
                                @endforeach
                            </select>

                        </div>
                        <div class="form-group col">
                            <label>Metodo de pago</label>
                            <select name="id_metodo_pago" data-live-search="true" data-container="body" form="form_venta" id="id_metodo_pago" class="form-control  selectpicker product" disabled>
                                <option value="">No tiene metodo de pago registrado</option>
                                @foreach ($products as $product)
                                <option value="{{ $product->id_producto }}" precio_venta="{{$product->precio_venta}}">
                                    {{ $product->nombre }} (${{ number_format($product->precio_venta, 2) }})
                                </option>

                                @endforeach
                            </select>
                        </div>

                    </div>
                    <div class="form-row">
                        <div class="form-group col">
                            <label>Fecha factura</label>
                            <input type="datetime" name="fecha_factura" id="fecha_factura" class="form-control" disabled>
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
                        <textarea class="form-control" id="descripcionC" name="descripcion" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
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


<!-- Modal agregar producto-->
<div class="modal fade" id="InsertProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-scrollable" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Precio venta</label>
                        <input type="number" name="precio_venta" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Precio compra</label>
                        <input type="number" name="precio_compra" class="form-control">
                    </div>
                    <!--<div class="form-group">
                        <label>Cantidad en stock</label>
                        <input type="number" name="stock" class="form-control">
                    </div>-->
                    <div class="form-group">
                        <label>Marca</label>
                        <input type="texts" name="marca" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Proveedor</label>
                        <select class="form-control" name="id_proveedorC" id="id_proveedorC">
                            <option value="">Seleccionar proveedor...</option>
                            @foreach($proveedores as $pro)
                            <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control" name="id_categoria" id="exampleFormControlSelect1">
                            <option value="">Seleccionar categoria...</option>
                            @foreach($categoria as $c)
                            <option value="{{$c->id_categoria}}">{{$c->nom_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">

                        <a href="{{route('categorias')}}" class=" col-md-12 btn btn-primary" role="button" aria-disabled="true">Agregar categoria</a>
                        </a>
                    </div>
                    <div class="form-group">
                        <label for="">Ubicacion bodega</label>
                        <select class="form-control" name="id_ubicacion">
                            <option value="">Seleccione aqui...</option>
                            @foreach($ubicacion as $u)
                            <option value="{{$u->id_ubicacion}}">{{$u->nombre_bodega}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">

                        <a href="#" class=" col-md-12 btn btn-primary " role="button" aria-disabled="true">Agregar bodega</a>
                        </a>
                    </div>
                    <div class="custom-file form-file-upload form-file-multiple">
                        <input type="file" name="ruta_imagen" class="custom-file-input inputFileHidden " id="imagen">
                        <label class="custom-file-label" for="customFile">Escoger imagen de producto</label>
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" name="descripcionP" id="descripcionP" rows="3"></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="button-submit-limit btn btn-primary gproducto ">Guardar</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<!--Modal Agregar proveedor-->
<div class="modal fade" id="InsertProv" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar proveedor</h5>
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
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control" id="direccion">
                    </div>
                    <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="telefono" class="form-control" id="telefono">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Estado</label>
                        <select class="form-control selecpicker" name="estado" id="estado">
                            <option value="">Seleccionar una opcion...</option>
                            <option value="1">Disponible</option>
                            <option value="0">No disponible</option>

                        </select>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary gproveedor button-submit-limit">Guardar</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>


<script>
    function limpiar() {
        $("#nombre").val("")
        $("#direccion").val("");
        $("#telefono").val("");
        $("#estado").val("");

    }


    $(".gproveedor").click(function(event) {
        event.preventDefault();
        let nombre = $('#nombre').val();
        let direccion = $("input[name=direccion]").val();
        let telefono = $("input[name=telefono]").val();
        let estado = $("select[name=estado]").val();
        let id_user = $("input[name=id_user]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');



        $.ajax({
            url: "{{route('ProveedorC')}}",
            type: "POST",
            data: {
                nombre: nombre,
                direccion: direccion,
                telefono: estado,
                estado: estado,
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
                    $('#provlist').empty().append(data.html);
                    $('select').selectpicker('refresh');
                    //ALERTAR SUAVE REGISTRO CORRECTO 
                    Swal.fire({

                        type: 'success',
                        title: 'Proveedor registrado correctamente',
                        showConfirmButton: false,
                        timer: 1500,

                    })


                    $('#InsertProv').modal('hide');
                }


            },
            error: function(data) {

                Swal.fire({

                    type: 'error',
                    title: 'Hubo un error al registrar ',
                    showConfirmButton: false,
                    timer: 1500,

                })

            },
        });
    });


    $(".gproducto").click(function(event) {
        event.preventDefault();
        let nombre = $("input[name=nombre]").val();
        let precio_venta = $("input[name=precio_venta]").val();
        let precio_compra = $("input[name=precio_compra]").val();
        let stock = $("input[name=stock]").val();
        let marca = $("input[name=marca]").val();
        let id_proveedor = $("select[name=id_proveedor]").val();
        let id_categoria = $("select[name=id_categoria]").val();
        let id_ubicacion = $("select[name=id_ubicacion]").val();
        let ruta_imagen = $("input[name=ruta_imagen]").val();
        let descripcion = $("input[name=descripcionP]").val();
        let id_user = $("input[name=id_user]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');

        var gp = new FormData();
        gp.append('ruta_imagen', $("#imagen").get(0).files[0]);
        gp.append('nombre', nombre);
        gp.append('precio_venta', precio_venta);
        gp.append('precio_compra', precio_compra);
        gp.append('stock', stock);
        gp.append('marca', marca);
        gp.append('id_proveedor', id_proveedor);
        gp.append('id_categoria', id_categoria);
        gp.append('id_ubicacion', id_ubicacion);
        gp.append('descripcion', descripcion);
        gp.append('id_user', id_user);
        gp.append('_token', _token);



        $.ajax({
            url: "{{route('ProductoC')}}",
            type: "POST",
            data: gp,
            dataType: 'json',
            processData: false,
            contentType: false,

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
                    $('#product').empty().append(data.html);
                    $('select').selectpicker('refresh');
                    //ALERTAR SUAVE REGISTRO CORRECTO 
                    Swal.fire({

                        type: 'success',
                        title: 'Producto registrado correctamente',
                        showConfirmButton: false,
                        timer: 1500,

                    })


                    $('#InsertProduct').modal('hide');
                }

                /*limpiar();
                $('#InsertProduct').modal('hide');
                $('#product').empty().append(data);
                $('select').selectpicker('refresh');
                Swal.fire({

                    type: 'success',
                    title: 'Producto registrado correctamente',
                    showConfirmButton: false,
                    timer: 1500,

                })*/

            },
            error: function(data) {

                Swal.fire({

                    type: 'error',
                    title: 'Hubo un error al registrar ',
                    showConfirmButton: false,
                    timer: 1500,

                })

            },
        });
    });
</script>
@endsection
@section('titulo','Compras')