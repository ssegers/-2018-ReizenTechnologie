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
            },
            success:function () {
                $('.loader').css("display","none");
                $('.loaderBackground').css("display","none");
                $('.success-mail').css("display","block");
            },
            error: function(){
                $('.loader').css("display","none");
                $('.loaderBackground').css("display","none");
                $('.success-mail').css("display","block");
            }
        })
    })
});