<?php
error_reporting(0);
/**
 * Holds the registered routes
 *
 * @var array $routes
 */
$routes = [];

/**
 * Register a new route
 *
 * @param $action string
 * @param \Closure $callback Called when current URL matches provided action
 */
function route($action, Closure $callback)
{
    global $routes;
    $action = trim($action, '/');
    $routes[$action] = $callback;
}

/**
 * Dispatch the router
 *
 * @param $action string
 */
function dispatch($action)
{
    global $routes;
    $action = trim($action, '/');
    try{
        
        if(isset($routes[$action])){
            $callback = $routes[$action];
            echo call_user_func($callback);
        }else{
            $actionError = trim("/ICT1004-Project/error", '/');
            $callbackError = $routes[$actionError];
            echo call_user_func($callbackError);
        }

    }catch(Exception $e){
        echo 'Caught exception: ',  $e->getMessage(), "\n";

    }
    
}

?>