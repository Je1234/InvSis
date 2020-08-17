$('#EliminarProv').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_proveedor = button.data('id_proveedor')

    var modal = $(this)

    modal.find('.modal-body #id_proveedor').val(id_proveedor);

});

//EDITAR PRODUCTO
$('#EditProv').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_proveedor = button.data('id_proveedor')
    var nombre = button.data('nombre')
    var telefono = button.data('telefono')
    var direccion = button.data('direccion')
    var estado = button.data('estado')
    
    var modal = $(this)

    modal.find('.modal-body #id_proveedor').val(id_proveedor);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #estado').val(estado);      
});

$('#VerProv').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_proveedor = button.data('id_proveedor')
    var nombre = button.data('nombre')
    var telefono = button.data('telefono')
    var direccion = button.data('direccion')
    var estado = button.data('estado')
    
    var modal = $(this)

    modal.find('.modal-body #id_proveedor').val(id_proveedor);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #estado').val(estado);      
});