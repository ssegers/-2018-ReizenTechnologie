$(document).ready(function () {
    $('.loadButton').click(function() {
        if (confirm("Ben je zeker dat je naar alle studenten een mail wil sturen?")) {
            $('.loader').css("display","block");
            $('.loaderBackground').css("display","block");
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: "POST",
                url: "/user/payment",
                data: {
                    sendMail: true,
                },
                success:function (result) {
                    console.log(result);
                    $('.loader').css("display","none");
                    $('.loaderBackground').css("display","none");
                    $('.success-mail').css("display","block");
                    $('.error-mail').css("display","none");
                },
                error: function(){
                    $('.loader').css("display","none");
                    $('.loaderBackground').css("display","none");
                    $('.error-mail').css("display","block");
                    $('.success-mail').css("display","none");
                }
            })
        } else {

        }


    })
});