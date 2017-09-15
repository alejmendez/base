var aplicacion, $form, tabla, $archivo_actual = '',
    $archivos = {},
    cordenadasImagen;
$(function() {
    aplicacion = new app('formulario', {
        'antes': function(accion) {
            $("#archivos").val(jsonToString($archivos));
        },
        'limpiar': function() {
            console.log('holaaaa');
            $archivos = {};

            $("table tbody tr", "#fileupload").remove();

        },

        'buscar': function(r) {

            $('#btn1').click();

            $("table tbody", "#fileupload").html(tmpl("template-download", r));
            $("table tbody .fade", "#fileupload").addClass('in');

            var archivos = r.files;
            $archivos = {};
            for (var i in archivos) {
                $archivos[archivos[i].id] = archivos[i].data;
            }
        }
    });

    $form = aplicacion.form;

    $('#buscar').remove();
    $('#eliminar').remove();

    $('#fileupload').fileupload({
        // Uncomment the following to send cross-domain cookies:
        //xhrFields: {withCredentials: true},
        url: $url + 'subir',
        disableImageResize: /Android(?!.*Chrome)|Opera/.test(window.navigator.userAgent),
        maxFileSize: 999000,
        //formData: {example: 'test'},
        acceptFileTypes: /(\.|\/)(gif|jpe?g|png)$/i
    }).bind('fileuploaddone', function(e, data) {
        var archivo = data.result.files[0];
        $archivos[archivo.id] = archivo.data;
    });
    $('#fileupload').on('click', '.btn-info', function(evn) {
        evn.preventDefault();
        $archivo_actual = $(this).parents('tr').data('id');

        $("#editar_imagen").modal('show');

        $('#contImagen').html('<img src="' + $(this).data('url') + '" class="img-responsive" style="width: 100%;" />');

        $('img', '#contImagen').Jcrop({
            onChange: dataImagen,
            onSelect: dataImagen,
            boxWidth: 450,
            boxHeight: 400
        });

        $("#descripcion", "#editar_imagen").val($archivos[$archivo_actual].descripcion);
        $("#leyenda", "#editar_imagen").val($archivos[$archivo_actual].leyenda);

        return false;
    });

    $('#fileupload').on('click', '.btn-danger', function(evn) {
        evn.preventDefault();
        delete $archivos[$(this).parents('tr').data('id')];
    });
});

function dataImagen(cordenadas) {
    cordenadasImagen = cordenadas;
}

function stringToJson(str) {
    return $.parseJSON(str);
}

function jsonToString(json) {
    return JSON.stringify(json);
}