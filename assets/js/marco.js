$('#frm_CV1ERESULT').change(function() {
    if (this.value === '8') {
        $('#obs1').removeClass('divoculto');
        $('#obs2').removeClass('divoculto');
    } else {
        $('#obs1').addClass('divoculto');
        $('#obs2').addClass('divoculto');
        fn_clean('#frm_CV1ERESULTO');
    }
});

function showGPSDialog() {
    var latitud = $('#frm_GPS_LATITUD').val();
    var longitud = $('#frm_GPS_LONGITUD').val();
    var ruc = $('#ruc').val();
    var rz = $('#rz').val();
    latitud = (latitud === '0') ? null : latitud;
    longitud = (longitud === '0') ? null : longitud;
    if (latitud && longitud) {
        Android.showGPSDialog(rz, ruc, longitud, latitud);
    } else {
        Android.showGPSDialog(rz, ruc);
    }
}

function getLatLng(lat, lng) {
    $('#frm_GPS_LATITUD').val(lat);
    $('#frm_GPS_LONGITUD').val(lng);
}

function updateNavigation(total) {
    $('.pagination li>a').each(function(k, v) {
        var url = this.href;
//        var url = this.href.replace((($total.val()==='true')?'true':'false'), $total.val());
        if (url.indexOf('total') > 0) {
            url = url.replace('&total=false', '').replace('total=false', '').replace('&total=true', '').replace('total=true', '').replace('&total=', '');
        }
        url = url + ((url.indexOf('?') >= 0) ? '&total=' + total.val() : '?total=' + total.val());
        this.href = url;
    });
}

$('#chktodos_id').change(function(e) {
    var $total = $('#total_id');
    var $chktotal = $(this);
    $total.val($chktotal.is(':checked'));
    updateNavigation($total);
    if ($chktotal.is(':checked')) {
        $('.conglomerado').prop('checked', true);
    } else {
        $('.conglomerado').prop('checked', false);
    }
});

$('.conglomerado').change(function(e) {
    var selected = $('.conglomerado:checked').length;
    var $chktotal = $('#chktodos_id');
    var $total = $('#total_id');
    if (selected < 5) {
        $chktotal.prop('checked', false);
    } else {
        $chktotal.prop('checked', true);
    }
    $total.val($chktotal.is(':checked'));
    updateNavigation($total);
});

$('#btnExportar_id').click(function() {
    var todos = $('#chktodos_id');
    if (todos.is(':checked')) {
        exporta_data('', todos.val());
    } else {
        var conglomerados = $('.conglomerado:checked');
        if (conglomerados.length > 0) {
            var primerConglomerado = conglomerados[0].value;
            var datosPrimerConglomerado = primerConglomerado.split(',');
            var dni = datosPrimerConglomerado[1];
            var dataConglomerados = '';
            $.each(conglomerados, function(i, v) {
                var conglomerado = v.value.split(',');
                dataConglomerados = dataConglomerados + conglomerado[0] + ',';
            });
            dataConglomerados = dataConglomerados.substr(0, dataConglomerados.length - 1);
            exporta_data(dataConglomerados, dni);
        } else {
            alert('Debe seleccionar por lo menos una empresa');
        }
    }
});

$('#btnTransferir_id').click(function() {
    var conglomerados = $('.conglomerado2:checked');
    if (conglomerados.length > 0) {
        var primerConglomerado = conglomerados[0].value;
        var datosPrimerConglomerado = primerConglomerado.split(',');
        var dni = datosPrimerConglomerado[1];
        var dataConglomerados = '';
        $.each(conglomerados, function(i, v) {
            var conglomerado = v.value.split(',');
            dataConglomerados = dataConglomerados + conglomerado[0] + ',';
        });
        dataConglomerados = dataConglomerados.substr(0, dataConglomerados.length - 1);
        transferir_data(dataConglomerados, dni);
    } else {
        alert('Debe seleccionar por lo menos una empresa');
    }

});

function exporta_data(idempresa, idusuario) {
    Android.exportaData(idempresa, idusuario);
}

function transferir_data(idempresa, idusuario) {
    Android.transferirData(idempresa, idusuario);
}