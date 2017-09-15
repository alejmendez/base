var aplicacion, $form, tabla;
$(function() {
    aplicacion = new app('formulario', {
        'limpiar': function() {
            tabla.ajax.reload();
        }
    });

    $form = aplicacion.form;

    tabla = datatable('#tabla', {
        ajax: $url + "datatable",
        columns: [
            { "data": "usuario_id", "name": "usuario_id" },
            { "data": "enviado_id", "name": "enviado_id" },
            { "data": "mensaje_id", "name": "mensaje_id" },
            { "data": "operacion_id", "name": "operacion_id" },
            { "data": "visto", "name": "visto" },
            { "data": "tipo_notificacion_id", "name": "tipo_notificacion_id" }
        ]
    });

    $('#tabla').on("click", "tbody tr", function() {
        aplicacion.buscar(this.id);
    });
});