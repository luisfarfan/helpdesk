/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
var message = "El campo es requerido";
var formObserve = null;
var functionObserveCallback = null;
//var rules = null;
var messageFunc = function() {
    return message;
};



function fn_enable(ctrl) {
    $(ctrl).removeAttr("disabled");
}

function fn_disable(ctrl, flag) {
    if (flag) {
        $(ctrl).attr("disabled", "disabled");
    } else {
        $(ctrl).val('').attr("disabled", "disabled");
    }
}

function fn_enread(ctrl) {
    $(ctrl).removeAttr("readonly");
}

function fn_disread(ctrl, flag) {
    if (flag) {
        $(ctrl).attr("readonly", "readonly");
    } else {
        $(ctrl).val('').attr("readonly", "readonly");
    }
}

function fn_clean(ctrl, tipo) {
    switch (tipo) {
        case 'radio':
            {
                $(ctrl).removeAttr('checked');
//                $(ctrl).trigger('change');
            }
            break;
        default:
            {
                $(ctrl).val('');
            }
    }
}

function dateDiff(date1, date2) {
    return  (date1.getTime() - date2.getTime()) >= 0;
}
/**
 * Determina si una fecha es considerada válida. Ademas, se puede utilizar el
 * segundo parametro para controlar la fecha máxima permintida.
 *
 * @param {str} txtDate Fecha en formato text m[m]/d[d]/yyyy
 * @param {date} date Fecha en formato date
 * @returns {Boolean}
 */
function isDate(txtDate, date)
{
    var currVal = txtDate;
    if (currVal == '')
        return false;
    //Declare Regex
    var rxDatePattern = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/;
    var dtArray = currVal.match(rxDatePattern); // is format OK?

    if (dtArray == null)
        return false;

    //Checks for mm/dd/yyyy format.
    dtMonth = dtArray[1];
    dtDay = dtArray[3];
    dtYear = dtArray[5];

    if (dtMonth < 1 || dtMonth > 12)
        return false;
    else if (dtDay < 1 || dtDay > 31)
        return false;
    else if ((dtMonth == 4 || dtMonth == 6 || dtMonth == 9 || dtMonth == 11) && dtDay == 31)
        return false;
    else if (dtMonth == 2)
    {
        var isleap = (dtYear % 4 == 0 && (dtYear % 100 != 0 || dtYear % 400 == 0));
        if (dtDay > 29 || (dtDay == 29 && !isleap))
            return false;
    }
    if (date) {
        return dateDiff(date, new Date(dtYear, dtMonth - 1, dtDay));
    }
    return true;
}

$.validator.addMethod("alfanumericopuntocoma", function(value, element) {
    return this.optional(element) || /^[a-zñA-ZÑ0-9\sáéíóúÁÉÍÓÚ&.]*$/i.test(value);
}, "Ingrese un dato alfanumerico punto o ampersand(&) valido"
        );


$.validator.addMethod("alfanumerico", function(value, element) {
    return this.optional(element) || /^[a-zñA-ZÑ0-9\sáéíóúÁÉÍÓÚ]*$/i.test(value);
}, "Ingrese un dato alfanumerico valido"
        );

$.validator.addMethod("alfanumericoz", function(value, element) {
    return this.optional(element) || /^[a-zñA-ZÑ1-9\sáéíóúÁÉÍÓÚ]*$/i.test(value);
}, "Ingrese un dato alfanumerico valido"
        );

$.validator.addMethod("regex", function(value, element, args) {
    if (args.indexOf('regex=') >= 0) {
        args = args.replace('regex=', '');
        args = '(^' + args.replace(/\(/gi, '[').replace(/\)/gi, ']').replace(/,/gi, '$|') + '$)';
        regex = new RegExp(args, 'i');
//        console.log(regex);
        return this.optional(element) || regex.test(value);
    }
    return true;
}, "Ingrese un dato valido"
        );

$.validator.addMethod("alfabeto", function(value, element) {
    return this.optional(element) || /^[a-zñA-ZÑ\sáéíóúÁÉÍÓÚ]*$/i.test(value);
}, "Ingrese un alfabeto valido"
        );

$.validator.addMethod("fijo", function(value, element) {
    return this.optional(element) || /^[0-9]{6,9}$/i.test(value);
}, "Ingrese un número fijo valido"
        );

