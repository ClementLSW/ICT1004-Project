var choosenLat;
var choosenLng;
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
        $('#summary_page').hide();
        $('#shop_selection').show();
        $(".js-example-basic-single").select2({dropdownParent: "#shops_form"});

    }
    //Else show destination div 
    else if (currentlyChoosen == 0) {
        $('#destination_selection').show();
        $('#shop_selection').hide();
        $('#starting_location').hide();
        $('#summary_page').hide();
        $(".js-example-basic-single").select2({dropdownParent: "#user_form"});

    } else if (currentlyChoosen == 2) {
        $('#destination_selection').hide();
        $('#shop_selection').hide();
        $('#summary_page').hide();
        $('#starting_location').show();
        // $(".js-example-basic-single").select2({ dropdownParent: "#user_form" });
    } else if (currentlyChoosen == 3) {
        $('#destination_selection').hide();
        $('#shop_selection').hide();
        $('#summary_page').show();
        $('#starting_location').hide();
    }
}

async function initAutocompleteNoMap() {
    $('#searchWindow').prepend('<section id="comboSection" class="justify-content-center w-100" style="margin-top: 3%; display: flex;" ></section>')
    $('#getCurrentLocationContainer').append('<button type="button" id="currentLocationButton" class="col btn-primary btn" style="display:flex;border:0px ;color: none; margin-top: 0px !important; width: 100%;"><section style="margin:auto; display: flex;"><i font-feature-settings: "liga" class="material-icons" aria-label="location_icon" style="color: white;  display: inline-block; margin:auto 0px auto 0px">my_location</i><h3 style="color: white;font-weight: italics; width: 98%; position: relative; left: 2%; margin:auto ; font-size: smaller;">Get Current Location</h3></section></button>');
    $('#comboSection').prepend('<input type="text" id="my-input-searchbox" style="width:100%; font-family:sans-serif; font-size:2em;  text-align:center;padding: 5% 0px 5% 0px; margin-top: auto; margin-bottom: auto;"  type="text" pattern="^[a-zA-Z0-9,-.&+_ ]*$" aria-label="location_input_box" required/>');
    var input = document.getElementById('my-input-searchbox');

    var options = {
        componentRestrictions: {country: "sg"}
    };

    var autocomplete = new google.maps.places.Autocomplete(input, options);


    // Set the data fields to return when the user selects a place.
    autocomplete.setFields(
            ['address_components', 'geometry', 'name']);

    // Listen for the event fired when the user selects a prediction and retrieve
    // more details for that place.
    autocomplete.addListener('place_changed', function () {
        choosenLat = "";
        choosenLng = "";
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            alert("Invalid location");
            console.log("Returned place contains no geometry");
            return;
        }
        choosenLat = place.geometry.location.lat();
        choosenLng = place.geometry.location.lng();

    });


    //Bind the currentLoction button 
    $('#currentLocationButton').click(function () {
        if (confirm('Current location may not be accurate! Would you still like to get current location?')) {
            document.getElementById("my-input-searchbox").value = "Loading . . .";
            //Clear all the old array
            choosenLat = "";
            choosenLng = "";
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var currLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    choosenLat = position.coords.latitude;
                    choosenLng = position.coords.longitude;
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': position.coords.latitude + "," + position.coords.longitude}, function (results, status) {
                        if (status === 'OK') {
                            document.getElementById("my-input-searchbox").value = results['0'].formatted_address;
                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }, function (err) {
                    if (err.code == 3) {
                        alert("Time out! Please manually input search");
                         document.getElementById("my-input-searchbox").value = "";

                    }
                    if (err.code == 1) {
                        alert("Please enable your location access");
                        document.getElementById("my-input-searchbox").value = "";

                    }
                    if (err.code == 2) {
                        alert("Location Unavailable");
                        document.getElementById("my-input-searchbox").value = "";

                    }
                }, {enableHighAccuracy: true, Infinity: Infinity, timeout: 6000}
                );
            } else {
                alert("Navigation Geolocation API is not supported");
            }
        }
    })

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
    $('#currentWindow').prepend('<button type="button" id="currentLocationButton" class="btn-primary-location"  style="display:flex; background-color: #bbb;  border-radius: 50%;width: 40px; height: 40px;"><i font-feature-settings: "liga" class="material-icons" style="margin: auto">my_location</i></button>');
    $('#comboSection').prepend('<input type="text" id="my-input-searchbox" style="margin-top: auto; margin-bottom: auto;" required type="text" pattern="^[a-zA-Z0-9,-.+ ]*$"/>');
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
        choosenLat = "";
        choosenLng = "";
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
        choosenLat = place.geometry.location.lat();
        choosenLng = place.geometry.location.lng();
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
            choosenLat = "";
            choosenLng = "";
            if (markersArray.length != 0) {
                for (var i = 0; i < markersArray.length; i++) {
                    markersArray[i].setMap(null);
                }
                markersArray.length = 0;
            }

            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(function (position) {
                    var currLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);
                    choosenLat = position.coords.latitude;
                    choosenLng = position.coords.longitude;
                    // plot the currLocation on Google Maps, or handle accordingly:
                    var marker = new google.maps.Marker({title: 'Current Location',
                        map: map,
                        position: currLocation});

                    map.setCenter(currLocation);
                    markersArray.push(marker);
                    map.setZoom(17);
                    var geocoder = new google.maps.Geocoder();
                    geocoder.geocode({'address': position.coords.latitude + "," + position.coords.longitude}, function (results, status) {
                        if (status === 'OK') {
                            document.getElementById("my-input-searchbox").value = results['0'].formatted_address;
                        } else {
                            alert('Geocode was not successful for the following reason: ' + status);
                        }
                    });
                }, function (err) {
                    if (err.code == 1) {
                        alert("Please enable your location access");
                    }
                });
            } else {
                alert("Navigation Geolocation API is not supported");
            }
        }
    })

    $(window).resize(function () {
        // (the 'map' here is the result of the created 'var map = ...' above)
        google.maps.event.trigger(map, "resize");
    });

    return true;

}

