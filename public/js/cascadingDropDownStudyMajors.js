$(document).ready(function(){
    $('.cascadingMajor').change(function(){
        if($(this).val() != ''){
            var study = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"/userinfo/{{$aUserData['username']}}/cascade",
                method:"POST",
                data:{
                    study: study,
                    _token: _token,
                    dependent: dependent},
                success:function(result){
                    $('#'+dependent).html(result);
                    console.log(result);
                }
            })
        }
    });
    $('#Study').change(function(){
        $('#Major').val('');
    });
});