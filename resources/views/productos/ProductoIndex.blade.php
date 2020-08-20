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
          <h4 class="card-title">Lista de productos</h4>
          <div class="form-check form-check-inline float-right">

            <button type="" class="btn btn-black" data-toggle="modal" data-target="#InsertProduct"><i class="material-icons">add</i>Agregar </button>

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

              <a type="button" href="{{route('productos')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

            </div>
          </div>

          @elseif(($productoB))

          <form class=" form-inline">

            <div class="input-group col-md-1  ">

              <select class="form-control " name="tipo"  id="">
                <option value="">Filtrar por</option>
                <option>Nombre</option>
                <option>Marca</option>
                <option>Categoria</option>
                <option>Precio_venta</option>
                <option>Precio_compra</option>
                <option>stock</option>
              </select>
            </div>

            <div class="input-group col-md-12">

              <input name="buscarPor" type="search" value="" class="form-control" aria-label="search" placeholder="Buscar...">
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
              <thead class=" text-primary">
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
               
                @foreach( $productoB as $productI)
               
                <tr>
                  <td>
                    {{$productI->id_producto}}
                  </td>
                  <td>
                    <div class="img-container">
                      <img src="../storage/app/public/uploads/{{$productI->ruta_imagen}}" rel="nofollow" style="width:100px;height:150" rel="nofollow" alt="...">
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
                    <!-- Ver-->
                    <a data-id_producto="{{$productI->id_producto}}" data-id_proveedor="{{$productI->id_proveedor}}" data-id_ubicacion="{{$productI->id_ubicacion}}" data-nombre="{{$productI->nombre}}" data-marca="{{$productI->marca}}" data-precio_venta="{{$productI->precio_venta}}" data-precio_compra="{{$productI->precio_compra}}" data-id_categoria="{{$productI->id_categoria}}" data-stock="{{$productI->stock}}" data-descripcion="{{$productI->descripcion}}" data-ruta_imagen="{{$productI->ruta_imagen}}" data-toggle="modal" data-target="#VerProduct" rel="tooltip" class="btn btn-jei">
                      <i class="material-icons">visibility</i>
                    </a>
                    <!-- Editar -->
                    <a data-id_producto="{{$productI->id_producto}}" data-id_proveedor="{{$productI->id_proveedor}}" data-id_ubicacion="{{$productI->id_ubicacion}}" data-nombre="{{$productI->nombre}}" data-marca="{{$productI->marca}}" data-precio_venta="{{$productI->precio_venta}}" data-precio_compra="{{$productI->precio_compra}}" data-id_categoria="{{$productI->id_categoria}}" data-stock="{{$productI->stock}}" data-descripcion="{{$productI->descripcion}}" data-ruta_imagen="{{$productI->ruta_imagen}}" data-toggle="modal" data-target="#EditProduct" rel="tooltip" class="btn btn-jei">
                      <i class="material-icons">edit</i>
                    </a>
                    <!-- Eliminar -->
                    <a rel="tooltip" class="btn btn-jei" data-id_producto="{{$productI->id_producto}}" data-toggle="modal" data- data-target="#EliminarProduct">
                      <i class="material-icons">close</i>
                    </a>
                  </td>
                </tr>
                
                @endforeach

              </tbody>



            </table>


            <!-- Paginador -->
            {{$productoB}}


            @endif


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
                    <form method="POST" class="form-submit-limit" action="{{route('producto.store')}}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label>Precio venta</label>
                        <input type="number" name="precio_venta" class="form-control">
                        
                      </div>
                      <div class="form-group">
                        <label>Precio compra</label>
                        <input type="number" name="precio_compra" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Cantidad en stock</label>
                        <input type="number" name="stock" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Marca</label>
                        <input type="texts" name="marca" class="form-control" >
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Proveedor</label>
                        <select class="form-control" name="id_proveedor"  id="id_proveedor">
                          <option value="">Seleccionar proveedor...</option>
                          @foreach($proveedor as $pro)
                          <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <a href="{{route('proveedor')}}" class=" col-md-12 btn btn-primary " role="button" aria-disabled="true">Agregar proveedor</a>
                        </a>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control" name="id_categoria"  id="exampleFormControlSelect1">
                          <option value="">Seleccionar categoria...</option>
                          @foreach($categoria as $c)
                          <option value="{{$c->id_categoria}}">{{$c->nom_categoria}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">

                        <a href="{{route('categorias')}}" class=" col-md-12 btn btn-primary " role="button" aria-disabled="true">Agregar categoria</a>
                        </a>
                      </div>
                      <div class="form-group">
                        <label for="">Ubicacion bodega</label>
                        <select class="form-control" name="id_ubicacion"  id="">
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
                        <input type="file" name="imagen" class="custom-file-input inputFileHidden " id="customFile">
                        <label class="custom-file-label" for="customFile">Escoger imagen de producto</label>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" name="descripcion" id="exampleFormControlTextarea1" rows="3"></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit">Guardar</button>
                      </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal editar producto-->
            <div class="modal fade" id="EditProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form method="POST" class="form-submit-limit" action="{{route('producto.update','id_producto')}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" id="id_producto" name="id_producto">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Precio venta</label>
                        <input type="number" name="precio_venta" id="precio_venta" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Precio compra</label>
                        <input type="number" name="precio_compra" id="precio_compra" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Cantidad en stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label>Marca</label>
                        <input type="texts" name="marca" id="marca" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Proveedor</label>
                        <select class="form-control " name="id_proveedor"  id="id_proveedor">
                          <option value="">Seleccionar proveedor...</option>
                          @foreach($proveedor as $pro)
                          <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control " id="id_categoria" name="id_categoria" >
                          <option value="">Seleccionar categoria...</option>
                          <!-- Seleccion dinamica de categoria -->
                          @foreach($categoria as $c)
                          <option value="{{$c->id_categoria}}">{{$c->nom_categoria}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Ubicacion bodega</label>
                        <select class="form-control" id="id_ubicacion" name="id_ubicacion"  id="">
                          <option value="">Seleccione aqui...</option>
                          @foreach($ubicacion as $u)
                          <option value="{{$u->id_ubicacion}}">{{$u->nombre_bodega}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="custom-file form-file-upload form-file-multiple">
                        <input type="file" name="imagen" id="imagen" class="custom-file-input inputFileHidden " id="customFile">
                        <label class="custom-file-label" for="customFile">Escoger imagen de producto</label>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
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


            <!-- Modal ver producto-->
            <div class="modal fade" id="VerProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form method="GET" action="{{route('producto.update','id_producto')}}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" id="id_producto" name="id_producto">
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="form-control" disabled>
                      </div>
                      <div class="form-group">
                        <label>Precio venta</label>
                        <input type="number" name="precio_venta" id="precio_venta" class="form-control"  disabled>
                      </div>
                      <div class="form-group">
                        <label>Precio compra</label>
                        <input type="number" name="precio_compra" id="precio_compra" class="form-control"  disabled>
                      </div>
                      <div class="form-group">
                        <label>Cantidad en stock</label>
                        <input type="number" name="stock" id="stock" class="form-control"  disabled>
                      </div>
                      <div class="form-group">
                        <label>Marca</label>
                        <input type="texts" name="marca" id="marca" class="form-control"  disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Proveedor</label>
                        <select class="form-control" name="id_proveedor"  id="id_proveedor" disabled>
                          <option value="">Seleccionar proveedor...</option>
                          @foreach($proveedor as $pro)
                          <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control" id="id_categoria" name="id_categoria"  disabled>
                          <option>...</option>
                          @foreach($categoria as $c)
                          <option value="{{$c->id_categoria}}">{{$c->nom_categoria}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label for="">Ubicacion bodega</label>
                        <select class="form-control" id="id_ubicacion" name="id_ubicacion"  id="" disabled>
                          <option>...</option>
                          @foreach($ubicacion as $u)
                          <option value="{{$u->id_ubicacion}}">{{$u->nombre_bodega}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="custom-file form-file-upload form-file-multiple">
                        <input type="file" name="imagen" id="imagen" class="custom-file-input inputFileHidden " id="customFile" disabled>
                        <label class="custom-file-label" for="customFile">Escoger imagen de producto</label>
                      </div>

                      <div class="form-group">
                        <label for="exampleFormControlTextarea1">Descripcion</label>
                        <textarea class="form-control" id="descripcion" name="descripcion" id="exampleFormControlTextarea1" rows="3" disabled></textarea>
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Regresar</button>

                      </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal eliminar producto-->
            <div class="modal fade" id="EliminarProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header header-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar producto</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form action="{{route('producto.destroy','id_producto')}}" class="form-submit-limit" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" id="id_producto" name="id_producto">
                      <p class="text-center">¿Estas seguro de eliminar el registro?</p>

                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                    <button type="submit" class="btn btn-primary button-submit-limit">Eliminar</button>

                  </div>
                  </form>
                </div>
              </div>
            </div>

          </div>
        </div>
      </div>
    </div>

    @endsection

    @section('titulo','Productos')