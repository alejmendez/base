var aplicacion;
$(function() {

    aplicacion = new app('formulario', {

    });

    $("#fecha_nacimiento").datepicker({
        altFormat: "yyyy-mm-dd"
    });


    buscar_template('telefonos', $id, "tmpl-demo3", "agregar_telefonos", 'telefonos');

    buscar_template('correo', $id, "tmpl-demo5", "agregar_correos", 'correos');

    aplicacion.buscar($id);

    $('#guardar').on('click', function() {

        aplicacion.guardar();
    });


    $('#formulario').submit(function() {
        $(this).ajaxSubmit({
            'url': $url + 'actualizar',
            'data': {
                '_method': 'put'
            },
            'type': 'POST',
            'success': function(r) {
                aviso(r);
            }
        });
        return false;
    });

    $('#formulario_clave').submit(function() {
        $(this).ajaxSubmit({
            'url': $url + 'clave',
            'data': {
                '_method': 'put'
            },
            'type': 'POST',
            'success': function(r) {
                aviso(r);

                $('#password, #password_confirmation').val('');
            }
        });
        return false;
    });
    //fin de contraseña

    $("#upload_link").on('click', function(e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });

    $("#upload").on('change', function() {
        $('#formulario_imagen').ajaxSubmit({
            'url': $url + 'cambio',
            'type': 'POST',
            'success': function(r) {
                aviso(r);
                var foto = r.foto + '?_=' + (new Date().getTime());
                $("#foto").attr('src', foto);
                $(".img-circle", ".top-menu").attr('src', foto);
            }
        });
    });

    //---------------------------------------------------------------------
    //selec cascadas 

    $('#estados_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'ciudades_id', 'ciudades');
        aplicacion.selectCascada($(this).val(), 'municipio_id', 'municipios');
    });

    $('#municipio_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'parroquia_id', 'parroquias');
    });

    $('#parroquia_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'sector_id', 'sectores');
    });
    //---------------------------------------------------------------------
    //DATOS BANCARIOS
    //busca informacion de los bancos

    //buscar_template('bancos','',"tmpl-demo","agregar",'cuentas');

    $("#agregar").on('click', function() {
        $("#cuentas").append(tmpl("tmpl-demo2"));
    });

    //---------------------------------------------------------------------	
    //busca informacion de los tlf

    //buscar_template('telefonos','',"tmpl-demo3","agregar_telefonos",'telefonos');

    $("#agregar_telefonos").on('click', function() {
        $("#telefonos").append(tmpl("tmpl-demo4"));
    });
    //---------------------------------------------------------------------	
    //busca informacion de los tlf

    //buscar_template('correo','',"tmpl-demo5","agregar_correos",'correo');

    $("#agregar_correos").on('click', function() {
        $("#correos").append(tmpl("tmpl-demo6"));
    });
    //---------------------------------------------------------------------
    //tipo de persona

    $('#tipo_persona_id').on('change', function() {
        tipo_persona($(this).val());
    });
    //---------------------------------------------------------------------	


});

function buscar_template($adonde, $persona_id, $template, $button, $div) {
    //funcion que busca los los datos de los formularios con template
    //---------------------------------------------------------------------
    //DATOS BANCARIOS
    //busca informacion de los bancos
    $.ajax({
        'url': $url + $adonde,
        'data': {
            'id': $persona_id
        },
        'success': function(r) {
            if (r.datos.length) {
                $("#" + $div).append(tmpl($template, r));
            } else {
                $("#" + $button).click();
            }
        }
    });
    //---------------------------------------------------------------------	
}