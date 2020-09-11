$('.form-submit-limitV').on('submit',function (){
  $('.button-submit-limitV').attr('disabled','true');
});

//DESCARGAR Excel
$('#ExcelVenta').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_venta = button.data('id_venta')

  var modal = $(this)

  modal.find('.modal-body #id_venta').val(id_venta);


});

//DESCARGAR PDF
$('#PdfVenta').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_venta = button.data('id_venta')

  var modal = $(this)

  modal.find('.modal-body #id_venta').val(id_venta);


});

//ELIMINAR VENTA
$('#EliminarVenta').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_venta = button.data('id_venta')

  var modal = $(this)
 
  modal.find('.modal-body #id_venta').val(id_venta);


});

//VER VENTA
$('#VerVenta').on('show.bs.modal',function(event){
  
  var button = $(event.relatedTarget)
  var id_venta = button.data('id_venta')
  var id_documento = button.data('id_documento')
  var id_metodo_pago = button.data('id_metodo_pago')
  var fecha = button.data('fecha')
  var precio_total = button.data('precio_total')
  var subtotal= button.data('subtotal')
  var pagado = button.data('pagado')
  var devuelto = button.data('devuelto')
  var descuento = button.data('descuento')
  var total_sin_descuento = button.data('total_sin_descuento')
  var iva = button.data('iva')
  
  var modal = $(this)
  
  modal.find('.modal-body #id_venta').val(id_venta);
  modal.find('.modal-body #id_documento').val(id_documento);
  modal.find('.modal-body #fecha_factura').val(fecha);
  modal.find('.modal-body #id_metodo_pago').val(id_metodo_pago);
  modal.find('.modal-body #precio_total').val(precio_total);
  modal.find('.modal-body #subtotal').val(subtotal);
  modal.find('.modal-body #pagado').val(pagado);
  modal.find('.modal-body #devuelto').val(devuelto);
  modal.find('.modal-body #descuento').val(descuento);
  modal.find('.modal-body #total_sin_descuento').val(total_sin_descuento);
  modal.find('.modal-body #iva').val(iva);
  
  $('select').selectpicker('refresh');
  
  
});

//EDITAR VENTA
$('#EditVenta').on('show.bs.modal',function(event){
  
  var button = $(event.relatedTarget)
  var id_venta = button.data('id_venta')
  var id_documento = button.data('id_documento')
  var id_metodo_pago = button.data('id_metodo_pago')
  var fecha = button.data('fecha')
  var precio_total = button.data('precio_total')
  var subtotal= button.data('subtotal')
  var pagado = button.data('pagado')
  var devuelto = button.data('devuelto')
  var descuento = button.data('descuento')
  var total_sin_descuento = button.data('total_sin_descuento')
  var iva = button.data('iva')
  
  var modal = $(this)

  modal.find('.modal-body #id_venta').val(id_venta);
  modal.find('.modal-body #id_documento').val(id_documento);
  modal.find('.modal-body #fecha_factura').val(fecha);
  modal.find('.modal-body #id_metodo_pago').val(id_metodo_pago);
  modal.find('.modal-body #precio_total').val(precio_total);
  modal.find('.modal-body #subtotal').val(subtotal);
  modal.find('.modal-body #pagado').val(pagado);
  modal.find('.modal-body #devuelto').val(devuelto);
  modal.find('.modal-body #descuento').val(descuento);
  modal.find('.modal-body #total_sin_descuento').val(total_sin_descuento);
  modal.find('.modal-body #iva').val(iva);
  
  $('select').selectpicker('refresh');
  
  
});

$(document).ready(function(){
  //AGREGAR FILA A TABLA DE PRODUCTOS
  let row_number = 1;
  $("#add_row").click(function(e){
    e.preventDefault();
    $('select').selectpicker('destroy');
    let new_row_number = row_number - 1;
    $('#product' + row_number).html($('#product' + new_row_number).html()).find('td:first-child');
    $('select').selectpicker('render');
    $('#products_table').append('<tr id="product' + (row_number + 1) + '"></tr>');
    
  
   
    row_number++;  
    
  });
//BORRAR FILA DE PRODUCTOS
  $("#delete_row").click(function(e){
    e.preventDefault();
    if(row_number > 1){
      $("#product" + (row_number - 1)).html('');
      row_number--;
      calc();
    }
  });
  
  $('#products_table tbody').on('keyup change',function(){
		calc();
  });
  $('#iva').on('keyup change',function(){
		calc_total();
	});
 
});
//SELECCIONAR PRECIO DE PRODUCTO DINAMICAMENTE
$(document).on("change", ".product", function(e) {
  e.preventDefault();
  var selected = $('option:selected', this);
  var precio = $(this).parent().parent().find('#precioP').val(selected.attr('precio_venta')); 
});

//CALCULAR TOTAL DE CADA PRODUCTO SEGUN LA CANTIDAD
function calc()
{
	$('#products_table tbody tr').each(function(i, element) {
		var html = $(this).html();
		if(html!='')
		{
			var qty = $(this).find('.cantidad').val();
			var price = $(this).find('.precio').val();
			$(this).find('.total').val(qty*price);
			
			calc_total();
		}
    });
}
//CALCULAR TOTAL
function calc_total()
{
	total=0;
	$('.total').each(function() {
        total += parseInt($(this).val());
    });
  var pagado= $('#pagado').val();
  var pdescuento= $('#pdescuento').val();
  //MOSTRAR SUBTOTAL
  $('#sub_total').val(total.toFixed(2));
  //CALCULO DESCUENTO
 
  //MOSTRAR VALOR IVA SEGUN PORCENTAJE DE IVA
  tax_sum=total/100*$('#piva').val();
  descuento_sum=pdescuento/100*(total+tax_sum);
  $('#iva').val(tax_sum.toFixed(2));
  //MOSTRAR TOTAL DE LA VENTA
  $('#total').val(((tax_sum+total)-descuento_sum).toFixed(2));

  $('#tdescuento').val((tax_sum+total).toFixed(2));
  
  $('#vdescuento').val((descuento_sum).toFixed(2));
  
  //CALCULAR VUELTO
  var deuda =pagado-((tax_sum+total)-descuento_sum);
  if(deuda<0){
    $('#deuda').val(0);
  }else{
    $('#deuda').val((deuda).toFixed(2));
  }
  
}




