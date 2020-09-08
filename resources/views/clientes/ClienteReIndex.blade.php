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
          <h4 class="card-title">Lista de clientes eliminados</h4>
          <div class="form-check form-check-inline float-right">
            <div class="btn-toolbar" role="group" aria-label="Basic example">
              @if(!$clientesB->isEmpty())
              <button type="button" data-toggle="modal" data-target="#RecuperarAllCliente" class="btn btn-black col-xs-1"><i class="material-icons">restore_from_trash</i>Recuperar todo</button>
              @endif
              <a type="button" href="{{route('cliente.index')}}" class="btn btn-black"><i class="material-icons">reply</i>Regresar a clientes</a>

            </div>
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

              <a type="button" href="{{route('IndexRcliente')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

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

            <a type="button" href="{{route('IndexRcliente')}}" class="btn btn-primary"><i class="material-icons">reply</i>Regresar </a>

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

                    <!-- Recuperar -->
                    <button rel="tooltip" class="btn btn-jei" data-id_cliente="{{$c->id_documento}}" data-toggle="modal" data- data-target="#RecuperarCliente">
                      <i class="material-icons">reply</i>
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




          </div>
        </div>
      </div>
    </div>
    <!-- Modal recuperar cliente-->
    <div class="modal fade" id="RecuperarCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header header-primary">
            <h5 class="modal-title" id="exampleModalLabel">Recuperar cliente</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">
            <!-- Formulario -->
            <form class="form-submit-limit" action="{{route('Rcliente')}}" method="POST">
              @csrf
              @method('GET')
              <input type="hidden" id="id_documento" name="id_documento">
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

    <!-- Modal recuperar todos los clientes-->
    <div class="modal fade" id="RecuperarAllCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
            <form class="form-submit-limit" action="{{route('RAcliente')}}" method="POST">
              @csrf
              @method('GET')

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
          data: dataString,
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