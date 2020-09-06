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
                    <h4 class="card-title">Lista de Categorias eliminadas</h4>
                    <div class="form-check form-check-inline float-right">
                        <div class="row">
                            <div class="btn-toolbar" role="group" aria-label="Button group with nested dropdown">
                                @if(!$categoria->isEmpty())
                                <button type="button" data-toggle="modal" data-target="#RecuperarAllCat" class="btn btn-black col-xs-1"><i class="material-icons">restore_from_trash</i>Recuperar todos los registros</button>
                                @endif
                                <a type="button" href="{{route('categoria.index')}}" class="btn btn-black"><i class="material-icons">reply</i>Regresar a categorias</a>
                            </div>
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
                        <h2>Aun no hay registros para recuperar</h2>
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

                                        <!-- Recuperar -->
                                        <button rel="tooltip" class="btn btn-jei" data-id_categoria="{{$catI->id_categoria}}" data-toggle="modal" data-target="#RecuperarCat">
                                            <i class="material-icons">reply</i>
                                        </button>
                                    </td>
                                </tr>

                                @endforeach

                            </tbody>



                        </table>


                        <!-- Paginador -->
                        {{$categoria}}

                        @endif



                    </div>
                </div>
            </div>
        </div>
        <!-- Modal recuperar categoria-->
        <div class="modal fade" id="RecuperarCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header header-primary">
                        <h5 class="modal-title" id="exampleModalLabel">Recuperar categoria</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <!-- Formulario -->
                        <form class="form-submit-limit" action="{{route('Rcategoria')}}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="hidden" id="id_categoria" name="id_categoria">
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


        <!-- Modal recuperar todas las categoria-->
        <div class="modal fade" id="RecuperarAllCat" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <form class="form-submit-limit" action="{{route('RAcategoria')}}" method="POST">
                            @csrf
                            @method('GET')
                            <input type="hidden" id="id_categoria" name="id_categoria">
                            <p class="text-center">¿Estas seguro de recuperar todos los registros?</p>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit">Recuperar todo</button>

                    </div>
                    </form>
                </div>
            </div>
        </div>
        @endsection

        @section('titulo', 'Categorias')