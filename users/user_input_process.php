<?php

//turn off error reporting
error_reporting(1);
include "../connections.php";
require "../initialize.php";
$currentDestination = null;
$currentShop = null;
$products = [];
if (isset($_POST['destination'])) {
    if ($_POST['destination'] == 1) {
        // Expo 
        $connection = new connections();
        $products = $connection->retrieve_data_where("area", "location_id", $_POST['destination']);
    }
    if ($_POST['destination'] == 2) {
        // Suntec City 
        $connection = new connections();
        $products = $connection->retrieve_data_where("area", "location_id", $_POST['destination']);
    }
}

if (isset($_POST['currentDestination'])) {
    $currentDestination = $_POST['currentDestination'];
}
if (isset($_POST['currentShop'])) {
    $currentShop = $_POST['currentShop'];
}


?>