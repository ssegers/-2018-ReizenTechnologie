$(document).ready(function () {
    $('#add-payment-button').click(function(){
        var payment_date = $('#date-text').val();
        var amount = $('#amount-int').val();
        var traveller_id = $('#traveller-id').val();
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "addPayment",
            data: {
                traveller_id: traveller_id,
                payment_date: payment_date,
                amount: amount,
            },
            success:function (result) {
                if (result["zipAdded"]==true) {
                    $('#error').hide();

                }
                else{
                    $('#error').show();
                    $('#error').html('Ingevulde Postcode is niet geldig');
                }


            },
            error: function(){
                $('#error').html('Ingevulde betaling is niet geldig');
            }
        })
    });
});