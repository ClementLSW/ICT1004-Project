function toggleMapView(loadingMap){
  // if(loadingMap){
  //   $('#beforeload').show();
  //   $('#afterload').css('display', 'none');
  // }
  // else{
  //   $('#beforeload').hide();
  //   $('#afterload').css('display', 'block');
  // }
}
function toggleView(currentlyChoosen){
    //If currently choosen == 1, show shops div
     if(currentlyChoosen == 1){
        $('#destination_selection').hide();
        $('#starting_location').hide();
        $('#shop_selection').show();
        $(".js-example-basic-single").select2({ dropdownParent: "#shops_form" });

     }
    //Else show destination div 
    else if(currentlyChoosen == 0){
        $('#destination_selection').show();
        $('#shop_selection').hide();
        $('#starting_location').hide();
        $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });

    }
    else if(currentlyChoosen == 2){
      $('#destination_selection').hide();
      $('#shop_selection').hide();
      $('#starting_location').show();
      // $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });
    }
}

function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map1'), {
    center: {
      lat: 48,
      lng: 4
    },
    zoom: 4,
    disableDefaultUI: true
  });

  // Create the search box and link it to the UI element.
  
  // var input = document.getElementById('my-input-searchbox');
  $('#searchWindow').append('<input type="text" id="my-input-searchbox" style="display:none"/>');
  var input = document.getElementById('my-input-searchbox');
  var autocomplete = new google.maps.places.Autocomplete(input);
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(input);
  var marker = new google.maps.Marker({
    map: map
  });
  $('#my-input-searchbox').show();


  // Bias the SearchBox results towards current map's viewport.
  autocomplete.bindTo('bounds', map);
  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
    ['address_components', 'geometry', 'name']);

  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  autocomplete.addListener('place_changed', function() {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }
    var bounds = new google.maps.LatLngBounds();
    marker.setPosition(place.geometry.location);

    if (place.geometry.viewport) {
      // Only geocodes have viewport.
      bounds.union(place.geometry.viewport);
    } else {
      bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
  });

}


function processInput(currentDestination , currentShop){
  
    // $.ajax({
    //   url: "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCmiOGqCQ_5z0FeMbuelO3H3kFPQC7JDPw",
    //   method: 'POST', 
    //   success: function(msg){
    //     console.log(msg)
    //   }
    // })
      $.ajax({
        data: {currentDestination:currentDestination,currentShop:currentShop},
        url:  'users/user_input_process.php',
        method: 'POST', // or GET
        success: function(msg) {
            console.log(msg);
        }});
  
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
    $.ajax({
      data: {destination},
      url: 'users/user_input_process.php',
      method: 'POST', 
      success: function(msg){
        var obj = JSON.parse(msg);
        if(obj.length != 0){
          for(var i = 0; i < obj.length; i++){
            $("#shopInput").append("<option value=" + obj[i].area_id +  ">" + obj[i].name + "</option>");
          }
        }else{
          $("#shopInput").append("<option value=0 selected > No Options available</option>");
        }
      }
    })
  }

var currentlyChoosen = 0; // 0 = Destination , 1 = Shops
$(document).ready(function() {
    toggleView(currentlyChoosen);
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
                $('.overlay').css('background-color', 'rgba(0,0,0,0.7');
                $('#mainbody').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundexpo.jpg)');
            }
            if(currentDestination == 2){
                //Suntec City
                $('.overlay').css('background-color', 'rgba(0,0,0,0.7');
                $('#mainbody').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundsuntec.jpg)');
            }
            toggleView(currentlyChoosen)
            //Retrieve current Destination data from DB 
            $("#shopInput").empty();
            showShops(currentDestination);
        }
    })

    $('#shop_submit').click(function() {
        currentShop = $('#shopInput').val();
        currentlyChoosen = 2;
        toggleView(currentlyChoosen);
        //Do the search for source address 
        window.onload = initAutocomplete();
        // processInput(currentDestination , currentShop);
        
    })

    $('#shop_back').click(function() {
        currentlyChoosen = 0;
        $('.overlay').css('background-color', 'rgba(0,0,0,0.5');
        $('#mainbody').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/background4.jpg)');
        toggleView(currentlyChoosen);
    })

    $('#location_submit').click(function() {
      
      processInput(currentDestination , currentShop);
  })

  

  $('#location_back').click(function() {
      currentlyChoosen = 1;
      $('.overlay').css('background-color', 'rgba(0,0,0,0.5');
      $('#mainbody').css('background-image','url(http://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/background4.jpg)');
      toggleView(currentlyChoosen);
  })

 
  

});