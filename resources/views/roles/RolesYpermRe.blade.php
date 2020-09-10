@extends('layouts.dashboard')

@section('content')


<div class="row">
    <div class="col-md-12">
        <div class="card">

            <div class="card-header card-header-primary">
                <h4 class="card-title">Lista de usuarios expirados</h4>
                <div class="form-check form-check-inline float-right">

                <a type="button" href="{{route('roles.index')}}" class="btn btn-black"><i class="material-icons">reply</i>Regresar a roles y permisos</a>

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
               @else
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
                                    
                                   
                                    <!-- Eliminar -->
                                    <button rel="tooltip" class="btn btn-jei" data-id="{{$u->id}}" data-toggle="modal" data- data-target="#RecuperarUsuario">
                                        <i class="material-icons">reply</i>
                                    </button>
                                    
                                </td>
                            </tr>
                            @php($i++)
                            @endforeach

                        </tbody>



                    </table>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Paginador -->
{{$users}}





<!-- Modal renovar usuario-->
<div class="modal fade" id="RecuperarUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header header-primary">
                <h5 class="modal-title" id="exampleModalLabel">Renovar usuario</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- Formulario -->
                <form class="form-submit-limit" action="{{route('Rusuario')}}" method="POST">
                    @csrf
                    @method('PUT')
                    <input type="hidden" id="id" name="id">
                    <div class="form-group">
                        <label>Plan nuevo</label>
                        <select class="selectpicker form-control" id="tipo_plan" name="tipo_plan" >
                          <option value="">Seleccione el plan</option>
                         
                          <option value="basico">Basico</option>
                          <option value="medio">Medio</option>
                          <option value="completo">Completo</option>
                         
                        </select>
                      </div>
                    <p class="text-center">¿Estas seguro de renovar el usuario?</p>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary button-submit-limit">Renovar</button>

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