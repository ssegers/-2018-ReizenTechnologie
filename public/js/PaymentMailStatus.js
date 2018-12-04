$(document).ready(function () {
    $('.loadButton').click(function() {
        $('.loader').css("display","block");
        $('.loaderBackground').css("display","block");
        $.ajax({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            },
            type: "POST",
            url: "payment/",
            data: {
                sendMail: true,
            }
        })
    })
});