$(document).ready(function () {
    $('.loadButton').click(function() {
        $('.loader').css("display","block");
        $('.loaderBackground').css("display","block");
    $.post(window.location,{sendMail: true});})
});