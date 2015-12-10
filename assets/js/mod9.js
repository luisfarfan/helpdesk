/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
$(function() {

    if (rules1['rules'] !== undefined) {
        performSubmitMatrixHandler('#frm_id', rules1);
    }
    if (rules2['rules'] !== undefined) {
        performSubmitMatrixHandler('#frm_id', rules2);
    }
    if (rules3['rules'] !== undefined) {
        performSubmitMatrixHandler('#frm_id', rules3);
    }
    if (rules4['rules'] !== undefined) {
        performSubmitMatrixHandler('#frm_id', rules4);
    }
    if (rules6['rules'] !== undefined) {
        performSubmitMatrixHandler('#frm_id', rules6);
    }
});

function regla264(value, el) {
    //frm_mod9_1_0_M9P1_4
    var control = el.id.substr(13, 6);
    var index = $('input[id$="' + control + '"]').index(el);
    var M9P1_3 = $('#frm_mod9_1_' + index + '_M9P1_3').val();
    if (($.trim(M9P1_3) !== '')) {
        message = "Error: Debe llenar todos los campos (unidad de medida, cantidad y valor de venta)";
    } else {
        message = "Error: No debe llenar los campos (unidad de medida, cantidad y valor de venta)";
    }
    return ($.trim(M9P1_3) !== '') ? ($.trim(value) !== '') : ($.trim(value) === '');
//    console.log(el.id.substr(13,6));
}

function regla265(value, el) {
    //frm_mod9_1_0_M9P1_4
    var control = el.id.substr(13, 6);
    var index = $('input[id$="' + control + '"]').index(el);
    var M9P2_3 = $('#frm_mod9_2_' + index + '_M9P2_3').val();
    if (($.trim(M9P2_3) !== '')) {
        message = "Error: Debe llenar todos los campos (unidad de medida, cantidad y valor de venta)";
    } else {
        message = "Error: No debe llenar los campos (unidad de medida, cantidad y valor de venta)";
    }
    return ($.trim(M9P2_3) !== '') ? (value !== '') : (value === '');
//    console.log(el.id.substr(13,6));
}

function regla267(value, el) {
    //frm_mod9_1_0_M9P1_4
    message = 'Error: El MARGEN COMERCIAL no coincide con las ventas de mercaderías menos sus costos';
    var p1 = $('#frm_mod9_4_5_0_M9P4_1').val();
    var p2 = $('#frm_mod9_4_5_0_M9P4_2').val();
    value = (value !== '') ? parseInt(value) : 0;
    p1 = (p1 !== '') ? parseInt(p1) : 0;
    p2 = (p2 !== '') ? parseInt(p2) : 0;
    //SI M9P4_3 <> M9P4_1 - M9P4_2
    return (p1 - p2) === value;
}

function regla268(value, el) {
    //frm_mod9_1_0_M9P1_4
    message = 'Error: El TOTAL INGRESOS no coincide con la suma de los ingresos';
//    var p3 = $('#frm_mod9_4_5_0_M9P4_3').val();
//    var p4 = $('#frm_mod9_4_5_0_M9P4_4').val();
//    var p5 = $('#frm_mod9_4_5_0_M9P4_5').val();
//    var p6 = $('#frm_mod9_4_5_0_M9P4_6').val();
//    value = (value !== '') ? parseInt(value) : 0;
//    p3 = (p3 !== '') ? parseInt(p3) : 0;
//    p4 = (p4 !== '') ? parseInt(p4) : 0;
//    p5 = (p5 !== '') ? parseInt(p5) : 0;
//    p6 = (p6 !== '') ? parseInt(p6) : 0;
    //SI M9P4_7 <> M9P4_3 + M9P4_4 + M9P4_5 + M9P4_6
//    return (p3 + p4 + p5 + p6) === value;
    return compruebaSuma('frm_mod9_4_5_0_M9P4_', 3, 6, value);
}

