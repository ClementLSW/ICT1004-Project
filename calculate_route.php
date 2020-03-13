<html>
    <head>
        <?php include 'header.inc.php'; ?>
    </head>
    <body>
        <?php include 'navigation.php';?>
        <?php
        include "connections.php";
        function getAllRoutes(){
            $dest = $_POST["shopInput"];
            $routes = retrieve_data_where("connection", "start_node", $dest);
            return $routes;
            
        }
        ?>
        
    </body>
    <?php include "footer.inc.php"; ?>
</html>