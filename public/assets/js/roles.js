//OBTENER ID USUARIO A RENOVAR
$('#RecuperarUsuario').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id = button.data('id')

  var modal = $(this)

  modal.find('.modal-body #id').val(id);

});

//EDITAR USUARIO
$('#EditUser').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id = button.data('id')
  var name = button.data('name')
  var email = button.data('email')
  var tipo_plan = button.data('tipo_plan')


  var modal = $(this)

  modal.find('.modal-body #id').val(id);
  modal.find('.modal-body #name').val(name);
  modal.find('.modal-body #email').val(email);

  
  $('select').selectpicker('refresh');
  
});

//ELIMINAR COMPRA
$('#EliminarRol').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id = button.data('id')
  
    var modal = $(this)
 
    modal.find('.modal-body #id').val(id);
  
  
  });

  $('#EliminarUsuario').on('show.bs.modal',function(event){

    var button = $(event.relatedTarget)
    var id = button.data('id')
  
    var modal = $(this)

    modal.find('.modal-body #id').val(id);
  
  
  });