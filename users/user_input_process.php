<?php 
    $currentDestination = null; 
    $currentShop = null;

    if (isset($_POST['currentDestination']) )
    {
        $currentDestination = $_POST['currentDestination'];
    }
    if (isset($_POST['currentShop']) )
    {
        $currentShop = $_POST['currentShop'];
    }

?>