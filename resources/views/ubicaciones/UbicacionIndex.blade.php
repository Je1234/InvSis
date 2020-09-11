@extends('layouts.dashboard')

@section('content')


<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Lista de ubicaciones</h4>
                    <div class="form-check form-check-inline float-right">
                        <div class="btn-toolbar" role="group">
                            <button type="" class="btn btn-black float-right" data-toggle="modal" data-target="#InsertUbicacion"><i class="material-icons">add</i>Agregar </button>

                            <a type="button" href="{{route('IndexRubicacion')}}" class="btn btn-black float-right"><i class="material-icons">restore_from_trash</i>Recuperar borrados</a>

                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <!--Inicio Body-->

                    @if($ubicacion->isEmpty())
                    <div class="col-xs-12 col-md-12 error404 text center">
                        <h1>

                            <small>¡Oops!</small>

                        </h1>
                        <h2>Aun no hay bodegas registradas</h2>
                    </div>
                    @elseif($ubicacionB->isEmpty())
                    <div class="col-xs-12 col-md-12 error404 text center">
                        <h1>

                            <small>¡Oops!</small>

                        </h1>
                        <h2>No se encontraron resultados</h2>
                        <div class="form-check form-check-inline float-right col-md-1">

                            <a type="button" href="{{route('ubicacion')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

                        </div>
                    </div>
                    @elseif(($ubicacionB))
                    <form class="form-group form-inline">

                        <div class="input-group col-md-2">

                            <input name="buscarNom" type="search" value="" class="form-control" aria-label="search" placeholder="Buscar por nombre...">
                            <button type="submit" class="btn btn-primary btn-round btn-just-icon">
                                <i class="material-icons">search</i>
                                <div class="ripple-container"></div>
                            </button>

                        </div>
                        @if(($nombre))
                        <div class=" input-group float-right ">

                            <a type="button" href="{{route('ubicacion')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

                        </div>
                        @endif
                    </form>

                    @php($i=1)

                    @foreach( $ubicacionB as $ub)

                    <div id="accordion" role="tablist">
                        <div class="card card-collapse">
                            <div class="card-header card-header-primary" role="tab" id="heading{{$i}}">
                                <h5 class="mb-0">
                                    <a class="collapsed" data-toggle="collapse" href="#collapse{{$i}}" style="color:white;" aria-expanded="false" aria-controls="collapseTwo">
                                        {{$ub->nombre_bodega}}
                                        <i class="material-icons">keyboard_arrow_down</i>
                                    </a>
                                    <button type="button" class="btn btn-black float-right btn-sm" data-id_ubicacion="{{$ub->id_ubicacion}}" data-nombre_bodega="{{$ub->nombre_bodega}}" data-direccion="{{$ub->direccion}}" data-seccion="{{$ub->seccion}}" data-toggle="modal" data-target="#VerUbicacion" rel="tooltip"><i class="material-icons">visibility</i></button>
                                    <button type="button" class="btn btn-black float-right btn-sm" data-id_ubicacion="{{$ub->id_ubicacion}}" data-nombre_bodega="{{$ub->nombre_bodega}}" data-direccion="{{$ub->direccion}}" data-seccion="{{$ub->seccion}}" data-toggle="modal" data-target="#EditUbicacion" rel="tooltip"><i class="material-icons">edit</i></button>
                                    <button type="button" class="btn btn-black float-right btn-sm" data-id_ubicacion="{{$ub->id_ubicacion}}" data-toggle="modal" data-target="#EliminarUbicacion" rel="tooltip"><i class="material-icons">close</i></button>
                                </h5>
                            </div>
                            <div id="collapse{{$i}}" class="collapse" role="tabpanel" aria-labelledby="heading{{$i}}" data-parent="#accordion">

                                <div class="card-body table-responsive ">

                                    <table class="table ">
                                        <thead>
                                            <tr>
                                                <th class="text-center">#</th>
                                                <th>Imagen</th>
                                                <th>Nombre</th>
                                                <th>Marca</th>
                                                <th>Stock</th>
                                                <th class="text-right">Precio</th>
                                                <th class="text-right">Actions</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($products as $pro1)
                                            @if($ub->id_ubicacion == $pro1->id_ubicacion)
                                            <tr>
                                                <td class="text-center">1</td>
                                                <td>
                                                    <div class="img-container">
                                                        <img src="../storage/uploads/{{$pro1->ruta_imagen}}" style="width:100px;height:100" rel="nofollow" alt="...">
                                                    </div>
                                                </td>
                                                <td>{{$pro1->nombre}}</td>
                                                <td>{{$pro1->marca}}</td>
                                                <td>{{$pro1->stock}}</td>
                                                <td class="text-right">&dollar; {{$pro1->precio_venta}}</td>
                                                <td class="td-actions text-right">
                                                    <button data-id_producto="{{$pro1->id_producto}}" data-id_proveedor="{{$pro1->id_proveedor}}" data-id_ubicacion="{{$pro1->id_ubicacion}}" data-nombre="{{$pro1->nombre}}" data-marca="{{$pro1->marca}}" data-precio_venta="{{$pro1->precio_venta}}" data-precio_compra="{{$pro1->precio_compra}}" data-id_categoria="{{$pro1->id_categoria}}" data-stock="{{$pro1->stock}}" data-descripcion="{{$pro1->descripcion}}" data-ruta_imagen="{{$pro1->ruta_imagen}}" data-toggle="modal" data-target="#VerProduct" rel="tooltip" class="btn btn-jei">
                                                        <i class="material-icons">visibility</i>
                                                    </button>
                                                </td>
                                            </tr>

                                            @endif

                                            @endforeach


                                        </tbody>

                                    </table>


                                </div>
                            </div>
                        </div>
                    </div>
                    @php($i++)

                    @endforeach

                    {{$ubicacionB}}

                    @endif
                </div>
            </div>
        </div>
    </div>
