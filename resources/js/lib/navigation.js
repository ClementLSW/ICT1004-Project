$(document).ready(function() {
$('.navTrigger').click(function () {
    console.log("Clicked menu");
    $('.navTrigger').toggleClass('active');
    $("#mainListDiv").toggleClass("show_list");
    $("#mainListDiv").fadeIn();
});

});