function regla269(value, el) {
    //frm_mod9_1_0_M9P1_4
    message = 'Error: Los GASTOS DE PERSONAL no coincide con la suma de los ítems';
    //SI M9P5_2 <> M9P5_3 + M9P5_4 + M9P5_5 + M9P5_6 + M9P5_7 + M9P5_8
    var p9 = $('#frm_mod9_4_5_0_M9P5_2').val();
    return compruebaSuma('frm_mod9_4_5_0_M9P5_', 3, 8, p9);
}
//SI M9P5_3 = 0
//& M3P1_6A > 0
function regla270(value, el) {
    if (mod3Data['M3P1_6A'] !== undefined) {
        message = 'Error: Debe existir valor';
        value = (value !== '') ? parseInt(value) : 0;
        var m3p1 = parseInt(mod3Data['M3P1_6A']);
        return m3p1 > 0 ? (value > 0) : true;
    }
    return true;
}
//
//SI M9P5_9 <> M9P5_10 + M9P5_11 + M9P5_12 + M9P5_13 + M9P5_14 + M9P5_15 + M9P5_16 + M9P5_17 + M9P5_18 + M9P5_19
function regla271(value, el) {
    message = 'Error: Los GASTOS DE SERVICIOS PRESTADOS POR TERCEROS no coincide con la suma de los ítems';
    var p9 = $('#frm_mod9_4_5_0_M9P5_9').val();
    return compruebaSuma('frm_mod9_4_5_0_M9P5_', 10, 19, p9);
}

function regla272(value, el) {
    //SI M9P5_20 <> M9P5_21 + M9P5_22 + M9P5_23 + M9P5_24
    message = 'Error: Los OTROS GASTOS DE GESTIÓN no coincide con la suma de los ítems';
    var p9 = $('#frm_mod9_4_5_0_M9P5_20').val();
    return compruebaSuma('frm_mod9_4_5_0_M9P5_', 21, 24, p9);
}

function regla273(value, el) {
//    SI M9P6_4 <> 0 & M9P6_(1:3) = 0 (Todas igual a cero)
//MENSAJE	:	“Error: No corresponde. No se tiene registro de inventario inicial y/o compras en el 2014”
    //frm_mod9_6_0_M9P6_4
    var control = el.id.substr(13, 6);
    var index = $('input[id$="' + control + '"]').index(el);
    value = (value !== '') ? parseInt(value) : 0;
    message = 'Error: No corresponde. No se tiene registro de inventario inicial y/o compras en el 2014';
    return (value !== 0) ? sumarItems('frm_mod9_6_' + index + '_M9P6_', 1, 3) > 0 : true;
}

//SI M9P6_5 <>  M9P6_1 + M9P6_2 + M9P6_3 - M9P6_4
//MENSAJE	:	“Error: No corresponde. No se tiene registro de inventario inicial y/o compras en el 2014”
function regla274(value, el) {
    var control = el.id.substr(13, 6);
    var index = $('input[id$="' + control + '"]').index(el);
    value = (value !== '') ? parseInt(value) : 0;
    message = 'Error: No corresponde. No se tiene registro de inventario inicial y/o compras en el 2014';
    var sum = sumarItems('frm_mod9_6_' + index + '_M9P6_', 1, 3);
    var p4 = $('#frm_mod9_6_' + index + '_M9P6_4').val();
    p4 = (p4 !== '') ? parseInt(p4) : 0;
    return value === (sum - p4);
}

function save(form) {
    var flag = true;
    if (!$('#div_m9_p3').hasClass('divoculto')) {
        var m9p3 = 0;
        $('input[id$="M9P3_3"]').each(function(i, v) {
            m9p3 += (v.value !== '') ? 1 : 0;
        });
        if (m9p3 === 0) {
            flag = false;
            alert('Error: Debe existir información al menos en un ítem');
        }
    }
    if (flag) {
        form.submit();
    }
//    if (!$('#div_m9_p3').hasClass('divoculto')) {
//        form.submit();
//    }
}

function compruebaSuma(id, from, to, total) {
    var valid = validaItems(id, from, to);
    if (valid) {
        var suma = sumarItems(id, from, to);
        total = (total !== '') ? parseInt(total) : 0;

        return total === suma;
    }
    return true;
}

function sumarItems(id, from, to) {
    var p = null;
    var suma = 0;
    for (i = from; i <= to; i++) {
        p = $('#' + id + i).val();
        p = (p !== '') ? parseInt(p) : 0;
        suma += p;
    }
    return suma;
}

function validaItems(id, from, to) {
    var p = null;
    var suma = true;
    for (i = from; i <= to; i++) {
        p = $('#' + id + i).val();
        suma &= (p !== '');
    }
    return suma;
}