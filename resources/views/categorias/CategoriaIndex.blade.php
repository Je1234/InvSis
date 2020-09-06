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
                    <h4 class="card-title">Lista de Categorias</h4>
                    <div class="form-check form-check-inline float-right">
                        <div class="btn-toolbar" role="group" aria-label="Basic example">
              
                            <button type="" class="btn btn-black" data-toggle="modal" data-target="#InsertCat"><i class="material-icons">add</i>Agregar </button>
                           
                            @if(!$categoria->isEmpty())
                            <a type="button" href="{{route('IndexRcategoria')}}" class="btn btn-black"><i class="material-icons">restore_from_trash</i>Recuperar borrados</a>
                            @endif
                        </div>
                    </div>

                </div>
                <div class="card-body">
                    <!--Verificar si hay registros-->
                    @if($categoria->isEmpty())
                    <div class="col-xs-12 col-md-12 error404 text center">
                        <h1>

                            <small>¡Oops!</small>

                        </h1>
                        <h2>Aun no hay registros guardados</h2>
                        <div class="form-check form-check-inline float-right">
                        <div class="btn-toolbar" role="group" aria-label="Basic example">
                        <a type="button" href="{{route('productos')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar a productos </a>
                        </div>
                       

                        </div>
                    </div>

                    @else

                    <!--Tabla de categorias-->
                    <div class="form-check form-check-inline float-right">

                        <a type="button" href="{{route('productos')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar a productos </a>

                    </div>
                    <div class="table-responsive">
                        <table class="table table-shopping">
                            <thead class=" text-primary">
                                <th>
                                    ID
                                </th>
                                <th>
                                    Nombre
                                </th>
                                <th class="text-right">
                                    Actions
                                </th>
                            </thead>
                            <!--Imprimiendo lista de categorias-->
                            <tbody>
                                @foreach( $categoria as $catI)
                                <tr>
                                    <td>
                                        {{$catI->id_categoria}}
                                    </td>
                                    <td>
                                        {{$catI->nom_categoria}}
                                    </td>

                                    <!-- Botones de crud para modal -->
                                    <td class="td-actions text-right">

                                        <!-- Editar -->
                                        <button data-id_categoria="{{$catI->id_categoria}}" data-nom_categoria="{{$catI->nom_categoria}}" data-toggle="modal" data-target="#EditCat" rel="tooltip" class="btn btn-jei">
                                            <i class="material-icons">edit</i>
                                        </button>
                                        <!-- Eliminar -->
                                        <button rel="tooltip" class="btn btn-jei" data-id_categoria="{{$catI->id_categoria}}" data-toggle="modal" data-target="#EliminarCat">
                                            <i class="material-icons">close</i>
                                        </button>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>



                        </table>


                        <!-- Paginador -->
                        {{$categoria}}

                        @endif
                        <!-- Button trigger modal -->

                        <!-- Modal agregar categoria-->
                        <div class="modal fade" id="InsertCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="exampleModalLabel">Insertar categoria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario -->

                                        <form class="form-submit-limit" method="POST" id="categoria_add" action="{{route('categoria.store')}}">
                                            @csrf

                                            <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nom_categoria" class="form-control">



                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary button-submit-limit gcategoria">Guardar</button>
                                            </div>


                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>


                        <!-- Modal editar categoria-->
                        <div class="modal fade" id="EditCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">

                                        <h5 class="modal-title" id="exampleModalLabel">Editar categoria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario -->
                                        <form class="form-submit-limit" method="POST" action="{{route('categoria.update','id_categoria')}}">
                                            @csrf
                                            @method('PUT')
                                            <input type="hidden" id="id_categoria" name="id_categoria">
                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nom_categoria" id="nom_categoria" class="form-control">
                                            </div>

                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                                <button type="submit" class="btn btn-primary button-submit-limit editcategoria">Actualizar</button>
                                            </div>


                                        </form>
                                    </div>

                                </div>
                            </div>
                        </div>





                        <!-- Modal eliminar categoria-->
                        <div class="modal fade" id="EliminarCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header header-primary">
                                        <h5 class="modal-title" id="exampleModalLabel">Eliminar categoria</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <!-- Formulario -->
                                        <form class="form-submit-limit" action="{{route('categoria.destroy','id_categoria')}}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <input type="hidden" id="id_categoria" name="id_categoria">
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

        <script>
            $(".gcategoria").click(function(e) {
                let nom_categoria = $("input[name=nom_categoria]").val();
                let id_user = $("input[name=id_user]").val();
                let _token = $('meta[name="csrf-token"]').attr('content');
                e.preventDefault();
                $.ajax({
                    url: "{{route('categoria.store')}}",
                    type: "POST",
                    data: {
                        id_user: id_user,
                        nom_categoria: nom_categoria,
                        _token: _token
                    },
                    success: function(data) {

                        console.log(data);
                        if (data.error) {
                            var values = '';
                            jQuery.each(data.error, function(key, value) {
                                values += value
                            });

                            swal({
                                title: "Ocurrio un error",
                                text: values,
                                timer: 3000,
                                showConfirmButton: false,
                                type: "error"
                            })
                        } else if (!data.error) {
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

            $(".editcategoria").click(function(e) {
                e.preventDefault();
                let id_categoria = $("input[name=id_categoria]").val();
                let nom_categoria = $("#nom_categoria").val();
                let _token = $('meta[name="csrf-token"]').attr('content');


                $.ajax({
                    url: "{{route('categoria.update','id_categoria')}}",
                    type: 'POST',
                    data: {
                        nom_categoria: nom_categoria,
                        id_categoria: id_categoria,
                        id_categoria: id_categoria,
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
                                timer: 2000,
                                showConfirmButton: false,
                                type: "error"
                            });
                        } else if (!data.error) {
                            $('select').selectpicker('refresh');
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

        @section('titulo', 'Categorias')