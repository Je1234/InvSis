@extends('layouts.dashboard')
@section('content')
<form action='{{ route("venta.store") }}' method="POST">
    @csrf

    {{-- ... customer name and email fields --}}

    <div class="card">
        <div class="card-header">
            Products
        </div>

        <div class="card-body">
            <table class="table" id="products_table">
                <thead>
                    <tr>
                        <th>Product</th>
                        <th>Precio</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    <tr id="product0">
                        <td>
                            <select id="sp" name="products[]" class="selectpicker form-control product">
                                <option value="">-- choose product --</option>
                                @foreach ($products as $product)
                                    <option value="{{ $product->id_producto }}" precio_venta="{{ $product->precio_venta }}">
                                        {{ $product->nombre }} (${{ number_format($product->precio_venta, 2) }})
                                    </option>
                                @endforeach
                            </select>
                        </td>
                        <td>
                            <input type="number" name="precio" id="precioP" class="form-control"  />
                        </td>
                        <td>
                            <input type="number" name="cantidad[]" class="form-control" value="1" />
                        </td>
                    </tr>
                    <tr id="product1"></tr>
                </tbody>
            </table>

            <div class="row">
                <div class="col-md-12">
                    <button id="add_row" class="btn btn-default pull-left">+ Add Row</button>
                    <button id='delete_row' class="pull-right btn btn-danger">- Delete Row</button>
                </div>
            </div>
        </div>
    </div>
    <div>
        <input class="btn btn-danger" type="submit" value="{{ trans('global.save') }}">
        <input class="btn btn-danger" type="submit" >
    </div>
</form>

    <!--Segundo row-->

    @endsection
    @section('titulo','Ventas')