@extends('layouts.dashboard')
@section('content')
<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Ventas</h4>
                <p class="category">Category subtitle</p>
            </div>
            <div class="card-body">

                <form>
                    <div class="form-group">
                        <label for="">Cantidad pagada</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
                    </div>
                    <div class="form-group">
                        <label for="">Metodo de pago</label>
                        <select class="form-control" data-style="btn btn-link" id="exampleFormControlSelect1">
                            <option>1</option>
                            <option>2</option>
                            <option>3</option>
                            <option>4</option>
                            <option>5</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="">Monto a pagar</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="$250.000" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Deuda</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="$234.304" disabled>
                    </div>
                    <div class="form-group">
                        <label for="">Monto total</label>
                        <input type="text" class="form-control" id="exampleFormControlInput1" placeholder="" value="$250.000" disabled>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!--Lista de productos -->
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Lista de productos </h4>
                <div class="input-group no-border">
                    <input type="text" value="" class="form-control" placeholder="Buscar producto...">
                    <button type="submit" class="btn btn-white btn-round btn-just-icon">
                        <i class="material-icons">search</i>
                        <div class="ripple-container"></div>
                    </button>
                </div>
                <p class="category"></p>
            </div>
            <div class="card-body">
                <!--Inicio Body-->
                <div class="table-responsive">
                    <table class="table">
                        <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th>Imagen</th>
                                <th>Nombre</th>
                                <th>Marca</th>
                                <th>Since</th>
                                <th class="text-left">Precio</th>
                                <th class="text-left">Cantidad</th>
                                <th class="text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td class="text-center">1</td>
                                <td>
                                    <div class="img-container">
                                        <img src="https://images.thenorthface.com/is/image/TheNorthFace/NF0A2VFL_619_hero" style="width:100px;height:100" rel="nofollow" alt="...">
                                    </div>
                                </td>
                                <td>Andrew Mike</td>
                                <td>Develop</td>
                                <td>2013</td>
                                <td class="text-left">&dollar; 99,225</td>

                                <td class="td-number">
                                    1
                                    <div class="btn-group">
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">remove</i> </button>
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">add</i> </button>
                                    </div>
                                </td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>

                            </tr>
                            <tr>
                                <td class="text-center">2</td>
                                <td>
                                    <div class="img-container">
                                        <img src="https://images.thenorthface.com/is/image/TheNorthFace/NF0A2VFL_619_hero" style="width:100px;height:100" rel="nofollow" alt="...">
                                    </div>
                                </td>
                                <td>John Doe</td>
                                <td>Design</td>
                                <td>2012</td>
                                <td class="text-left">&euro; 89,241</td>
                                <td class="td-number">
                                    1
                                    <div class="btn-group">
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">remove</i> </button>
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">add</i> </button>
                                    </div>

                                </td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                            <tr>
                                <td class="text-center">3</td>
                                <td>
                                    <div class="img-container">
                                        <img src="https://images.thenorthface.com/is/image/TheNorthFace/NF0A2VFL_619_hero" style="width:100px;height:100" rel="nofollow" alt="...">
                                    </div>
                                </td>
                                <td>Alex Mike</td>
                                <td>Design</td>
                                <td>2010</td>
                                <td class="text-left">&euro; 92,144</td>
                                <td class="td-number">
                                    1
                                    <div class="btn-group">
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">remove</i> </button>
                                        <button class="btn btn-round btn-info btn-sm"> <i class="material-icons">add</i> </button>
                                    </div>
                                </td>
                                <td class="td-actions text-right">
                                    <button type="button" rel="tooltip" class="btn btn-danger">
                                        <i class="material-icons">close</i>
                                    </button>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <!--Paginador-->
                    <div class="col-md-12">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-center">
                                <li class="page-item disabled">
                                    <a class="page-link" href="javascript:;" tabindex="-1">Previous</a>
                                </li>
                                <li class="page-item"><a class="page-link" href="javascript:;">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:;">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:;">3</a></li>
                                <li class="page-item">
                                    <a class="page-link" href="javascript:;">Next</a>
                                </li>
                            </ul>
                        </nav>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="" class="btn btn-primary float-right"><i class="material-icons">add</i>Agregar</button>
                                <button type="" class="btn btn-primary float-right" data-toggle="modal" data-target="#InsertProduct"><i class="material-icons">print</i>Imprimir </button>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12">
                                <div class="card-title">Cliente</div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="">Seleccionar cliente</label>
                                    <select class="form-control " data-style="btn btn-link" id="exampleFormControlSelect1" data-live-search="true">
                                        <option>Jose Perez</option>
                                        <option>2</option>
                                        <option>3</option>
                                        <option>4</option>
                                        <option>5</option>
                                    </select>

                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group"><button type="" class="btn btn-primary float-right" data-toggle="modal" data-target="#InsertProduct"><i class="material-icons">add</i>Agregar</button>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <div class="form-group"><button type="submit" class="btn btn-primary btn-lg " data-toggle="modal" data-target="#InsertProduct"><i class="material-icons">add</i>Realizar compra</button>
                                        </div>
                                    </div>
                                </div>


                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Segundo row-->

    @endsection
    @section('titulo','Ventas')