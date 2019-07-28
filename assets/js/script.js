$(document).ready(function () {
    $('#dtHorizontalVerticalExample').DataTable({
        columnDefs: [{
            orderable: false,
            targets: "no-sort",
            bSort: false,
            order: []
        }],
        scrollX: true,
        scrollY: 400,
    });
    $('.dataTables_length').addClass('bs-select');
});