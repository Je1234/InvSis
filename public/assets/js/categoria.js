//ELIMINAR CATEGORIA
$('#EliminarCat').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_categoria = button.data('id_categoria')

    var modal = $(this)

    modal.find('.modal-body #id_categoria').val(id_categoria);

});

//RECUPERAR CATEGORIA
$('#RecuperarCat').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_categoria = button.data('id_categoria')

    var modal = $(this)

    modal.find('.modal-body #id_categoria').val(id_categoria);

});
//EDITAR CATEGORIA
$('#EditCat').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_categoria = button.data('id_categoria')
    var nom_categoria = button.data('nom_categoria')
    

    var modal = $(this)

    modal.find('.modal-body #id_categoria').val(id_categoria);
    modal.find('.modal-body #nom_categoria').val(nom_categoria);

    
});
//VER CATEGORIA
$('#VerCat').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id_categoria = button.data('id_categoria')
    var nom_categoria = button.data('nom_categoria')
    

    var modal = $(this)

    modal.find('.modal-body #id_categoria').val(id_categoria);
    modal.find('.modal-body #nom_categoria').val(nom_categoria);

    
});