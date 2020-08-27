//ELIMINAR CLIENTE
$('#EliminarCliente').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_cliente = button.data('id_cliente')

    var modal = $(this)

    modal.find('.modal-body #id_documento').val(id_cliente);

});

//VER CLIENTE
$('#VerCliente').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_documento = button.data('id_cliente')
    var id_tipo = button.data('id_tipo')
    var nombre = button.data('nombres')
    var apellido = button.data('apellidos')
    var correo = button.data('correo')
    var direccion = button.data('direccion')
    var telefono = button.data('telefono')
    var celular = button.data('celular')
    var fecha = button.data('fecha')

    var modal = $(this)

    modal.find('.modal-body #documento').val(id_documento);
    modal.find('.modal-body #id_tipo_documento').val(id_tipo);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #apellido').val(apellido);
    modal.find('.modal-body #correo').val(correo);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #celular').val(celular);
    modal.find('.modal-body #fecha').val(fecha);
    $('select').selectpicker('refresh');
});

//EDITAR CLIENTE
$('#EditCliente').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_documento = button.data('id_cliente')
    var id_tipo = button.data('id_tipo')
    var nombre = button.data('nombres')
    var apellido = button.data('apellidos')
    var correo = button.data('correo')
    var direccion = button.data('direccion')
    var telefono = button.data('telefono')
    var celular = button.data('celular')
    var fecha = button.data('fecha')

    var modal = $(this)
    modal.find('.modal-body #documento').val(id_documento);
    modal.find('.modal-body #id_documento').val(id_documento);
    modal.find('.modal-body #id_tipo_documento').val(id_tipo);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #apellido').val(apellido);
    modal.find('.modal-body #correo').val(correo);
    modal.find('.modal-body #direccion').val(direccion);
    modal.find('.modal-body #telefono').val(telefono);
    modal.find('.modal-body #celular').val(celular);
    modal.find('.modal-body #fecha').val(fecha);
    $('select').selectpicker('refresh');
});



