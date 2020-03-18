function toggleMapView(loadingMap) {
  // if(loadingMap){
  //   $('#beforeload').show();
  //   $('#afterload').css('display', 'none');
  // }
  // else{
  //   $('#beforeload').hide();
  //   $('#afterload').css('display', 'block');
  // }
}


function changeBackground(currentDestination) {
  if (currentDestination == 1) {
    $('.overlay').css('background-color', 'rgba(0,0,0,0.7');
    $('#mainbody').css('background-image', 'url(https://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundexpo.jpg)');
  }
  if (currentDestination == 2) {
    $('.overlay').css('background-color', 'rgba(0,0,0,0.7');
    $('#mainbody').css('background-image', 'url(https://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/backgroundsuntec.jpg)');
  }
}
function toggleView(currentlyChoosen) {
  //If currently choosen == 1, show shops div
  if (currentlyChoosen == 1) {
    $('#destination_selection').hide();
    $('#starting_location').hide();
    $('#shop_selection').show();
    $(".js-example-basic-single").select2({ dropdownParent: "#shops_form" });

  }
  //Else show destination div 
  else if (currentlyChoosen == 0) {
    $('#destination_selection').show();
    $('#shop_selection').hide();
    $('#starting_location').hide();
    $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });

  }
  else if (currentlyChoosen == 2) {
    $('#destination_selection').hide();
    $('#shop_selection').hide();
    $('#starting_location').show();
    // $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });
  }
}

async function initAutocomplete() {
  var map = new google.maps.Map(document.getElementById('map1'), {
    center: {
      lat: 1.3521,
      lng: 103.8198
    },
    zoom: 12,
    disableDefaultUI: true
  });

  // Create the search box and link it to the UI element.

  // var input = document.getElementById('my-input-searchbox');
  $('#searchWindow').prepend('<section id="comboSection" class="justify-content-center w-100" style="margin-top: 3%; display: flex;" ></section>')
  $('#comboSection').css('left', '-300%');
  $('#comboSection').css('position', 'absolute');
  $('#currentWindow').css('left', '-300%');
  $('#currentWindow').css('position', 'absolute');
  $('#currentWindow').prepend('<button type="button" id="currentLocationButton" class="btn-primary-location"  style="display:flex; background-color: #bbb;  border-radius: 50%;width: 40px; height: 40px;"><i class="material-icons" style="margin: auto">my_location</i></button>');
  $('#comboSection').prepend('<input type="text" id="my-input-searchbox" style="margin-top: auto; margin-bottom: auto;"/>');


  var input = document.getElementById('my-input-searchbox');
  var comboBox = document.getElementById('comboSection');
  var currentLocButton = document.getElementById('currentLocationButton');
  var autocomplete = new google.maps.places.Autocomplete(input);
  var markersArray = [];
  map.controls[google.maps.ControlPosition.TOP_CENTER].push(comboBox);
  map.controls[google.maps.ControlPosition.RIGHT_BOTTOM].push(currentLocButton);

  var marker = new google.maps.Marker({
    map: map
  });


  // Bias the SearchBox results towards current map's viewport.
  autocomplete.bindTo('bounds', map);
  // Set the data fields to return when the user selects a place.
  autocomplete.setFields(
    ['address_components', 'geometry', 'name']);


  // Listen for the event fired when the user selects a prediction and retrieve
  // more details for that place.
  autocomplete.addListener('place_changed', function () {
    var place = autocomplete.getPlace();
    if (!place.geometry) {
      console.log("Returned place contains no geometry");
      return;
    }

    if (markersArray.length != 0) {
      for (var i = 0; i < markersArray.length; i++) {
        markersArray[i].setMap(null);
      }
      markersArray.length = 0;
    }

    var marker = new google.maps.Marker({
      map: map
    });

    var bounds = new google.maps.LatLngBounds();
    marker.setPosition(place.geometry.location);
    markersArray.push(marker);

    if (place.geometry.viewport) {
      // Only geocodes have viewport.
      bounds.union(place.geometry.viewport);
    } else {
      bounds.extend(place.geometry.location);
    }
    map.fitBounds(bounds);
  });


  //Bind the currentLoction button 
  $('#currentLocationButton').click(function () {
    if (confirm('Current location may not be accurate! Would you still like to get current location?')) {
         //Clear all the old array
        if (markersArray.length != 0) {
          for (var i = 0; i < markersArray.length; i++) {
            markersArray[i].setMap(null);
          }
          markersArray.length = 0;
        }
        if (navigator.geolocation) {
          navigator.geolocation.getCurrentPosition(function(position) {
             var currLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);
     
             // plot the currLocation on Google Maps, or handle accordingly:
     
             var marker = new google.maps.Marker({ title: 'Current Location',
                                      map: map, 
                                      position: currLocation });
     
             map.setCenter(currLocation);
             markersArray.push(marker);
             map.setZoom(17);
             var geocoder = new google.maps.Geocoder();
             geocoder.geocode({'address': position.coords.latitude + "," + position.coords.longitude}, function(results, status) {
               if (status === 'OK') {
                 document.getElementById("my-input-searchbox").value = results['0'].formatted_address;
               } else {
                 alert('Geocode was not successful for the following reason: ' + status);
               }
             });
          });
        }
    }
  })

  return true;

}

