var ctrlciiu = null;
var ciiu = '';
function getProvincias(iddepartamento, cmbProvincia, cmbDistrito) {
    var oOptions = {
        type: 'POST',
        url: base_url + 'index.php/caratulaController/getProvincias',
        data: {'iddepartamento': iddepartamento}
    };
    var posting = $.ajax(oOptions);
    var $select = $('#' + cmbProvincia);
    $select.find('option').remove();
    $('#' + cmbDistrito).find('option').remove();
    posting.done(function(response, textStatus, jqXHR) {
        response = JSON.parse(response);
        $.each(response, function(key, value)
        {
            $select.append('<option value=' + value.key + '>' + value.value + '</option>');
        });
    }).fail(function(response, textStatus, jqXHR) {
        console.log(textStatus);
    });
}

function getDistritos(iddepartamento, idprovincia, cmbDistrito) {
    var oOptions = {
        type: 'POST',
        url: base_url + 'index.php/caratulaController/getDistritos',
        data: {'iddepartamento': iddepartamento, 'idprovincia': idprovincia}
    };
    var posting = $.ajax(oOptions);
    var $select = $('#' + cmbDistrito);
    $select.find('option').remove();
    posting.done(function(response, textStatus, jqXHR) {
        response = JSON.parse(response);
        $.each(response, function(key, value)
        {
            $select.append('<option value=' + value.key + '>' + value.value + '</option>');
        });
    }).fail(function(response, textStatus, jqXHR) {
        console.log(textStatus);
    });
}

function getCiiu(nombre) {
    var oOptions = {
        type: 'POST',
        url: base_url + 'index.php/caratulaController/getCiiu',
        data: {'nombre': nombre}
    };
    var posting = $.ajax(oOptions);
    var $tabla = $('#tblciiu tbody');
    $tabla.find('tr').remove();
    posting.done(function(response, textStatus, jqXHR) {
        response = JSON.parse(response);
        $.each(response, function(key, value)
        {
            $tabla.append('<tr class="rowciiu" data-ciiu="' + value.ciiu + '"><td>' + value.ciiu + '</td><td>' + value.nombre + '</td></tr>');
        });
        if (response.length === 0) {
            $('#divciiuno').removeClass('divoculto');
            $('#divciiu').addClass('divoculto');
        } else {
            eventoTabla();
        }
    }).fail(function(response, textStatus, jqXHR) {
        console.log(textStatus);
    });
}

function eventoTabla() {
    $('#divciiu').removeClass('divoculto');
    $('#divciiuno').addClass('divoculto');
    $('.rowciiu').click(function() {
        $('.rowciiu').removeClass('alert-danger');
        var fila = $(this);
        fila.toggleClass('alert-danger');
        ciiu = fila.data('ciiu');
    });
}

$('#frm_CCDD').change(function() {
    getProvincias(this.value, 'frm_CCPP', 'frm_CCDI');
});

$('#frm_CCPP').change(function() {
    var iddepartamento = $('#frm_CCDD').val();
    getDistritos(iddepartamento, this.value, 'frm_CCDI');
});

$('#frm_C19_CCDD').change(function() {
    getProvincias(this.value, 'frm_C19_CCPP', 'frm_C19_CCDI');
});

$('#frm_C19_CCPP').change(function() {
    var iddepartamento = $('#frm_C19_CCDD').val();
    getDistritos(iddepartamento, this.value, 'frm_C19_CCDI');
});

$('#btnBuscar').click(function() {
    var nombre = $('#frm_busqueda').val();
    if ($.trim(nombre) !== '') {
        getCiiu(nombre);
    } else {
        alert('Escriba la actividad economica a buscar');
    }
});

$('#btnAceptar').click(function() {
    var nombre = $('#frm_busqueda').val();
    if (ciiu !== '') {
        fnciiu();
    } else {
        alert('Escoja la actividad economica de la lista');
    }
});

function save(form) {
    var departamento = $('#frm_CCDD option:selected').text();
    var provincia = $('#frm_CCPP option:selected').text();
    var distrito = $('#frm_CCDI option:selected').text();
    $('#frm_DEPARTAMENTO').val((departamento === 'SELECCIONE') ? '' : departamento);
    $('#frm_PROVINCIA').val((provincia === 'SELECCIONE') ? '' : provincia);
    $('#frm_DISTRITO').val((distrito === 'SELECCIONE') ? '' : distrito);
    form.submit();
}

function save2(form) {
    var departamento = $('#frm_C19_CCDD option:selected').text();
    var provincia = $('#frm_C19_CCPP option:selected').text();
    var distrito = $('#frm_C19_CCDI option:selected').text();
    $('#frm_C19_DPTO').val((departamento === 'SELECCIONE') ? '' : departamento);
    $('#frm_C19_PROV').val((provincia === 'SELECCIONE') ? '' : provincia);
    $('#frm_C19_DIST').val((distrito === 'SELECCIONE') ? '' : distrito);
    form.submit();
}

$('#btn_C14_COD').click(function() {
    mostrarCiiu(this);
});

$('#btn_C15A_COD').click(function() {
    mostrarCiiu(this);
});

$('#btn_C15B_COD').click(function() {
    mostrarCiiu(this);
});

$('#btn_C15C_COD').click(function() {
    mostrarCiiu(this);
});

$('#btn_C15D_COD').click(function() {
    mostrarCiiu(this);
});

