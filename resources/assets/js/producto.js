//ELIMINAR PRODUCTO
$('#EliminarProduct').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_producto = button.data('id_producto')

    var modal = $(this)

    modal.find('.modal-body #id_producto').val(id_producto);
    
});


//EDITAR PRODUCTO
$('#EditProduct').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_producto = button.data('id_producto')
    var id_ubicacion = button.data('id_ubicacion')
    var id_proveedor = button.data('id_proveedor')
    var nombre = button.data('nombre')
    var marca = button.data('marca')
    var precio_venta = button.data('precio_venta')
    var precio_compra = button.data('precio_compra')
    var id_categoria = button.data('id_categoria')
    var stock = button.data('stock')
    var descripcion = button.data('descripcion')
    var ruta_imagen = button.data('ruta_imagen')

    var modal = $(this)

    modal.find('.modal-body #id_producto').val(id_producto);
    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
    modal.find('.modal-body #id_proveedor').val(id_proveedor);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #marca').val(marca);
    modal.find('.modal-body #precio_venta').val(precio_venta);
    modal.find('.modal-body #precio_compra').val(precio_compra);
    modal.find('.modal-body #id_categoria').val(id_categoria);
    modal.find('.modal-body #stock').val(stock);
    modal.find('.modal-body #descripcion').val(descripcion);
    
    $('select').selectpicker('refresh');
    
});

//VER PRODUCTO
$('#VerProduct').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_producto = button.data('id_producto')
    var id_ubicacion = button.data('id_ubicacion')
    var id_proveedor = button.data('id_proveedor')
    var nombre = button.data('nombre')
    var marca = button.data('marca')
    var precio_venta = button.data('precio_venta')
    var precio_compra = button.data('precio_compra')
    var id_categoria = button.data('id_categoria')
    var stock = button.data('stock')
    var descripcion = button.data('descripcion')
    var ruta_imagen = button.data('ruta_imagen')

    var modal = $(this)
    
    modal.find('.modal-body #id_producto').val(id_producto);
    modal.find('.modal-body #id_ubicacion').val(id_ubicacion);
    modal.find('.modal-body #id_proveedor').val(id_proveedor);
    modal.find('.modal-body #nombre').val(nombre);
    modal.find('.modal-body #marca').val(marca);
    modal.find('.modal-body #precio_venta').val(precio_venta);
    modal.find('.modal-body #precio_compra').val(precio_compra);
    modal.find('.modal-body #id_categoria').val(id_categoria);
    modal.find('.modal-body #stock').val(stock);
    modal.find('.modal-body #descripcion').val(descripcion);
    $('select').selectpicker('refresh');
    
    
});

//MOSTRAR NOMBRE IMAGEN PRODUCTO AL AGREGAR
$('#customFile').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
})

//MOSTRAR NOMBRE IMAGEN PRODUCTO AL EDITAR
$('#imagen').on('change',function(){
                //get the file name
                var fileName = $(this).val();
                //replace the "Choose a file" label
                $(this).next('.custom-file-label').html(fileName);
 })
        
