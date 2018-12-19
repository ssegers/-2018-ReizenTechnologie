$(document).ready(function () {
    $('#paymentStatusTable').DataTable({
        "order": [[ 5, "desc" ]]
    });
    $('.dataTables_length').addClass('bs-select');
});