async function plotCurrentLocation(map) {
    if (navigator.geolocation) {
        navigator.geolocation.getCurrentPosition(function (position) {
            var currLocation = new google.maps.LatLng(position.coords.latitude, position.coords.longitude);

            // plot the currLocation on Google Maps, or handle accordingly:

            var marker = new google.maps.Marker({title: 'Current Location',
                map: map,
                position: currLocation});

            map.setCenter(currLocation);

            var geocoder = new google.maps.Geocoder();
            geocoder.geocode({'address': position.coords.latitude + "," + position.coords.longitude}, function (results, status) {
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
        navigator.geolocation.getCurrentPosition(function (position) {
            var pos = {
                lat: position.coords.latitude,
                lng: position.coords.longitude
            };


        }, function () {
            alert("Error");
        });
    } else {
        // Browser doesn't support Geolocation
        alert("Doesn't support geolocation");
    }

}
function processInput(currentDestination, currentShop, userlat, userlng, startingName) {
    var isLogin = false;
    var dateTime = "";
    if (username != "") {
        isLogin = true;
        dateTime = new Date().toLocaleString();

    }
    
    $.ajax({
    data: { currentDestination: currentDestination, currentShop: currentShop , userlat: userlat, userlng: userlng , isLogin: isLogin, username: username , dateTime: dateTime , startingName: startingName},
    url: 'users/user_input_process.php',
    async: false,
    method: 'POST', // or GET
    success: function (msg) {
      var obj = JSON.parse(msg);
      console.log(obj['error']);
      var error = parseInt(obj['error']);
      console.log(error);
      if(error == 0){
      currentlyChoosen = 3;
      toggleView(currentlyChoosen);      
      console.log(msg);
      destinationName = obj['destinationName'];
      carparkName = obj['carparkName'];
      destlat = obj['destlat'];
      destlng = obj['destlng'];
      occupancy = obj['occupancy'];
      url = obj['url'];
      userlat = obj['userlat'];
      userlng = obj['userlng'];
      shopName = obj['areaName'];
     
      $("#carpark_dynamic").html(carparkName);
      $("#starting_placeholder").text("From : " + startingName);
      $("#destination_placeholder").text("To : " + shopName + ", " + destinationName);
      $("#occupancy_placeholder").text("Carpark is " + occupancy + "% full");
      $('#url_button').attr('href' , url);
      $('#url_button').attr('target' , "_blank");
      

      $("#final_copy").click(function(){
        var copyText = $('#url_button').attr('href');
        var textarea = document.createElement("input");
        textarea.value = copyText;
        textarea.style.position = "fixed";
        document.body.appendChild(textarea);
        textarea.select();
        textarea.setSelectionRange(0, 99999); /*For mobile devices*/
        document.execCommand("copy"); 
        alert("Successfully copied");
        document.body.removeChild(textarea);
        /* Alert the copied text */
      })
    }else{
        alert("Invalid Input");
    }
      // window.open(msg, '_blank');
    }
  });

}

function showShops(destination) {
    if (destination == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    }
    if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
    } else { // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }
    $.ajax({
        data: {destination},
        url: 'users/user_input_process.php',
        method: 'POST',
        success: function (msg) {
            // console.log(msg);
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
    currentDestination = $('#destinationInput').val();
    if(currentDestination != undefined){
      if (currentDestination != 0) {
        currentlyChoosen = 1;
        changeBackground(currentDestination);
        toggleView(currentlyChoosen)
        //Retrieve current Destination data from DB 
        $("#shopInput").empty();
        showShops(currentDestination);
      }else{
        alert("Please input a value first");
      }
    }else{
      alert("Please input a value first");
    }
  })

  $('#shop_submit').click(function () {
    currentShop = $('#shopInput').val();
    if(currentShop != undefined){
      if (currentShop != -1) {
        currentlyChoosen = 2;
        toggleView(currentlyChoosen);
        initAutocompleteNoMap();
      }
    }else{
      alert("Please input a value first");
    }
    // processInput(currentDestination , currentShop);

        // processInput(currentDestination , currentShop);

    })

    $('#shop_back').click(function () {
        currentlyChoosen = 0;
        $('.overlay').css('background-color', 'rgba(0,0,0,0.5');
        $('#mainbody').css('background-image', 'url(https://ict-1004-project1.s3-ap-southeast-1.amazonaws.com/background4.jpg)');
        toggleView(currentlyChoosen);
    })

    $('#user_location_form').submit(function (e) {
        e.preventDefault();
    })

    $('#my-input-searchbox').keyup(function (e) {
        var keyCode = e.keyCode || e.which;
        if (keyCode == 13) {
            console.log("Entered is press");
        }
    })

    $('#location_submit').click(function () {
        if ($('#my-input-searchbox').val() != "" && $('#my-input-searchbox').val() != "Loading . . .") {
            if (choosenLat != undefined && choosenLng != undefined) {
                processInput(currentDestination, currentShop, choosenLat, choosenLng, $('#my-input-searchbox').val());
            }
            else{
                alert("Input value is invalid");
            }
        } else {
            alert("Please input a value first");
        }
    })



    $('#location_back').click(function () {
        choosenLng = undefined; 
        choosenLng = undefined;
        currentlyChoosen = 1;
        toggleView(currentlyChoosen);
        $('#comboSection').remove();
        $('#currentLocationButton').remove();
    })

    $('#final_back').click(function () {
        choosenLng = undefined; 
        choosenLng = undefined;
        currentlyChoosen = 2;
        $('#header_text_final').remove();
        toggleView(currentlyChoosen);
    })

  $("#history_copy").click(function(){
    var copyText = $('#history_url_button').attr('href');
    var textarea = document.createElement("input");
    textarea.value = copyText;
    textarea.style.position = "fixed";
    document.body.appendChild(textarea);
    textarea.select();
    textarea.setSelectionRange(0, 99999); /*For mobile devices*/
    document.execCommand("copy"); 
    alert("Successfully copied");
    document.body.removeChild(textarea);
    /* Alert the copied text */
  })


});


