//ELIMINAR COMPRA
$('#EliminarRol').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id = button.data('id')
  
    var modal = $(this)
   console.log(id);
    modal.find('.modal-body #id').val(id);
  
  
});

