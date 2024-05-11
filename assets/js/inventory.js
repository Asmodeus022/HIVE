$(document).ready( function () {
    $('#myTable').DataTable({
        paging: false,
        scrollCollapse: true,
        scrollY: 'calc(100vh - 300px)',
        bInfo: false,
        columnDefs: [
            {
                orderable: false,
                render: DataTable.render.select(),
                targets: 0
            }
        ],
        select: true,
        order: [[1, 'asc']]
    });
    
});