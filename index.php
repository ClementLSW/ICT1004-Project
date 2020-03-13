<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        //turn off error reporting
        error_reporting(0);
        include "header.inc.php";
        include 'connections.php';
        ?>        
        <script src="resources/js/select2.min.js"></script>
        <link href="resources/css/select2.min.css" rel="stylesheet" />

    </head>
    <body>
        <?php include 'navigation.php'; ?>
        <?php include 'users/userhome.php'; ?>
    </body>
</html>