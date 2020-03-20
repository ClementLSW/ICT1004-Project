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
        include "initialize.php";
        require __DIR__ . '/header.inc.php';
        if($GLOBALS['debug']){print("Header is working");};
        require __DIR__ . '/connections.php';
        if($GLOBALS['debug']){print("connections is working");};
        session_start();
         if($GLOBALS['debug']){print_r($_SESSION);};
        route('/ICT1004-Project/home', function () {
            // $GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
            require __DIR__ . '/views/home.php';
            if($GLOBALS['debug']){print("home is working");};
        });
        
        route('/ICT1004-Project/userlogin', function () {
            // $GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
             require __DIR__ . '/views/login.php';
        });
        
         route('/ICT1004-Project/register', function () {
            // $GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
             require __DIR__ . '/views/register.php';
        });
        
       
        
        //  route('/ICT1004-Project/testing', function () {
        //     $GLOBALS['root'] = __DIR__;
        //     $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
        //      require __DIR__ . '/views/mapview.php';
        // });
        
          route('/ICT1004-Project/logout', function () {
            //$GLOBALS['root'] = __DIR__;
            $GLOBALS['valid'] = true; // Used to block ppl from direct accessing my pages
            require __DIR__ . '/views/logout.php';
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