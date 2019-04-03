$(document).ready( function () {

    $('#table-server').DataTable({
        order: [[0, 'DESC']],
        "scrollY":        "350px",
        "scrollCollapse": true,
        "paging":         false
    });

});