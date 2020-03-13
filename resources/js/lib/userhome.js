
function toggleView(currentlyChoosen){
    //If currently choosen == 1, show shops div
     if(currentlyChoosen == 1){
        $('#destination_selection').hide();
        $('#shop_selection').show();
        $(".js-example-basic-single").select2({ dropdownParent: "#shops_form" });

     }
    //Else show destination div 
    else{
        $('#destination_selection').show();
        $('#shop_selection').hide();
        $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });

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

function showShops(destination) {
    if (destination=="") {
        //   document.getElementById("txtHint").innerHTML="";
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else { // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        console.log(this.responseText);
        var obj = JSON.parse(this.responseText);

        if(obj.length != 0){
          for(var i = 0; i < obj.length; i++){
            $("#shopInput").append("<option value=" + obj[i].area_id +  ">" + obj[i].name + "</option>");
          }
        }else{
          $("#shopInput").append("<option value=0 selected > No Options available</option>");
        }

        // document.getElementById("txtHint").innerHTML=this.responseText;
      }
    }

    xmlhttp.open("GET" , "users/user_input_process.php?destination="+destination,true);
    xmlhttp.send();
  }

$(document).ready(function() {
    var currentlyChoosen = 0; // 0 = Destination , 1 = Shops
    var currentDestination = $('#destinationInput').val(); 
    var currentShop = $('#shopInput').val();
    // $('.js-example-basic-single').select2(); // Shun han look here 
    $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });
    $('#destination_submit').click(function() {
        currentDestination = $('#destinationInput').val();
        if(currentDestination != 0){
            currentlyChoosen = 1;
            if(currentDestination == 1){
                //Expo City
                $('.overlay').css('background-color', 'rgba(0,0,0,0.6');
                $('#section_container').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundexpo.jpg)');
            }
            if(currentDestination == 2){
                //Suntec City
                $('.overlay').css('background-color', 'rgba(0,0,0,0.6');
                $('#section_container').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundsuntec.jpg)');
            }
            toggleView(currentlyChoosen)
            //Retrieve current Destination data from DB 
            $("#shopInput").empty();
            showShops(currentDestination);
        }
    })

    $('#shop_submit').click(function() {
        currentShop = $('#shopInput').val();
        processInput(currentDestination , currentShop);
    })

    $('#shop_back').click(function() {
        currentlyChoosen = 0;
        $('.overlay').css('background-color', 'rgba(0,0,0,0.3');
        $('#section_container').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/background4.jpg)');
        toggleView(currentlyChoosen);
    })

});