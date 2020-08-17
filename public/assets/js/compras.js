//ELIMINAR VENTA
$('#EliminarCompra').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_compra = button.data('id_compra')

  var modal = $(this)
 console.log(id_compra);
  modal.find('.modal-body #id_compra').val(id_compra);


});

//DESCARGAR EXCEL
$('#ExcelCompra').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_compra = button.data('id_compra')

  var modal = $(this)
 console.log(id_compra);
  modal.find('.modal-body #id_compra').val(id_compra);


});

//DESCARGAR PDF
$('#PdfCompra').on('show.bs.modal',function(event){

  var button = $(event.relatedTarget)
  var id_compra = button.data('id_compra')

  var modal = $(this)
 console.log(id_compra);
  modal.find('.modal-body #id_compra').val(id_compra);


});



$(document).ready(function(){
  //AGREGAR FILA A TABLA DE PRODUCTOS
  $('select').selectpicker('render');
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
