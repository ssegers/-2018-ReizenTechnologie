$(document).ready(function(){
    $('.cascadingMajor').change(function(){
        if($(this).val() != ''){
            var username = $("#username").text();
            var study = $(this).val();
            var dependent = $(this).data('dependent');
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"/cascade",
                method:"POST",
                data:{
                    study: study,
                    _token: _token,
                    dependent: dependent},
                success:function(result){
                    console.log(username);
                    console.log(1);
                    $('#'+dependent).html(result);

                }
            })
        }
    });
});
//# sourceMappingURL=cascadingDropDownStudyMajors.js.map
