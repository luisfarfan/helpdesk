function ver_categoria(id) {
    $.ajax({
        url: base_url + 'Categorias/get_by_id/' + id,
        success: function (data, textStatus, jqXHR) {
//                console.log(data)
//                console.log(textStatus)
//                console.log(jqXHR)
            $('#edit_categoria').html(data);
//                $('#editarPersona').show();
        }
    })
}

