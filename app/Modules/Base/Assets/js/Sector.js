var aplicacion, $form, tabla;
$(function() {
	aplicacion = new app('formulario', {
		'limpiar' : function(){
			tabla.fnDraw();
		}
	});

	$form = aplicacion.form;

	tabla = datatable('#tabla', {
		ajax: $url + "datatable",
		columns: [{"data":"nombre","name":"sectores.nombre"},{"data":"parroquias","name":"parroquias.nombre"}]
	});
	
	$('#tabla').on("click", "tbody tr", function(){
		aplicacion.buscar(this.id);
	});
});