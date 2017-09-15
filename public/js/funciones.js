var app, app_elementos;

var slug = function(str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();

    // remove accents, swap ñ for n, etc
    var from = "ãàáäâẽèéëêìíïîõòóöôùúüûñç·/_,:;";
    var to = "aaaaaeeeeeiiiiooooouuuunc------";
    for (var i = 0, l = from.length; i < l; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
};

(function($) {
    'use strict';
    app = function($form, op) {
        var $this = this;
        $this.id = 0;
        $this.form = $('#' + $form),
            $this.op = $.extend({
                'url': '',
                'botones': true,
                'teclado': true,
                'medotos': {
                    'buscar': 'buscar',
                    'guardar': 'crear',
                    'actualizar': 'actualizar',
                    'eliminar': 'eliminar',
                },
                'antes': function() { return true; },
                'limpiar': function() { return true; },
                'buscar': function() { return true; },
                'guardar': function() { return true; },
                'eliminar': function() { return true; }
            }, op);

        if ($this.form.prop("tagName") != "FORM") {
            console.log('El elemento "' + $form + '" no es un formulario.');
            return {};
        }

        $this.form.submit(function() {
            return false;
        });


        if ($this.op.url == '') {
            var actionForm = $this.form.attr('action');
            $this.op.url = actionForm != '' && actionForm != undefined ? actionForm : $url;
        }

        $this.op.url = $this.op.url.replace(/\/+$/, '') + '/';

        $this.guid = function() {
            function s4() {
                return Math.floor((1 + Math.random()) * 0x10000).toString(16).substring(1);
            }
            return s4() + s4() + '-' + s4() + '-' + s4() + '-' + s4() + '-' + s4() + s4() + s4();
        };

        $this.ucwords = function(str) {
            return (str + '').replace(/^([a-z\u00E0-\u00FC])|\s+([a-z\u00E0-\u00FC])/g, function($1) {
                return $1.toUpperCase();
            });
        };

        $this.bloquear = function() {
            $('#botonera').block({
                message: null,
                overlayCSS: {
                    opacity: 0,
                    cursor: 'wait'
                }
            });
        };

        $this.desbloquear = function() {
            $('#botonera').unblock();
        };

        $this.buscar = function($id, callback) {
            $this.id = parseInt($id);

            if (isNaN($this.id) || $this.id <= 0) {
                $this.id = 0;
                return;
            }

            if ($this.op.antes('buscar', $this) === false) {
                return false;
            }

            $this.bloquear();

            $.ajax({
                'url': $this.op.url + $this.op.medotos.buscar + '/' + $this.id,
                'data': {
                    id: $this.id
                },
                type: 'GET',
                'success': function(r) {
                    $('.modal-busqueda').modal('hide');
                    $this.rellenar(r);

                    if (r.s !== 's') return;

                    $('#eliminar', '#botonera').prop('disabled', false);

                    if (typeof(callback) === 'function') {
                        callback(r);
                    }

                    if (typeof($this.op.buscar) === 'function') {
                        $this.op.buscar(r);
                    }
                },
                'complete': function(x, e, o) {
                    ajaxComplete(x, e, o);
                    $this.desbloquear();
                }
            });
        };

        $this._limpiar = function() {
            $this.desbloquear();

            $this.id = 0;
            $this.form.clearForm();

            $('#eliminar', '#botonera').prop('disabled', true);
            $('input[type="hidden"]', $this.form).val('');
            $('select', $this.form).each(function() {
                var t = $(this);

                //t.val($('option:first', t).val());
                $('option:first', t).prop("selected", true);
            });

            $('.modal-busqueda').modal('hide');

            $("input[type!='hidden'], select, textarea", $this.form).first().focus();
        };

        $this._limpiar();

        $this.limpiar = function() {
            if ($this.op.antes('limpiar', $this) === false) {
                return false;
            }

            $this._limpiar();

            if (typeof($this.op.limpiar) === 'function') {
                $this.op.limpiar();
            }
        };

        $this.rellenar = function(r) {
            if (typeof(r) === 'string') {
                aviso(r);
                return false;
            }

            aviso(r.msj, 'info', 'Busqueda');

            if ($this.op.antes('rellenar', $this) === false) {
                return false;
            }

            $.each(r, function(id, valor) {
                var ele = $('#' + id, $this.form);
                if (!ele.length) { return; }

                if (ele.get(0).tagName === 'DIV') {
                    ele.text(valor);
                } else if (ele.attr('type') === "checkbox") {
                    ele.prop("checked", ele.val() == valor);
                } else if (ele.get(0).tagName === 'SELECT') {
                    if (!($.isArray(valor) || $.isPlainObject(valor))) {
                        ele.val(valor);
                    } else {
                        var $valorSelect = '';
                        ele.html('').append('<option value="">- Seleccione</option>');

                        $.each(valor, function(id, v) {
                            if (id == '_') {
                                $valorSelect = v;
                                return;
                            }
                            ele.append('<option value="' + id + '">' + v + '</option>');
                        });

                        ele.val($valorSelect);
                    }
                } else {
                    ele.val(valor);
                }
            });

            return true;
        };

        $this.selectCascada = function($valor, $selectObjetivo, $metodo, $callback) {
            //console.log($this.op.url + '->'+ $metodo);
            var $callback = $callback || function() {},
                dato = {};

            dato[$selectObjetivo] = [];

            if ($valor === '') {
                $this.rellenar(dato);
                return;
            }

            $.ajax({
                url: $this.op.url + $metodo,
                'data': {
                    id: $valor
                },
                type: 'GET',
                success: function(r) {
                    $this.rellenar(r);

                    $callback();
                }
            });
        }

        $this.guardar = function() {
            if ($this.op.antes('guardar', $this) === false) {
                return false;
            }

            $this.bloquear();

            var $opciones = {
                'url': $this.op.url + $this.op.medotos.guardar,
                'type': 'POST',
                'success': function(r) {
                    aviso(r);
                    $this.limpiar();

                    if (typeof($this.op.guardar) === 'function') {
                        $this.op.guardar(r);
                    }
                },
                'complete': function(x, e, o) {
                    ajaxComplete(x, e, o);
                    $this.desbloquear();
                }
            };

            if ($this.id > 0) {
                $opciones.url = $this.op.url + $this.op.medotos.actualizar + '/' + $this.id;
                $opciones.data = {
                    'id': $this.id,
                    '_method': 'put'
                };
            }

            $this.form.ajaxSubmit($opciones);
        }

        $this.eliminar = function() {
            if ($this.id === 0) return;

            if ($this.op.antes('eliminar', $this) === false) {
                return false;
            }

            bootbox.confirm("&iquest;Esta Seguro que Desea Eliminar Este Registro?", function(result) {
                if (!result) return;

                $.ajax({
                    'url': $this.op.url + $this.op.medotos.eliminar + '/' + $this.id,
                    'data': {
                        'id': $this.id,
                        '_method': 'delete'
                    },
                    'type': 'POST',
                    'success': function(r) {
                        aviso(r);
                        $this.limpiar();
                        if (typeof($this.op.eliminar) === 'function') {
                            $this.op.guardar(r);
                        }
                    },
                    'complete': function(x, e, o) {
                        ajaxComplete(x, e, o);
                        $this.desbloquear();
                    }
                });
            });
        };

        $('.btn', '#botonera').on('click', function() {
            $(this).blur();
        });

        if ($this.op.botones) {
            $('#limpiar', '#botonera').on('click', function() {
                $this.limpiar();
            });

            $('#guardar', '#botonera').on('click', function() {
                $this.guardar();
            });

            $('#eliminar', '#botonera').on('click', function() {
                $this.eliminar();
            });

            $('#buscar', '#botonera').on('click', function() {
                $('.modal-busqueda').modal('show');
            });
        }

        if ($this.op.teclado) {
            $.Shortcuts.add({
                type: 'down',
                mask: 'Ctrl+s, Ctrl+g',
                enableInInput: true,
                handler: function() {
                    $this.guardar();
                }
            }).add({
                type: 'down',
                mask: 'Ctrl+f, Ctrl+b',
                enableInInput: true,
                handler: function() {
                    $('.modal-busqueda').modal('show');
                }
            }).add({
                type: 'down',
                mask: 'Ctrl+d, Ctrl+e',
                enableInInput: true,
                handler: function() {
                    $this.eliminar();
                }
            }).add({
                type: 'down',
                mask: 'Ctrl+n, Ctrl+l',
                enableInInput: true,
                handler: function() {
                    $this.limpiar();
                }
            }).start();
        };
    };
}(jQuery));

var stack_bottomright = { "dir1": "up", "dir2": "left", "firstpos1": 25, "firstpos2": 25 };

function aviso(msj, t, titulo) {
    var _msj = msj,
        tipo = t,
        titulo = titulo || 'Sistema';
    if (typeof(msj) === 'object') {
        _msj = msj.msj || '';
        t = msj.s === 's';
    }

    if (_msj === undefined || _msj === '') {
        console.log("llamada a 'aviso' sin msj");
        return;
    }

    if (t === true) {
        tipo = 'success';
    } else if (t === false) {
        tipo = 'error';
    }

    var notice = new PNotify({
        title: titulo,
        text: _msj,
        type: tipo,
        hide: true,
        addclass: "stack-bottomright",
        stack: stack_bottomright,
        animate: {
            animate: true,
            in_class: 'zoomInLeft',
            out_class: 'zoomOutRight'
        }
    });

    notice.get().click(function() {
        notice.remove();
    });

    setTimeout(function() {
        notice.remove();
    }, 5000);
}

function datatable(tabla, opciones) {
    var tabla = $(tabla),
        ajax = opciones.ajax;

    tabla.data('verFiltros', true);
    tabla.data('verEliminados', false);
    tabla.data('verSoloEliminados', false);

    opciones.ajax = {
        'url': ajax,
        'data': function(d) {
            d.verEliminados = tabla.data('verEliminados');
            d.verSoloEliminados = tabla.data('verSoloEliminados');
        }
    };

    $(tabla).dataTable(opciones);

    menuDatatableModal(tabla);

    agregarFiltrosDatatable(tabla);
    return $(tabla).dataTable();
}

function menuDatatableModal(tabla) {
    var modal = $(tabla).parents('.modal');
    $(".btn-datatable .btn", modal).click(function() {
        $(this).parent().toggleClass('open');
    });

    $('body').on('click', function(e) {
        if (!$('.btn-datatable .dropdown-menu', modal).is(e.target) &&
            $('.btn-datatable .dropdown-menu', modal).has(e.target).length === 0 &&
            $('.btn-datatable.open', modal).has(e.target).length === 0
        ) {
            $(".btn-datatable", modal).removeClass('open');
        }
    });

    modal.find('.modal-header .btn-datatable ul li').click(function(e) {
        e.preventDefault();

        var t = $(this),
            check = false;
        if (t.attr('data-column')) {
            var column = $(tabla).DataTable().column(t.attr('data-column')),
                visibilidad = column.visible();

            column.visible(!visibilidad);
            check = !visibilidad;
        } else if (t.attr('data-vfc')) {
            $('tfoot', tabla).toggleClass('hidden');
            tabla.data('verFiltros', check = !tabla.data('verFiltros'));
        } else if (t.attr('data-re') || t.attr('data-sre')) {
            var variable = t.attr('data-re') ? 'verEliminados' : 'verSoloEliminados';

            tabla.data(variable, !tabla.data(variable));
            check = tabla.data(variable);

            $(tabla).dataTable().fnDraw();
        }

        if (check) {
            t.find('i.check').addClass("fa fa-check");
        } else {
            t.find('i.check').removeClass("fa fa-check");
        }
    });
}

function agregarFiltrosDatatable(tabla) {
    $('tfoot th', tabla).each(function() {
        var title = $(this).text();
        $(this).html('<input name=\'' + slug(title, '_') + '\' class="form-control" type="text" placeholder="Buscar ' + title + '" />');
    });

    $(tabla).DataTable().columns().every(function() {
        var that = this;

        $('input', this.footer()).on('keyup change', function() {
            if (that.search() !== this.value) {
                that.search(this.value).draw();
            }
        });
    });
}

function formData(form) {
    var data = {};

    $('input, select', form).each(function() {
        var ele = $(this),
            name = ele.attr('name'),
            value = ele.is(':checkbox') ?
            (ele.prop('checked') ? '1' : '0') :
            ele.val();
        if (/\[\]$/.test(name)) {
            if (typeof(data[name]) == 'undefined') {
                data[name] = [];
            }

            data[name].push(value);
        } else {
            data[name] = value;
        }
    });

    return data;
}

function number_format(amount, decimals) {

    amount += ''; // por si pasan un numero en vez de un string
    amount = parseFloat(amount.replace(/[^0-9\.]/g, '')); // elimino cualquier cosa que no sea numero o punto

    decimals = decimals || 0; // por si la variable no fue fue pasada

    // si no es un numero o es igual a cero retorno el mismo cero
    if (isNaN(amount) || amount === 0)
        return parseFloat(0).toFixed(decimals);

    // si es mayor o menor que cero retorno el valor formateado como numero
    amount = '' + amount.toFixed(decimals);

    var amount_parts = amount.split('.'),
        regexp = /(\d+)(\d{3})/;

    while (regexp.test(amount_parts[0]))
        amount_parts[0] = amount_parts[0].replace(regexp, '$1' + '.' + '$2');

    return amount_parts.join(',');
}