function loadPaymentData(id) {
    var buttinId = 'modalButton-';
    buttinId+=id;
    var button = document.getElementById(buttinId);
    // var button = $("#modalButton-" . id); // Button that triggered the modal

    var traveller = id;


    //var username = button.data('content')// Extract info from data-* attributes
    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.

    var modal = $('#paymentPopUp');
    // modal.find('.modal-title').text('Nieuwe betaling voor: ' + username)
    modal.find('input[name="traveller_id"]').val(traveller);


    $.ajax({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        },
        type: "POST",
        url: "/user/payment/showPayment",
        data: {
           traveller_id: id,
        },
        success:function (result) {
            console.log(result);

            updateData(result['paymentdata']);

            },

        error: function (error) {
            console.log(error)
        }


        })
}
function updateData(data) {
    $('#paymentdata').empty();

    for(var pay of data){

        $('#paymentdata').append($('<tr>')
            .append($('<td>').text(pay.payment_date))
            .append($('<td>').text(pay.amount))
            .append($('<td>').append($('<button>')
                .text('Delete')
                .attr('class', 'btn btn-primary')
                .attr('onClick', ("deletePayment(" + pay.paymentPerTravellers_id + ", " + pay.traveller_id+", " + pay.amount+", " + pay.payment_date+")"))
            )));
    }

}
function deletePayment(paymentId, traveller_id, amount, payment_date) {
    if(confirm('Bent u zeker?')){
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "/user/payment/deletePayment",
            data: {
                paymentPerTravellers_id: paymentId,
                traveller_id: traveller_id,
                payment_date: payment_date,
                amount: amount
            },
            success:function (result) {
                loadPaymentData(traveller_id);
            },

            error: function (error) {
                console.log(error)
            }


        })
    }

}