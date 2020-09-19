@extends('layouts.dashboard')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-9">
            <div class="card">
                <div class="card-header card-header-primary">
                    <h4 class="card-title">Perfil</h4>

                </div>
                <div class="card-body">
                    <form>

                        <div class="row">

                            <div class="col-md-3">
                                <div class="form-group">
                                    <label>Nombre</label>
                                    <input type="text" class="form-control" value="{{$user->name}}"  readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Correo</label>
                                    <input type="email" class="form-control" value="{{$user->email}}" readonly>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Plan contratado</label>
                                    <input type="text" class="form-control" value="{{$user->tipo_plan}}"  readonly>
                                </div>
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha inicio de plan</label>
                                    <input type="text" class="form-control" value="{{$user->fecha_inicio->toDateString()}}"  readonly>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>Fecha fin de plan</label>
                                    @if($user->tipo_plan == 'basico')
                                    <input type="text" class="form-control" value="{{$user->fecha_inicio->addDays(90)->toDateString()}}"  readonly>
                                    @elseif($user->tipo_plan == 'medio')
                                    <input type="text" class="form-control" value="{{$user->fecha_inicio->addDays(182)->toDateString()}}"  readonly>
                                    @elseif($user->tipo_plan == 'completo')
                                    <input type="text" class="form-control" value="{{$user->fecha_inicio->addDays(364)->toDateString()}}"  readonly>
                                    @endif
                                </div>
                            </div>
                        </div>

                        <div class="clearfix"></div>
                    </form>
                </div>
            </div>
        </div>

    </div>
</div>


@endsection

@section('titulo','Perfil de usuario')