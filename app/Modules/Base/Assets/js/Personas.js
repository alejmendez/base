var aplicacion, $form, tabla;

$(function() {
    //---------------------------------------------------------------------
    //data table y sistema	
    aplicacion = new app('formulario', {
        'limpiar': function() {
            tabla.fnDraw();
            $('#cuentas').html('');
            $('#telefonos').html('');
            $('#correos').html('');

        },
        'buscar': function(r) {
            tipo_persona(r.tipo_persona_id);
            //buscar_template($adonde,$persona_id,$template,$button,$div)

            buscar_template('telefonos', r.id, "tmpl-demo3", "agregar_telefonos", 'telefonos');
            buscar_template('correo', r.id, "tmpl-demo5", "agregar_correos", 'correos');

        }
    });

    aplicacion.id = id;

    $form = aplicacion.form;
    $("#fecha_nacimiento", $form).datepicker({
        altFormat: "yyyy-mm-dd"
    });

    tabla = datatable('#tabla', {
        ajax: $url + "datatable",
        columns: [{ "data": "tipo_persona", "name": "tipo_persona.nombre" },
            { "data": "dni", "name": "personas.dni" },
            { "data": "nombres", "name": "personas.nombres" }
        ]
    });

    //tipo_persona.nombre as tipo_persona
    $('#tabla').on("click", "tbody tr", function() {
        aplicacion.buscar(this.id);
    });

    //---------------------------------------------------------------------
    //fotos
    $("#upload_link").on('click', function(e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });


    //---------------------------------------------------------------------
    //selec cascadas 
    $('#estados_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'ciudades_id', 'ciudades');
        aplicacion.selectCascada($(this).val(), 'municipio_id', 'municipios');
    });

    $('#municipios_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'parroquias_id', 'parroquias');
    });

    $('#parroquias_id').change(function() {
        aplicacion.selectCascada($(this).val(), 'sectores_id', 'sectores');
    });

    //---------------------------------------------------------------------
    //DATOS BANCARIOS
    //busca informacion de los bancos

    //buscar_template('bancos','',"tmpl-demo","agregar",'cuentas');


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

    $("#fecha_nacimiento", $form).datepicker({
        altFormat: "yyyy-mm-dd"
    });

    //---------------------------------------------------------------------		

});

function tipo_persona($valor) {

    if ($valor != 1 && $valor != 2) {
        $('.datos_generales').css('display', 'none');
    } else {
        $('.datos_generales').css('display', 'block');
    }

}

function buscar_template($adonde, $persona_id, $template, $button, $div) {
    //funcion que busca los los datos de los formularios con template
    //---------------------------------------------------------------------
    //DATOS BANCARIOS
    //busca informacion de los bancos
    if ($persona_id == '') {
        $persona_id = 0;
    }

    $.ajax({
        'url': $url + $adonde,
        'data': {
            'id': $persona_id
        },
        'success': function(r) {
            console.log(r);
            if (r.datos.length) {
                $("#" + $div).append(tmpl($template, r));
            } else {
                $("#" + $button).click();
            }
        }
    });
    //---------------------------------------------------------------------	
}