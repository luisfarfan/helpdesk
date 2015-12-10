$('#date_range').daterangepicker();

$('#date_range').on('apply.daterangepicker', function (ev, picker) {
    $('#from').val((picker.startDate.format('YYYY-MM-DD')));
    $('#to').val((picker.endDate.format('YYYY-MM-DD')));
});
