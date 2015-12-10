$(document).ready(function () {
    $('#table_incidencias').DataTable({
        "order": [[0, "desc"]]
    });
});

function ir(url) {
    window.location.replace(url);
}

