@extends('layouts.dashboard')

@section('content')

<div class="row">

  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-warning card-header-icon">
        <div class="card-icon">
          <i class="material-icons">category</i>
        </div>
        <p class="card-category">Productos</p>
        <h3 class="card-title"> {{ \DB::table('productos')->where('id_user',Auth::user()->id)->count()}}
          <small></small>
        </h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <a href="{{route('productos')}}">Ver productos..</a>
        </div>
      </div>
    </div>
  </div>

  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-success card-header-icon">
        <div class="card-icon">
          <i class="material-icons">monetization_on</i>
        </div>
        <p class="card-category">Ingresos</p>
        <h3 class="card-title">${{$ventas->sum()}}</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">date_range</i> Este mes
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-danger card-header-icon">
        <div class="card-icon">
          <i class="material-icons">store</i>
        </div>
        <p class="card-category">Compras Realizadas</p>
        <h3 class="card-title">{{ \DB::table('compras')->where('id_user',Auth::user()->id)->count()}}</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">monetization_on</i><a href="{{route('compras')}}">Ver compras..</a>
        </div>
      </div>
    </div>
  </div>


  <div class="col-lg-3 col-md-6 col-sm-6">
    <div class="card card-stats">
      <div class="card-header card-header-info card-header-icon">
        <div class="card-icon">
          <i class="material-icons">storefront</i>
        </div>
        <p class="card-category">Ventas Realizadas</p>
        <h3 class="card-title">{{ \DB::table('ventas')->where('id_user',Auth::user()->id)->count()}}</h3>
      </div>
      <div class="card-footer">
        <div class="stats">
          <i class="material-icons">monetization_on</i> <a href="{{route('venta')}}">Ver ventas..</a>
        </div>
      </div>
    </div>
  </div>
</div>


<div class="row">
  ​
  <div class="col-xs-12 col-md-12 error404 mt-5 text-center">
    <h1>

      <small>¡Bienvenido {{Auth::User()->name}}!</small>

    </h1>
    <h2>InvSis</h2>
    @role('admin')
    <a type="button" href="{{route('Permisos')}}" class="btn btn-primary"><i class="material-icons">hourglass_full</i>Actualizar roles y permisos </a>
    @endrole
  </div>

</div>
</div>


@endsection

@section('titulo','Inicio')