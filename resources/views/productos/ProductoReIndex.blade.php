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

  <div class="row">
    <div class="col-md-12">
      <div class="card">

        <div class="card-header card-header-primary">
          <h4 class="card-title">Lista de productos eliminados</h4>
          <div class="form-check form-check-inline float-right">
            <div class="btn-toolbar" role="group" aria-label="Basic example">
              @if(!$productoB->isEmpty())
              <button type="button" data-toggle="modal" data-target="#RecuperarAllProduct" class="btn btn-black col-xs-1"><i class="material-icons">restore_from_trash</i>Recuperar todo</button>
              @endif
              <a type="button" href="{{route('producto.index')}}" class="btn btn-black"><i class="material-icons">reply</i>Regresar a productos</a>

            </div>


          </div>

        </div>
        <div class="card-body">
          <!--Verificar si hay productos-->
          @if($producto->isEmpty())
          <div class="col-xs-12 col-md-12 error404 text center">
            <h1>

              <small>¡Oops!</small>

            </h1>
            <h2>Aun no hay productos registrados</h2>
          </div>
          <!--Verificar si hay busquedas-->
          @elseif($productoB->isEmpty())
          <div class="col-xs-12 col-md-12 error404 text center">
            <h1>

              <small>¡Oops!</small>

            </h1>
            <h2>No se encontraron resultados</h2>
            <div class="form-check form-check-inline float-right col-md-1">

              <a type="button" href="{{route('IndexRproducto')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

            </div>
          </div>

          @elseif(($productoB))

          <form class="form-group form-inline">

            <div class="input-group col-md-2 ">

              <select class="form-control " name="tipo">
                <option value="">Filtrar por</option>
                <option>Nombre</option>
                <option>Marca</option>
                <!--<option value="id_categoria">Categoria</option>-->
                <option value="precio_venta">Precio de venta</option>
                <option value="precio_compra">Precio de compra</option>
                <option>Stock</option>
              </select>
            </div>

            <div class="input-group col-md-2">

              <input name="buscarPor" type="search" value="" class="form-control " aria-label="search" placeholder="Buscar...">
              <button type="submit" class="btn btn-primary btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>

            </div>

          </form>
          @if(($tipo) && ($busqueda))
          <div class="form-check form-check-inline float-right col-md-1">

            <a type="button" href="{{route('productos')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

          </div>
          @endif


          <!--Tabla de productos-->
          <div class="table-responsive">
            <table class="table table-shopping">
              <thead class="text-primary">
                <th>
                  ID
                </th>
                <th>
                  Imagen
                </th>
                <th>
                  Nombre
                </th>
                <th>
                  Marca
                </th>
                <th>
                  Stock
                </th>
                <th>
                  Precio
                </th>
                <th class="text-right">
                  Actions
                </th>
              </thead>
              <!--Imprimiendo lista de productos-->
              <tbody>
                @php($i=1)
                @foreach( $productoB as $productI)

                <tr>
                  <td>
                    {{$i}}
                  </td>
                  <td>
                    <div class="img-container">
                      <img src="../storage/uploads/{{$productI->ruta_imagen}}" rel="nofollow" style="width:100px;height:150" rel="nofollow" alt="...">
                    </div>
                  </td>

                  <td>
                    {{$productI->nombre}}
                  </td>
                  <td>
                    {{$productI->marca}}
                  </td>
                  <td>
                    {{$productI->stock}}
                  </td>
                  <td class="text-primary">
                    ${{$productI->precio_venta}}
                  </td>
                  <!-- Botones de crud para modal -->
                  <td class="td-actions text-right">

                    <!-- Recuperar -->
                    <button rel="tooltip" class="btn btn-jei" data-id_producto="{{$productI->id_producto}}" data-toggle="modal" data- data-target="#RecuperarProduct">
                      <i class="material-icons">reply</i>
                    </button>
                  </td>
                </tr>
                @php($i++)
                @endforeach

              </tbody>



            </table>


            <!-- Paginador -->
            {{$productoB}}


            @endif

          </div>
        </div>
      </div>
    </div>
  </div>
</div>


<!-- Modal recuperar producto-->
<div class="modal fade" id="RecuperarProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar producto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario -->
        <form action="{{route('Rproducto')}}" class="form-submit-limit" method="POST">
          @csrf
          @method('GET')
          <input type="hidden" id="id_producto" name="id_producto">
          <p class="text-center">¿Estas seguro de recuperar el registro?</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary button-submit-limit">Recuperar</button>

      </div>
      </form>
    </div>
  </div>
</div>



<!-- Modal Recuperar todo -->
<div class="modal fade" id="RecuperarAllProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header header-primary">
        <h5 class="modal-title" id="exampleModalLabel">Recuperar todo</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <!-- Formulario -->
        <form action="{{route('RAproducto')}}" class="form-submit-limit" method="POST">
          @csrf
          @method('GET')
          <input type="hidden" id="id_producto" name="id_producto">
          <p class="text-center">¿Estas seguro de recuperar todos los registros?</p>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
        <button type="submit" class="btn btn-primary button-submit-limit">Recuperar</button>

      </div>
      </form>
    </div>
  </div>
</div>
@endsection

@section('titulo','Productos')