$.validator.addMethod("celular", function(value, element) {
    return this.optional(element) || /(^[\*\#]{0,1}[0-9]{9}$)/i.test(value);
}, "Ingrese un número fijo valido"
        );

$.validator.addMethod("puerta", function(value, element) {
    return this.optional(element) || /(^[0-9]{4}$|^[a-zA-Z]{1}$|^[0-9]{4}[a-zA-Z]{1}$|^(SN)$)/i.test(value);
}, "Ingrese una puerta valida"
        );

$.validator.addMethod("url", function(value, element) {
    return this.optional(element) || /[-a-zA-Z0-9@:%_\+.~#?&//=]{2,256}\.[a-z]{2,4}\b(\/[-a-zA-Z0-9@:%_\+.~#?&//=]*)?/i.test(value);
}, "Ingrese una URL valida"
        );

$.validator.addMethod("rangeopcional", function(value, element, options) {
    var error = false;

    var valor_0 = options[0];
    var valor_1 = options[1];
    var valor_2 = options[2];

    if (value == '') {
        error = true;
    }
    else if (valor_2 == value) {
        error = true;
    } else if (value >= valor_0 && value <= valor_1) {
        error = true
    }

    return error;
}, "Ingrese un dato valido");

$.validator.addMethod("rangeopcionales", function(value, element, options) {
    var error = false;

    var valor_0 = options[0];
    var valor_1 = options[1];
    var valor_2 = options[2];
    var valor_3 = options[3];
    var valor_4 = options[4];
    var valor_5 = options[5];

    if (value == '') {
        error = true;
    }
    else if ($.inArray(parseInt(value), [valor_2, valor_3, valor_4, valor_5]) !== -1) {
        error = true;
    } else if (value >= valor_0 && value <= valor_1) {
        error = true
    }

    return error;
}, "Ingrese un dato valido");

$.validator.addMethod("requiredCallback", function(value, element, options) {
    var error = false;
    var _func = options;
    if (_func !== undefined) {
        var func = window[_func];
        if (func && typeof func === "function") {
            error = func(value, element);
        }
    }
    return error;
}, messageFunc);

$.validator.addMethod("rangeopcional2", function(value, element, options) {
    var error = false;

    var valor_0 = options[0];
    var valor_1 = options[1];
    var valor_2 = options[2];
    var valor_3 = options[3];

    if (value == '') {
        error = true;
    }
    else if (valor_3 == value) {
        error = true;
    } else if (valor_2 == value) {
        error = true;
    } else if (value >= valor_0 && value <= valor_1) {
        error = true
    }

    return error;
}, "Ingrese un dato valido");

$.validator.addMethod("regExp", function(value, element, options) {

    var filtroReg = new RegExp(options);
    var pasaFiltro = filtroReg.test(value);

    return (this.optional(element) || pasaFiltro);

}, "Ingrese un dato valido"
        );

function limitInputNumber() {
    $('input[type=number]').keypress(function(e) {
//    if(isNaN(this.value)){
//        this.value = null;
//        e.preventDefault();
//        return false;
//    }
        if ($.hasData(this)) {
            var nchars = parseInt($(this).data('length')) - 1;
            if (this.value.length > nchars) {
                this.value = this.value.slice(0, nchars);
            } else if (this.value === '') {
                this.value = this.value.slice(0, nchars);
            }
        }
    });
}

function performSubmitHandler(_form, _json) {
    var _vjson = _json;
    if (!$.isPlainObject(_json)) {
        _vjson = $.parseJSON(_json);
    }
    var _func = _vjson['submitHandler'];
    var _funce = _vjson['invalidHandler'];
    if (_func !== undefined) {
        var func = window[_func];
        if (func && typeof func === "function") {
            _vjson['submitHandler'] = function(form) {
                func(form);
            };
        }
    }
    if (_funce !== undefined) {
        var funce = window[_funce];
        if (funce && typeof funce === "function") {
            _vjson['invalidHandler'] = function(form, validator) {
                funce(form, validator);
            };
        }
    }
    $(_form).validate(_vjson);
}

function performSubmitMatrixHandler(_form, _json) {
    $(_form).validate({});
    var _vjson = _json;
    if (!$.isPlainObject(_json)) {
        _vjson = $.parseJSON(_json);
    }
    var reglas = _vjson['rules'];
    $.each(reglas, function(selector, regla) {
        $(selector).each(function() {
            $(this).rules('add', regla);
        });
    });
}

function pad(str, max) {
    str = str.toString();
    return str.length < max ? pad("0" + str, max) : str;
}

function mayusculas() {
    $('input:text').change(function() {
        $(this).val(this.value.toUpperCase());
    });
}

var range = function(start, end, step) {
    var range = [];
    var typeofStart = typeof start;
    var typeofEnd = typeof end;

    if (step === 0) {
        throw TypeError("Step cannot be zero.");
    }

    if (typeofStart == "undefined" || typeofEnd == "undefined") {
        throw TypeError("Must pass start and end arguments.");
    } else if (typeofStart != typeofEnd) {
        throw TypeError("Start and end arguments must be of same type.");
    }

    typeof step == "undefined" && (step = 1);

    if (end < start) {
        step = -step;
    }

    if (typeofStart == "number") {

        while (step > 0 ? end >= start : end <= start) {
            range.push(start);
            start += step;
        }

    } else if (typeofStart == "string") {

        if (start.length != 1 || end.length != 1) {
            throw TypeError("Only strings with one character are supported.");
        }

        start = start.charCodeAt(0);
        end = end.charCodeAt(0);

        while (step > 0 ? end >= start : end <= start) {
            range.push(String.fromCharCode(start));
            start += step;
        }

    } else {
        throw TypeError("Only string and number types are supported");
    }

    return range;

}

function getCalendarIndex(_anio, _mes) {
    var anio = parseInt(_anio);
    var mes = parseInt(_mes);
    var anioFin = new Date().getFullYear(), anioIni = anioFin - 5;
    var co = 0;
    for (i = anioFin; i >= anioIni; i--) {
        co += 1;
        if (anio === i) {
            break;
        }
    }
    return (co > 0) ? (co * 12 - mes) : co;// - 1;
}

//private function getIndexMesAnio($anio, $mes) {
//    $anioFin = date('Y');
//    $anioIni = $anioFin - 5;
//    $anios = range($anioIni, $anioFin);
//    $indexes = array_flip($anios);
//    $index = array_key_exists($anio, $indexes) ? $indexes[$anio] * 12 + $mes : -1;
//    return $index;
//}
function GuardadoParcial(form) {
    var action = form.attr('action');
    var oOptions = {
        type: 'POST',
        url: action,
        data: form.serializeArray()
    };
    var posting = $.ajax(oOptions);

    posting.done(function(response, textStatus, jqXHR) {
        var r = confirm("Datos Guardados Parcialmente \n ¿Desea Salir del Cuestionario?");
        if (r == true) {
            var url = CI.base_url + 'encuestador/index/viviendas/' + anio_retorno_menu + '/' + conglomerado_retorno_menu;
            location.href = url;
        }
    }).fail(function(response, textStatus, jqXHR) {
        alert("Error al Guardar Parcialmente");

    });
}


function guardarNota(pantalla) {
    var nota = $('textarea[name="notas"]').val();
    var nroOrden = getNroOrden();
    if ($.trim(nota) !== '') {
        var url = CI.base_url + 'nota/index';
        var oOptions = {
            type: 'POST',
            url: url,
            data: {'pantalla': pantalla, 'nota': nota, 'nroOrden': nroOrden}
        };
        var posting = $.ajax(oOptions);

        posting.done(function(response, textStatus, jqXHR) {
            alert('La nota fue guardada con éxito');
        }).fail(function(response, textStatus, jqXHR) {
            alert("Error al guardar la nota");
        });
    } else {
        alert('Ingrese el texto de la nota');
    }
}


function leerNota(pantalla) {
    var nota = $('textarea[name="notas"]').val();
    var nroOrden = getNroOrden();
    if ($.trim(nota) === '') {
        var url = CI.base_url + 'nota/leer';
        var oOptions = {
            type: 'POST',
            url: url,
            data: {'pantalla': pantalla, 'nroOrden': nroOrden}
        };
        var posting = $.ajax(oOptions);

        posting.done(function(response, textStatus, jqXHR) {
            $('textarea[name="notas"]').val(response.data.DESCRIPCION);
        }).fail(function(response, textStatus, jqXHR) {
            alert("Error al leer la nota");
        });
    }
}

function getNroOrden() {
    var cnroOrden = $('#frmseccion4_INDI_S2AP212_NRO');
    var nroOrden = null;
    if (cnroOrden.length > 0) {
        nroOrden = cnroOrden.val();
    } else {
        cnroOrden = $('#frmseccion4b_INDI_S2AP212_NRO');
    }
    if (cnroOrden.length > 0) {
        nroOrden = cnroOrden.val();
    } else {
        cnroOrden = $('#frmseccion10_INDI_S2AP212_NRO');
    }
    if (cnroOrden.length > 0) {
        nroOrden = cnroOrden.val();
    } else {
        cnroOrden = $('#frmsecion8_1_SAL_S8P801_NRO_ORDEN');
    }
    if (cnroOrden.length > 0) {
        nroOrden = cnroOrden.val();
    }
    return nroOrden;
}

$(function() {
    if ($('#frm_id').length > 0) {
        if (rules) {
            performSubmitHandler('#frm_id', rules);
        }
    }
    limitInputNumber();
});

$('input[type="checkbox"]').change(function() {
    if ($(this).is(':checked')) {
        if ($('#frm_id').length > 0) {
            $('#c' + this.id).remove();
        }
    } else {
        if ($('#frm_id').length > 0) {
            $('#frm_id').append('<input type="hidden" name="' + this.name + '" id="c' + this.id + '" value="" >');
        }
    }
});

$('input[type="radio"]').click(function() {
    var control = $(this);
    
    if (control.attr('checked')) {
        control.removeAttr('checked');
    } else {
        control.attr('checked', true);
    }
});

//$('input[type="checkbox"]').change(function() {
//    if ($(this).is(':checked')) {
//        if ($('#frm_id').length > 0) {
//            $('#c' + this.id).remove();
//        }
//    } else {
//        if ($('#frm_id').length > 0) {
//            $('#frm_id').append('<input type="hidden" name="' + this.name + '" id="c' + this.id + '" value="" >');
//        }
//    }
//});