async function plotCurrentLocation(map) {
  if (navigator.geolocation) {
     navigator.geolocation.getCurrentPosition(function(position) {
        var currLocation = new google.maps.LatLng(position.coords.latitude,position.coords.longitude);

        // plot the currLocation on Google Maps, or handle accordingly:

        var marker = new google.maps.Marker({ title: 'Current Location',
                                 map: map, 
                                 position: currLocation });

        map.setCenter(currLocation);

        var geocoder = new google.maps.Geocoder();
        geocoder.geocode({'address': position.coords.latitude + "," + position.coords.longitude}, function(results, status) {
          if (status === 'OK') {
            document.getElementById("my-input-searchbox").value = results['0'].formatted_address;
          } else {
            alert('Geocode was not successful for the following reason: ' + status);
          }
        });
        return marker;
     });
  }
}

async function getCurrentLocation() {
  if (navigator.geolocation) {
    navigator.geolocation.getCurrentPosition(function(position) {
      var pos = {
        lat: position.coords.latitude,
        lng: position.coords.longitude
      };
      
      
    }, function() {
      alert("Error");
    });
  } else {
    // Browser doesn't support Geolocation
   alert("Doesn't support geolocation");
  }
 
}
function processInput(currentDestination, currentShop) {

  // $.ajax({
  //   url: "https://www.googleapis.com/geolocation/v1/geolocate?key=AIzaSyCmiOGqCQ_5z0FeMbuelO3H3kFPQC7JDPw",
  //   method: 'POST', 
  //   success: function(msg){
  //     console.log(msg)
  //   }
  // })
  $.ajax({
    data: { currentDestination: currentDestination, currentShop: currentShop },
    url: 'users/user_input_process.php',
    method: 'POST', // or GET
    success: function (msg) {
      console.log(msg);
    }
  });

}

function showShops(destination) {
  if (destination == "") {
    //   document.getElementById("txtHint").innerHTML="";
    return;
  }
  if (window.XMLHttpRequest) {
    // code for IE7+, Firefox, Chrome, Opera, Safari
    xmlhttp = new XMLHttpRequest();
  } else { // code for IE6, IE5
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }
  $.ajax({
    data: { destination },
    url: 'users/user_input_process.php',
    method: 'POST',
    success: function (msg) {
      var obj = JSON.parse(msg);
      if (obj.length != 0) {
        for (var i = 0; i < obj.length; i++) {
          $("#shopInput").append("<option value=" + obj[i].area_id + ">" + obj[i].name + "</option>");
        }
      } else {
        $("#shopInput").append("<option value=-1 selected > No Options available</option>");
      }
    }
  })
}

var currentlyChoosen = 0; // 0 = Destination , 1 = Shops
$(document).ready(function () {
  toggleView(currentlyChoosen);
  var currentDestination = $('#destinationInput').val();
  var currentShop = $('#shopInput').val();
  // $('.js-example-basic-single').select2(); // Shun han look here 
  $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });
  $('#destination_submit').click(function () {
    console.log("is this working");
    currentDestination = $('#destinationInput').val();
    if (currentDestination != 0) {
      currentlyChoosen = 1;
      changeBackground(currentDestination);
      toggleView(currentlyChoosen)
      //Retrieve current Destination data from DB 
      $("#shopInput").empty();
      showShops(currentDestination);
    }
  })

  $('#shop_submit').click(function () {
    currentShop = $('#shopInput').val();

    if (currentShop != -1) {
      currentlyChoosen = 2;
      toggleView(currentlyChoosen);
      //Do the search for source address 
      initAutocomplete().then(value => {
        while (true) {
          console.log(value);
          if (value == true) {
            $('#comboSection').css('right', '300%');
            $('#currentWindow').css('right', '300%');
            $('#currentLocationButton').css('margin', '0% 3% 2% 0%');
            break;
          }
        }
      });
    }

    // processInput(currentDestination , currentShop);

  })

  $('#shop_back').click(function () {
    currentlyChoosen = 0;
    $('.overlay').css('background-color', 'rgba(0,0,0,0.5');
    $('#mainbody').css('background-image', 'url(https://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/background4.jpg)');
    toggleView(currentlyChoosen);
  })

  $('#location_submit').click(function () {
    processInput(currentDestination, currentShop);
  })



  $('#location_back').click(function () {
    currentlyChoosen = 1;
    toggleView(currentlyChoosen);
  })




});