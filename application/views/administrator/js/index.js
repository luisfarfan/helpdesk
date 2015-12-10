

$(document).ready(function () {
    $('#idestado_incidencia').val() == 2 ? $('#solucion').parent().show() : $('#solucion').parent().hide()
    $('#table_incidencias_admin').DataTable({
        "order": [[0, "desc"]]
    });

    $('#tecnicos').combobox({
        select: function (event, ui) {
            $("#idestado_incidencia option[value='3']").attr("selected", "selected");
        }
    });

    $('#categorias').combobox({
        select: function (event, ui) {
            $("#titulo").val($('#categorias :selected').text());
        }
    });
    $('#idusuario').combobox();

    $('#idestado_incidencia').change(function () {
        $(this).val() == 3 ? $('#solucion').parent().show() : $('#solucion').parent().hide()
    })


});

function ver_bitacora(id) {
    $.ajax({
        url: base_url + 'Admin/get_bitacora/' + id,
        success: function (data, textStatus, jqXHR) {
//                console.log(data)
//                console.log(textStatus)
//                console.log(jqXHR)
            $('#div_bitacora').html(data);
//                $('#editarPersona').show();
        }
    })
}
function ir(url) {
    window.location.replace(url);
}