function mostrarCiiu(ctrl) {
    var $alto = $(window).height();
    $total = ($alto - 75) - 24;
    fn_clean('#frm_busqueda');
    $('#divciiuno').addClass('divoculto');
    $('#divciiu').addClass('divoculto');
    ciiu = '';
//    $("#divciiu").css({height: $total + 'px'});
    $(window).resize(function() {
        var $total = ($(window).height() - 75) - 24;
//        $("#divciiu").css({height: $total + 'px'});
    });
    $('#matriz_modal_personas').modal();
    ctrlciiu = document.getElementById(ctrl.id.replace('btn', 'frm'));
}
function fnciiu() {
    $('#matriz_modal_personas').modal('hide');
    ctrlciiu.value = ciiu;
    ciiu = '';
}

function flujo1(value, el) {
    return ($.trim($('#frm_MZ').val()) !== '') ? $.trim(value) !== '' : true;
}

function flujo2(value, el) {
//    return ($.trim($('#frm_PISO').val()) !== '') ? $.trim(value) !== '' : true;
    return true;
}

function regla3(value, el) {
//    Si C12 = 8 & C11 < 18
//		Si C12= 10 | 11 y C11 < 20
    var flag = true;
    var c11 = $('#frm_C11').val();
    c11 = (c11) ? parseInt(c11) : 0;
    message = 'Error: No corresponde nivel educativo con edad';
    if (value === '8' && c11 < 18) {
        flag = false;
    } else if (value === '10' || value === '11' && c11 < 20) {
        flag = false;
    }
    return flag;
}

function regla5(value, el) {
//    Si C16 = 1  &  (dos primeros dígitos de C1 <> 10, 15, 17)
//		Si C16 = (2:6)  &  (dos primeros dígitos de C1 <> 20)
    var flag = true;
    var c1 = $('#frm_C1').val();
    message = 'Error: Número de ruc no guarda relación con la organización de la empresa';
    if (value === '1' && $.inArray(c1.substr(0, 2), ['10', '15', '17']) === -1) {
        flag = false;
    } else if ($.inArray(value, ['2', '3', '4', '5', '6']) !== -1 && c1.substr(0, 2) !== '20') {
        flag = false;
    }
    return flag;
}

function regla7(value, el) {
    message = 'Error: Debe existir información';
    var c18_05 = $('#frm_C18_05').val();
    c18_05 = (c18_05) ? parseInt(c18_05) : 0;
    return (c18_05 > 0) ? $.trim(value) !== '' : true;
}

//eventos flujos y pases

$('#frm_C13A').change(function() {
    if (this.value === '4') {
        $('#div_C13A_O').removeClass('divoculto');
    } else {
        fn_clean('#frm_C13A_O');
        $('#div_C13A_O').addClass('divoculto');
    }
});

$('#frm_C16').change(function() {
    if (this.value === '6') {
        $('#div_C16_O').removeClass('divoculto');
    } else {
        fn_clean('#frm_C16_O');
        $('#div_C16_O').addClass('divoculto');
    }
});

$('input[name="frm[C17]"]').change(function() {
    if (this.value !== '2') {
        $('#div_C18').removeClass('divoculto');
        $('#div_C19').removeClass('divoculto');
        $('#div_C19_CCDD').removeClass('divoculto');
        $('#div_C19_CCPP').removeClass('divoculto');
        $('#div_C19_CCDI').removeClass('divoculto');
        $('#div_C19_TIPO').removeClass('divoculto');
        $('#div_C19_TIPO_O').removeClass('divoculto');
    } else {
        fn_clean('#frm_C18_01');
        fn_clean('#frm_C18_02');
        fn_clean('#frm_C18_03');
        fn_clean('#frm_C18_04');
        fn_clean('#frm_C18_05');
        fn_clean('#frm_C18_06');
        fn_clean('#frm_C18_05_O');
        fn_clean('#frm_C19_CCDD');
        fn_clean('#frm_C19_CCPP');
        fn_clean('#frm_C19_CCDI');
        fn_clean('#frm_C19_TIPO');
        fn_clean('#frm_C19_TIPO_O');
        $('#div_C18').addClass('divoculto');
        $('#div_C19').addClass('divoculto');
        $('#div_C19_CCDD').addClass('divoculto');
        $('#div_C19_CCPP').addClass('divoculto');
        $('#div_C19_CCDI').addClass('divoculto');
        $('#div_C19_TIPO').addClass('divoculto');
        $('#div_C19_TIPO_O').addClass('divoculto');
    }
});

$('#frm_C18_05').keyup(function() {
    var c18_05 = this.value;
    c18_05 = (c18_05) ? parseInt(c18_05) : 0;
    if (c18_05 > 0) {
        $('#div_C18_05_O').removeClass('divoculto');
    } else {
        $('#div_C18_05_O').addClass('divoculto');
        fn_clean('#frm_C18_05_O');
    }
});

$('#frm_C19_TIPO').change(function() {
    if (this.value === '5') {
        $('#div_C19_TIPO_O').removeClass('divoculto');
    } else {
        fn_clean('#frm_C19_TIPO_O');
        $('#div_C19_TIPO_O').addClass('divoculto');
    }
});

$('#frm_C18_01').change(function() {
    calculateC18_06();
});
$('#frm_C18_02').change(function() {
    calculateC18_06();
});
$('#frm_C18_03').change(function() {
    calculateC18_06();
});
$('#frm_C18_04').change(function() {
    calculateC18_06();
});
$('#frm_C18_05').change(function() {
    calculateC18_06();
});

//utils

function calculateC18_06() {
    var suma = 0;
    var ctrl = null;
    for (i = 1; i <= 5; i++) {
        ctrl = $('#frm_C18_0' + i);
        suma = suma + parseInt(((ctrl.val()) ? ctrl.val() : 0));
    }
    $('#frm_C18_06').val(suma);
}