</div>


<!--Modal Agregar-->
<div class="modal fade" id="InsertUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Insertar bodega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" method="POST" >
                    @csrf
                    @method('POST')
                    <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">

                    <div class="form-group">
                        <label>Nombre bodega</label>
                        <input type="text" name="nombre_bodega" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Seccion</label>
                        <input type="text" name="seccion" class="form-control">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control">
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit gubicacion">Guardar</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<!--Modal Editar-->
<div class="modal fade" id="EditUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Editar bodega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" id="formedit" method="POST" action="{{route('ubicacion.update','id_ubicacion')}}">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id_ubicacion" name="id_ubicacion">
                    <div class="form-group">
                        <label>Nombre bodega</label>
                        <input type="text" name="nombre_bodega" class="form-control" id="nombre_bodega">
                    </div>
                    <div class="form-group">
                        <label>Seccion</label>
                        <input type="text" name="seccion" class="form-control" id="seccion">
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control" id="direccion">
                    </div>
                   
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit editubicacion">Actualizar</button>
                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<!--Modal Ver-->
<div class="modal fade" id="VerUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver bodega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form method="GET" action="{{route('proveedor.update','id_proveedor')}}">
                    @csrf

                    <input type="hidden" id="id_proveedor" name="id_proveedor">
                    <div class="form-group">
                        <label>Nombre bodega</label>
                        <input type="text" name="nombre_bodega" class="form-control" id="nombre_bodega" disabled>
                    </div>
                    <div class="form-group">
                        <label>Seccion</label>
                        <input type="text" name="seccion" class="form-control" id="seccion" disabled>
                    </div>
                    <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" disabled>
                    </div>
                    
                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary" data-dismiss="modal">Regresar</button>
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
                        <input type="number" name="precio_venta" id="precio_venta" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Precio compra</label>
                        <input type="number" name="precio_compra" id="precio_compra" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Cantidad en stock</label>
                        <input type="number" name="stock" id="stock" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label>Marca</label>
                        <input type="texts" name="marca" id="marca" class="form-control" disabled>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Proveedor</label>
                        <select class="form-control" name="id_proveedor" id="id_proveedor" disabled>
                            <option value="">No tiene proveedor registrado</option>
                            @foreach($proveedor as $pro)
                            <option value="{{$pro->id_proveedor}}">{{$pro->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Categoria</label>
                        <select class="form-control" id="id_categoria" name="id_categoria" disabled>
                            <option value="">No tiene categoria registrada</option>
                            @foreach($categoria as $c)
                            <option value="{{$c->id_categoria}}">{{$c->nom_categoria}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Ubicacion bodega</label>
                        <select class="form-control" id="id_ubicacion" name="id_ubicacion" id="" disabled>
                            <option value="">No tiene bodega registrada</option>
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



<!--Modal Eliminar-->
<div class="modal fade" id="EliminarUbicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar bodega</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{route('ubicacion.destroy','id_ubicacion')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id_ubicacion" name="id_ubicacion">
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

<script>
    $(".gubicacion").click(function(e) {
        let nombre_bodega = $("input[name=nombre_bodega]").val();
        let direccion = $("input[name=direccion]").val();
        let seccion = $("input[name=seccion]").val();
        let id_user = $("input[name=id_user]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        $.ajax({
            url: "{{route('ubicacion.store')}}",
            type: "POST",
            data: {
                id_user: id_user,
                nombre_bodega: nombre_bodega,
                direccion: direccion,
                seccion: seccion,
                _token: _token
            },
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
                    $('#InsertUbicacion').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(data) {
                console.log(data);

            }
        });
    });

    $(".editubicacion").click(function(e) {
        e.preventDefault();
        let id_ubicacion = $("#id_ubicacion").val();
        let nombre_bodega = $("#nombre_bodega").val();
        let direccion = $("#direccion").val();
        let seccion = $("#seccion").val();
        let id_user = $("input[name=id_user]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');


        $.ajax({
            url: "{{route('ubicacion.update','id_ubicacion')}}",
            type: 'POST',
            data: {
                id_user: id_user,
                id_ubicacion: id_ubicacion,
                nombre_bodega: nombre_bodega,
                direccion: direccion,
                seccion: seccion,
                _token: _token,
                _method: 'PUT'
            },
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
                    });
                } else if (!data.error) {
                    $('#EditUbicacion').modal('hide');
                    setTimeout(function() {
                        location.reload();
                    }, 1000);
                }
            },
            error: function(data) {
                console.log(data);

            }
        });
    });
</script>


@endsection

@section('titulo','Proveedores')