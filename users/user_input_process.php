<?php 
    include "../connections.php";
    $currentDestination = null; 
    $currentShop = null;
    $products = [];
    if(isset($_GET['destination'])){
       if($_GET['destination'] == 1){
           // Expo 
           $connection = new connections();
           $products = $connection -> retrieve_data_where("area" , "location_id" , $_GET['destination']);
       }
       if($_GET['destination'] == 2){
           // Suntec City 
           $connection = new connections();
           $products = $connection -> retrieve_data_where("area" , "location_id" , $_GET['destination']);
       }
       
       return $products;
    }

    if (isset($_POST['currentDestination']) )
    {
        $currentDestination = $_POST['currentDestination'];
    }
    if (isset($_POST['currentShop']) )
    {
        $currentShop = $_POST['currentShop'];
    }

?>