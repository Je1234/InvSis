@extends('layouts.dashboard')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Lista de usuarios</h4>
                <div class="form-check form-check-inline float-right">

                   

                </div>

            </div>
            <div class="card-body">
                <!--Verificar si hay usuarios-->
                @if($users->isEmpty())
                <div class="col-xs-12 col-md-12 error404 text center">
                    <h1>

                        <small>¡Oops!</small>

                    </h1>
                    <h2>Aun no hay usuarios registrados</h2>
                </div>
                @endif
                <!--Tabla de usuarios-->
                <div class="table-responsive">
                    <table class="table table-shopping">
                        <thead class="text-primary">
                            <th>
                                #
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                                Correo
                            </th>
                            <th>
                                Roles
                            </th>

                            <th class="text-right">
                                Actions
                            </th>
                        </thead>
                        <!--Imprimiendo lista de clientes-->
                        <tbody>
                            @php($i=1)
                            @foreach( $users as $u)
                            <tr>
                                <td>
                                    {{$u->id}}
                                </td>
                                <td>
                                    {{$u->name}}
                                </td>
                                <td>
                                    {{$u->email}}
                                </td>
                                <td>
                                    @foreach($u->roles as $us )
                                    {{ $us->name}}
                                    @endforeach
                                </td>
                                <!-- Botones de crud para modal -->
                                <td class="td-actions text-right">
                                    <!-- Ver-->
                                    <button data-toggle="modal" data-id="{{$u->id}}" data-name="{{$u->name}}" data-email="{{$u->email}}" data-target="#VerUser" rel="tooltip" class="btn btn-jei">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                    @can('editar-user')
                                    <!-- Editar -->
                                    <button data-toggle="modal" data-target="#EditCliente" rel="tooltip" class="btn btn-jei">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    @endcan
                                    @can('eliminar-user')
                                    <!-- Eliminar -->
                                    <button rel="tooltip" class="btn btn-jei" data-id="{{$u->id}}" data-toggle="modal" data- data-target="#EliminarUsuario">
                                        <i class="material-icons">close</i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>
                            @php($i++)
                            @endforeach

                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Paginador -->
{{$users}}


<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Lista de roles</h4>
                <div class="form-check form-check-inline float-right">
                      @can('crear-rol')
                    <button type="" class="btn btn-black" data-toggle="modal" data-target="#CrearRol"><i class="material-icons">add</i>Agregar </button>
                       @endrole
                </div>

            </div>
            <div class="card-body">
                <!--Verificar si hay usuarios-->
                @if($roles->isEmpty())
                <div class="col-xs-12 col-md-12 error404 text center">
                    <h1>

                        <small>¡Oops!</small>

                    </h1>
                    <h2>Aun no hay roles registrados</h2>
                </div>
                @endif
                <!--Tabla de usuarios-->
                <div class="table-responsive">
                    <table class="table table-shopping">
                        <thead class="text-primary">
                            <th>
                                #
                            </th>
                            <th>
                                Nombre
                            </th>
                            <th>
                               Permisos
                            </th>
                            <th class="text-left">
                                Actions
                            </th>
                        </thead>
                        <!--Imprimiendo lista de clientes-->
                        <tbody>

                            @foreach( $roles as $r)
                            <tr>
                                <td>
                                    {{$r->id}}
                                </td>
                                <td>
                                    {{$r->name}}
                                </td>
                                <td>
                                    @foreach($r->permissions as $rp)
                                    <li>{{$rp->name}}</li>
                                    @endforeach
                                </td>

                                <!-- Botones de crud para modal -->
                                <td class="td-actions text-left">
                                    <!-- Ver-->
                                    <button data-toggle="modal" data-id="{{$u->id}}" data-name="{{$u->name}}" data-email="{{$u->email}}" data-target="#VerUser" rel="tooltip" class="btn btn-jei">
                                        <i class="material-icons">visibility</i>
                                    </button>
                                    <!-- Editar -->
                                    <button data-toggle="modal" data-target="#EditCliente" rel="tooltip" class="btn btn-jei">
                                        <i class="material-icons">edit</i>
                                    </button>
                                    @can('eliminar-rol')
                                    <!-- Eliminar -->
                                    <button rel="tooltip" class="btn btn-jei" data-id="{{$r->id}}" data-toggle="modal" data- data-target="#EliminarRol">
                                        <i class="material-icons">close</i>
                                    </button>
                                    @endcan
                                </td>
                            </tr>

                            @endforeach

                        </tbody>



                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Paginador -->
{{$roles}}

<!-- Modal crear rol-->
<div class="modal fade" id="CrearRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Crear rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form method="POST" action="{{route('roles.store')}}">
                    @csrf
                    @method('POST')

                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="name" class="form-control" id="name">
                    </div>

                    <div class="form-group">
                        <label>Permisos</label>
                        
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="crear-user">
                            Crear usuario
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar-user">
                            Eliminar usuario
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="editar-user">
                            Editar usuario
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="crear-rol">
                            Crear Rol
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="eliminar-rol">
                            Eliminar Rol
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>
                    <div class="form-check">
                        <label class="form-check-label">
                            <input class="form-check-input" type="checkbox" name="permisos[]" value="editar-rol">
                            Editar Rol
                            <span class="form-check-sign">
                                <span class="check"></span>
                            </span>
                        </label>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Regresar</button>
                        <button type="submit" class="btn btn-primary">Guardar</button>

                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

<!-- Modal eliminar rol-->
<div class="modal fade" id="EliminarRol" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar rol</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{route('roles.destroy','id')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id" name="id">
                    <p class="text-center">¿Estas seguro de eliminar el rol?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Eliminar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal eliminar usuario-->
<div class="modal fade" id="EliminarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Eliminar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{route('Dusuario','id')}}" method="POST">
                    @csrf
                    @method('DELETE')
                    <input type="hidden" id="id" name="id">
                    <p class="text-center">¿Estas seguro de eliminar el usuario?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Eliminar</button>

            </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal ver usuario-->
<div class="modal fade" id="VerUser" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Ver usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form method="GET" action="{{route('roles.update','id')}}">
                    @csrf
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>ID usuario</label>
                        <input type="text" name="id" class="form-control" id="id" disabled>
                    </div>
                    <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" disabled>
                    </div>
                    <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="apellido" class="form-control" id="apellido" disabled>
                    </div>


                    <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Regresar</button>

                    </div>


                </form>
            </div>

        </div>
    </div>
</div>

@endsection


@section('titulo','Roles y permisos')