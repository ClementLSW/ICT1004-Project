<html>
    <head>
        <?php
        //turn off error reporting
        error_reporting(0);
        include 'header.inc.php';
        ?>
    </head>
    <body>
        <?php include 'navigation.php'; ?>
        <h1>Why are you here?</h1>
        <p>I'm calling the police</p>
        <?php
        include "connections.php";
        $checkedNodes[];

        function get_routes() {
            $dest = $_POST["shopInput"];
            $routes = retrieve_data_where("connection", "start_node", $dest);
            return $routes;
        }

        function get_start_nodes($routeList, $dest) {
            // From the array, get value of start node based on end node
            if (count($checkedNodes) == 0) {
                for ($i = 0; $i < count($routeList); $i++) {
                    if ($routeList[$i]["start_node"] == $dest) {
                        $currentNodeChecked = $routeList[$i]["end_node"];
                        $temp = retrieve_data_where("AREA", "area_id", $currentNodeChecked);
                        if ($temp["type"] != "hall") {
                            if (get_lot_occupancy($temp["area_id"]) < $threshold) {
                                return $currentNodeChecked;
                            }
                        }
                    }
                    $checkedNodes[$i] = $currentNodeChecked;
                }
            }
            else {
                for ($i = 0; $i < count($checkedNodes); $i++){
                    if ($checkedNodes[$i] == $dest){
                        $currentNodeChecked == $routesList[$i]["end_node"];
                        
                    }
                }
            }
        }
        ?>

    </body>
    <?php include "footer.inc.php"; ?>
</html>