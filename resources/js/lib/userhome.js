
function toggleView(currentlyChoosen){
    //If currently choosen == 1, show shops div
     if(currentlyChoosen == 1){
        $('#destination_selection').hide();
        $('#shop_selection').show();
     }
    //Else show destination div 
    else{
        $('#destination_selection').show();
        $('#shop_selection').hide();
    }
}

function processInput(currentDestination , currentShop){
    $.ajax({
        data: {currentDestination:currentDestination,currentShop:currentShop},
        url: '../../users/user_input_process.php',
        method: 'POST', // or GET
        success: function(msg) {
            
        }
    });
}
$(document).ready(function() {
    var currentlyChoosen = 0; // 0 = Destination , 1 = Shops
    var currentDestination = $('#destinationInput').val(); 
    var currentShop = $('#shopInput').val();
    $('.js-example-basic-single').select2();
    $('#destination_submit').click(function() {
        currentDestination = $('#destinationInput').val();
        if(currentDestination != 0){
            currentlyChoosen = 1;
            toggleView(currentlyChoosen)
        }
    })

    $('#shop_submit').click(function() {
        currentShop = $('#shopInput').val();
        processInput(currentDestination , currentShop);
    })

    $('#shop_back').click(function() {
        currentlyChoosen = 0;
        toggleView(currentlyChoosen);
    })

});