var aplicacion, $form, tabla = false,
    to, $arbol, $valor;

$(function() {
    aplicacion = new app("formulario", {
        'antes': function(accion) {
            if (accion !== 'guardar') return;
            tabla.ajax.reload();
            $("#permisos", $form).val(data_arbol());
        },
        'limpiar': function() {
            $arbol.uncheck_all();
            tabla.ajax.reload();
            $("#foto").prop("src", imagenDefault);
            $('#usuario').prop('readonly', false);

            $('#tipo_telefono_id').prop('disabled', false);
            $('#tipo_persona_id').prop('disabled', false);
            $('#nombres').prop('disabled', false);
            $('#numero').prop('disabled', false);
            $('#cuenta').prop('disabled', false);
            //$('#sucursal_id').prop('disabled', true);
        },
        'buscar': function(r) {
            $arbol.uncheck_all();
            $("#foto").prop("src", r.foto);
            $('#usuario').prop('readonly', true);
            var $estructura = $arbol.get_json('#', { flat: true });

            for (var i in $estructura) {
                var estructura = $estructura[i].li_attr['data-direccion'];

                if ($estructura[i].icon == "fa fa-folder-o" ||
                    estructura.substring(0, 1) == '#' ||
                    r.permisos.indexOf(estructura) === -1) {
                    continue;
                }

                $arbol.check_node($estructura[i].id);
            }

            /*if( r.empresass_id != ''){
            	for (var i in r.empresass_id) {
            		aplicacion.selectCascada(r.empresass_id[i], 'sucursal_id','sucursal');
            	}
            }*/


            $('#dni').val(r.persona.dni);
            validar(r.persona.dni, 'dni', '#dni');
        }
    });

    //$('#sucursal_id').prop('disabled', true);

    $('#cargos_id').change(function() {


        if ($(this).val() == null) {

            return false;
        }

        $valor = $(this).val();
        $('#sucursal_id').prop('disabled', true);

        for (var i in $valor) {

            if ($valor[i] == 5) {
                $('#sucursal_id').prop('disabled', false);
            } else {
                //$('#sucursal_id').prop('disabled', true);
            }
        }

        //aplicacion.selectCascada($(this).val(), 'parroquia_id','parroquias');
    });
    $('#empresass_id').change(function() {


        if ($(this).val() == null) {

            return false;
        }

        aplicacion.selectCascada($(this).val(), 'sucursal_id', 'sucursal');
    });


    $("#upload_link").on('click', function(e) {
        e.preventDefault();
        $("#upload:hidden").trigger('click');
    });

    $form = aplicacion.form;

    arbol();

    $("#dni", $form).numeric({ min: 0 });
    $("#numero", $form).mask("0999-999-9999");

    $('#input_buscar').keyup(function() {
        if (to) { clearTimeout(to); }
        to = setTimeout(function() {
            $arbol.search($('#input_buscar').val());
        }, 250);
    });

    $('#dni').blur(function() {
        if ($(this).val() == '') {

            $('#tipo_persona_id').prop('disabled', false);
            $('#tipo_telefono_id').prop('disabled', false);
            $('#nombres').prop('disabled', false);
            $('#numero').prop('disabled', false);
            $('#cuenta').prop('disabled', false);
            aplicacion.limpiar();
            return false;
        }
        validar($(this).val(), 'dni', '#dni');
    });
    tabla = datatable('#tabla', {
        ajax: $url + "datatable",
        columns: [
            { data: 'usuario', name: 'app_usuario.usuario' },
            { data: 'dni', name: 'personas.dni' },
            { data: 'nombres', name: 'personas.nombres' }
        ]
    });

    $('#tabla').on("click", "tbody tr", function() {
        aplicacion.buscar(this.id);
    });
});

function data_arbol() {
    var $estructura = $arbol.get_json('#', { flat: true }),
        $seleccionados = $arbol.get_checked(),
        $data = [],
        direccion = '';

    $('.jstree-checkbox.jstree-undetermined', '#arbol').each(function() {
        var id = $(this).parent().parent().attr('id');

        if (id == '#') {
            return;
        }

        $seleccionados.push(id);
    });

    for (var i in $estructura) {
        if ($seleccionados.indexOf($estructura[i].id) === -1) {
            continue;
        }

        direccion = $estructura[i].li_attr['data-direccion'];

        if (direccion != '#' && $data.indexOf(direccion) === -1) {
            $data.push(direccion);
        }
    }

    return $data;
}

function arbol() {
    $.ajax({
        url: $url + 'arbol',
        success: function(r) {
            $('#arbol')
                .html('')
                .jstree('destroy')
                .on('changed.jstree', function(e, data) {
                    $("#padre").val(data.instance.get_node(data.selected[0]).id);
                    //aplicacion.id = data.instance.get_node(data.selected[0]).id;
                })

            .jstree({
                'core': {
                    //"animation" : 0,
                    "check_callback": true,
                    "themes": { "stripes": true },
                    'force_text': true,
                    "multiple": true,
                    'data': r
                },
                "types": {
                    "default": {
                        "icon": "fa fa-folder-o",
                        "valid_children": ["default", "file"]
                    },
                    "todo": {
                        "icon": "fa fa-sitemap",
                        "valid_children": []
                    },
                    "arch": {
                        "icon": "fa fa-file-text-o",
                        "valid_children": []
                    },
                    "metodo": {
                        "icon": "fa fa-gears",
                        "valid_children": []
                    }
                },
                "redraw_node": function(nodes) {
                    console.log(nodes);
                },
                "checkbox": {
                    //"keep_selected_style" : false
                },
                "plugins": [
                    "search", "checkbox", "types"
                ]
            });

            $arbol = $('#arbol').jstree(true);
        }
    });
}

//valida DNI, RIF y CORREO
function validar($dato, $campo, $id) {
    /*
    $dato = dato a validar
    $tipo = que campo validar
	
    */
    $.ajax({
        url: $url + 'validar',
        type: 'POST',
        data: {
            'dato': $dato,
        },
        success: function(r) {
            if (r.s == 'n') {

                return false
            }

            $('#tipo_persona_id').val(r.persona.tipo_persona_id).prop('disabled', true);
            $('#nombres').val(r.persona.nombres).prop('disabled', true);;
            if (r.telefono != 'n') {
                $('#tipo_telefono_id').val(r.telefono.tipo_telefono_id).prop('disabled', true);
                $('#numero').val(r.telefono.numero).prop('disabled', true);
            }
            if (r.correo != 'n') {
                $('#cuenta').val(r.correo.correo).prop('disabled', true);
            }
        }
    });
}