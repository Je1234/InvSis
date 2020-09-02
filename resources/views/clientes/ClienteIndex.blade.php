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
          <h4 class="card-title">Lista de clientes</h4>
          <div class="form-check form-check-inline float-right">

            <button type="" class="btn btn-black" data-toggle="modal" data-target="#InsertCliente"><i class="material-icons">add</i>Agregar </button>

          </div>

        </div>
        <div class="card-body">
          <!--Verificar si hay productos-->
          @if($clientes->isEmpty())
          <div class="col-xs-12 col-md-12 error404 text center">
            <h1>

              <small>¡Oops!</small>

            </h1>
            <h2>Aun no hay clientes registrados</h2>
          </div>
          @elseif($clientesB->isEmpty())
          <div class="col-xs-12 col-md-12 error404 text center">
            <h1>

              <small>¡Oops!</small>

            </h1>
            <h2>No se encontraron resultados</h2>
            <div class="form-check form-check-inline float-right col-md-1">

              <a type="button" href="{{route('clientes')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

            </div>
          </div>

          @elseif(($clientesB))
          <form class="form-group form-inline">

            <div class="input-group col-md-2 ">

              <select class="form-control " name="tipo">
                <option value="">Filtrar por</option>
                <option value="id_documento">Documento</option>
                <option>Nombres</option>
                <option>Apellidos</option>
                <option>Correo</option>
                <option value="id_tipo_documento">Tipo documento</option>
              </select>
            </div>

            <div class="input-group col-md-2">

              <input name="buscarPor" type="search" value="" class="form-control" aria-label="search" placeholder="Buscar...">
              <button type="submit" class="btn btn-primary btn-round btn-just-icon">
                <i class="material-icons">search</i>
                <div class="ripple-container"></div>
              </button>

            </div>

          </form>
          @if(($tipoB) && ($busqueda))
          <div class="form-check form-check-inline float-right col-md-1">

            <a type="button" href="{{route('clientes')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

          </div>
          @endif


          <!--Tabla de clientes-->
          <div class="table-responsive">
            <table class="table table-shopping">
              <thead class="text-primary">
                <th>
                  #
                </th>
                <th>
                  Nombres
                </th>
                <th>
                  Apellidos
                </th>
                <th>
                  Documento
                </th>
                <th>
                  Correo
                </th>
                <th>
                  Edad
                </th>
                <th class="text-right">
                  Actions
                </th>
              </thead>
              <!--Imprimiendo lista de clientes-->
              <tbody>
                @php($i=1)
                @foreach( $clientesB as $c)
                <tr>
                  <td>
                    {{$i}}
                  </td>
                  <td>
                    {{$c->nombres}}
                  </td>
                  <td>
                    {{$c->apellidos}}
                  </td>
                  <td>
                    {{$c->id_documento}}
                  </td>
                  <td>
                    {{$c->correo}}
                  </td>
                  <td>
                    {{Carbon\Carbon::parse($c->fecha_nacimiento)->age}}
                  </td>
                  <!-- Botones de crud para modal -->
                  <td class="td-actions text-right">
                    <!-- Ver-->
                    <button data-id_cliente="{{$c->id_documento}}" data-id_tipo="{{$c->id_tipo_documento}}" data-nombres="{{$c->nombres}}" data-apellidos="{{$c->apellidos}}" data-correo="{{$c->correo}}" data-direccion="{{$c->direccion}}" data-telefono="{{$c->telefono}}" data-celular="{{$c->celular}}" data-fecha="{{$c->fecha_nacimiento}}" data-toggle="modal" data-target="#VerCliente" rel="tooltip" class="btn btn-jei">
                      <i class="material-icons">visibility</i>
                    </button>
                    <!-- Editar -->
                    <button data-id_cliente="{{$c->id_documento}}" data-id_tipo="{{$c->id_tipo_documento}}" data-nombres="{{$c->nombres}}" data-apellidos="{{$c->apellidos}}" data-correo="{{$c->correo}}" data-direccion="{{$c->direccion}}" data-telefono="{{$c->telefono}}" data-celular="{{$c->celular}}" data-fecha="{{$c->fecha_nacimiento}}" data-toggle="modal" data-target="#EditCliente" rel="tooltip" class="btn btn-jei">
                      <i class="material-icons">edit</i>
                    </button>
                    <!-- Eliminar -->
                    <button rel="tooltip" class="btn btn-jei" data-id_cliente="{{$c->id_documento}}" data-toggle="modal" data- data-target="#EliminarCliente">
                      <i class="material-icons">close</i>
                    </button>
                  </td>
                </tr>
                @php($i++)
                @endforeach

              </tbody>



            </table>


            <!-- Paginador -->
            {{$clientesB}}
            @endif
            <!-- Modal agregar cliente-->
            <div class="modal fade" id="InsertCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Insertar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form method="POST" class="form-submit-limit" action="{{route('cliente.store')}}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" name="id_user" value="{{Auth::user()->id}}" class="form-control">
                      <div class="form-group">
                        <label>N° documento</label>
                        <input type="text" name="id_documento" class="form-control" id="" placeholder="">
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de documento</label>
                        <select class="form-control" name="id_tipo_documento" id="id_tipo_documento">
                          <option value="">Seleccionar tipo...</option>
                          @foreach($tipos as $t)
                          <option value="{{$t->id_tipo_documento}}">{{$t->nom_tipo_documento}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nombres</label>
                        <input type="text" name="nombres" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="telefono" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Celular</label>
                        <input type="number" name="celular" class="form-control">
                      </div>
                      <div class="form-group">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" id="guardar_cliente" class="btn btn-primary button-submit-limit gcliente">Guardar</button>
                      </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal editar cliente-->
            <div class="modal fade" id="EditCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form method="POST" class="form-submit-limit" id="clientedit" action="{{route('cliente.update','id_documento')}}" enctype="multipart/form-data">
                      @csrf
                      @method('PUT')
                      <input type="hidden" id="id_documento" name="id_documento">
                      <div class="form-group">
                        <label>N° documento</label>
                        <input type="text" name="id_documento" class="form-control" id="documento">
                      </div>
                      <div class="form-group">
                        <label>Tipo de documento</label>
                        <select class="form-control" name="id_tipo_documento" id="id_tipo_documento">
                          <option value="">No tiene tipo de documento registrado</option>
                          @foreach($tipos as $t)
                          <option value="{{$t->id_tipo_documento}}">{{$t->nom_tipo_documento}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombres" class="form-control" id="nombre">
                      </div>
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellidos" class="form-control" id="apellido">
                      </div>
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" id="correo">
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
                        <label>Celular</label>
                        <input type="number" name="celular" class="form-control" id="celular">
                      </div>
                      <div class="form-group">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha_nacimiento" class="form-control" id="fecha">
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                        <button type="submit" class="btn btn-primary button-submit-limit editcliente">Actualizar</button>
                      </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal ver cliente-->
            <div class="modal fade" id="VerCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ver cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form method="GET" action="{{route('cliente.update','id_documento')}}" enctype="multipart/form-data">
                      @csrf
                      <input type="hidden" id="id_documento" name="id_documento">
                      <div class="form-group">
                        <label>N° documento</label>
                        <input type="text" name="documento" class="form-control" id="documento" placeholder="" disabled>
                      </div>
                      <div class="form-group">
                        <label for="exampleFormControlSelect1">Tipo de documento</label>
                        <select class="selectpicker form-control" name="tipo_documento" id="id_tipo_documento" disabled>
                          <option value="">No tiene tipo de documento registrado</option>
                          @foreach($tipos as $t)
                          <option value="{{$t->id_tipo_documento}}">{{$t->nom_tipo_documento}}</option>
                          @endforeach
                        </select>
                      </div>
                      <div class="form-group">
                        <label>Nombre</label>
                        <input type="text" name="nombre" class="form-control" id="nombre" placeholder="" disabled>
                      </div>
                      <div class="form-group">
                        <label>Apellidos</label>
                        <input type="text" name="apellido" class="form-control" id="apellido" placeholder="" disabled>
                      </div>
                      <div class="form-group">
                        <label>Correo</label>
                        <input type="text" name="correo" class="form-control" id="correo" disabled>
                      </div>
                      <div class="form-group">
                        <label>Direccion</label>
                        <input type="text" name="direccion" class="form-control" id="direccion" disabled>
                      </div>
                      <div class="form-group">
                        <label>Telefono</label>
                        <input type="number" name="telefono" class="form-control" id="telefono" disabled>
                      </div>
                      <div class="form-group">
                        <label>Celular</label>
                        <input type="number" name="celular" class="form-control" id="celular" disabled>
                      </div>
                      <div class="form-group">
                        <label>Fecha nacimiento</label>
                        <input type="date" name="fecha" class="form-control" id="fecha" disabled>
                      </div>

                      <div class="modal-footer">
                        <button type="button" class="btn btn-primary " data-dismiss="modal">Regresar</button>

                      </div>


                    </form>
                  </div>

                </div>
              </div>
            </div>


            <!-- Modal eliminar cliente-->
            <div class="modal fade" id="EliminarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog" role="document">
                <div class="modal-content">
                  <div class="modal-header header-primary">
                    <h5 class="modal-title" id="exampleModalLabel">Eliminar cliente</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                    </button>
                  </div>
                  <div class="modal-body">
                    <!-- Formulario -->
                    <form class="form-submit-limit" action="{{route('cliente.destroy','id_documento')}}" method="POST">
                      @csrf
                      @method('DELETE')
                      <input type="hidden" id="id_documento" name="id_documento">
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
      $(".gcliente").click(function(e) {
        let id_documento = $("input[name=id_documento]").val();
        let id_tipo_documento = $("select[name=id_tipo_documento]").val();
        let nombres = $("input[name=nombres]").val();
        let apellidos = $("input[name=apellidos]").val();
        let correo = $("input[name=correo]").val();
        let direccion = $("input[name=direccion]").val();
        let telefono = $("input[name=telefono]").val();
        let celular = $("input[name=celular]").val();
        let fecha_nacimiento = $("input[name=fecha_nacimiento]").val();
        let id_user = $("input[name=id_user]").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        e.preventDefault();
        $.ajax({
          url: "{{route('cliente.store')}}",
          type: "POST",
          data: {
            id_documento: id_documento,
            id_tipo_documento: id_tipo_documento,
            id_user: id_user,
            nombres: nombres,
            apellidos: apellidos,
            correo: correo,
            direccion: direccion,
            telefono: telefono,
            celular: celular,
            fecha_nacimiento: fecha_nacimiento,
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


      $(".editcliente").click(function(e) {
        e.preventDefault();
        
        let id_documento = $("#documento").val();
        let nombres = $("#nombre").val();
        let apellidos = $("#apellido").val();
        let id_tipo_documento = $("select[name=id_tipo_documento]").val();
        let correo = $("#correo").val();
        let direccion = $("#direccion").val();
        let telefono = $("#telefono").val();
        let celular = $("#celular").val();
        let fecha_nacimiento = $("#fecha").val();
        let _token = $('meta[name="csrf-token"]').attr('content');
        var dataString = $('#clientedit').serialize();
       
        $.ajax({
          url: "{{route('cliente.update','id_documento')}}",
          type: 'POST',
          data:dataString ,
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


    @section('titulo','Clientes')