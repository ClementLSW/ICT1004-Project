<!DOCTYPE html>
<html lang="en">
    <head>
        <?php
        //turn off error reporting
        error_reporting(1);
        // include "header.inc.php";
        // include 'connections.php';
        //URL Routing
        require_once "router.php";
        route('/ICT1004-Project/home', function () {
            $GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
            require __DIR__ . '/header.inc.php';
             require __DIR__ . '/connections.php';
             require __DIR__ . '/views/home.php';
        });
        
        route('/ICT1004-Project/login', function () {
            $GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
            require __DIR__ . '/header.inc.php';
             require __DIR__ . '/connections.php';
             require __DIR__ . '/views/login.php';
        });

        route('/ICT1004-Project/error', function () {
            http_response_code(404);
            require __DIR__ . '/views/404.php';
        });

        $action = $_SERVER['REQUEST_URI'];
        dispatch($action);
        
        ?> 
    </head>
</html>