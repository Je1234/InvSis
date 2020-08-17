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

                        <button type="" class="btn btn-black" data-toggle="modal" data-target="#InsertCat"><i class="material-icons">add</i>Agregar </button>

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

                            <a type="button" href="{{route('productos')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar a productos </a>

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
                                        <a data-id_categoria="{{$catI->id_categoria}}" data-nom_categoria="{{$catI->nom_categoria}}" data-toggle="modal" data-target="#EditCat" rel="tooltip" class="btn btn-jei">
                                            <i class="material-icons">edit</i>
                                        </a>
                                        <!-- Eliminar -->
                                        <a rel="tooltip" class="btn btn-jei" data-id_categoria="{{$catI->id_categoria}}" data-toggle="modal" data-target="#EliminarCat">
                                            <i class="material-icons">close</i>
                                        </a>
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
                                        <form class="form-submit-limit" method="POST" action="{{route('categoria.store')}}">
                                            @csrf

                                            <div class="form-group">
                                                <label>Nombre</label>
                                                <input type="text" name="nombre" class="form-control" id="" placeholder="">
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
                                                <button type="submit" class="btn btn-primary button-submit-limit">Actualizar</button>
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

        @endsection

        @section('titulo', 'Categorias')