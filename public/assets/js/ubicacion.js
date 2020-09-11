//ELIMINAR UBICACION
$('#EliminarUbicacion').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_ubicacion = button.data('id_ubicacion')
console.log(id_ubicacion)
    var modal = $(this)

    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);

});

//EDITAR UBICACION
$('#EditUbicacion').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_ubicacion = button.data('id_ubicacion')
    var nombre_bodega = button.data('nombre_bodega')
    var seccion = button.data('seccion')
    var direccion = button.data('direccion')
  
    
    var modal = $(this)

    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
    modal.find('.modal-body #nombre_bodega').val(nombre_bodega);
    modal.find('.modal-body #seccion').val(seccion);
    modal.find('.modal-body #direccion').val(direccion);

});

//EDITAR UBICACION
$('#VerUbicacion').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_ubicacion = button.data('id_ubicacion')
    var nombre_bodega = button.data('nombre_bodega')
    var seccion = button.data('seccion')
    var direccion = button.data('direccion')
  
    
    var modal = $(this)

    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
    modal.find('.modal-body #nombre_bodega').val(nombre_bodega);
    modal.find('.modal-body #seccion').val(seccion);
    modal.find('.modal-body #direccion').val(direccion);

});


$('#RecuperarAllUb').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_ubicacion = button.data('id_ubicacion')
      
    var modal = $(this)

    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
  

});

$('#RecuperarUbicacion').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_ubicacion = button.data('id_ubicacion')
      
    var modal = $(this)

    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
  

});