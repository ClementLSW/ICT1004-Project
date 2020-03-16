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
        
        function get_dest() {
            $dest = $_POST["shopInput"];
            return $dest;
        }
        
        function get_available_CP(){
            $availCP = retrieve_cp_by_occupancy(80);
            return $availCP;
        }
        
        function checkZoneValue(){
            $validCP = get_available_CP();
            if(retrieve_data_where("AREA", "area_id", get_dest())["zone"] == "1"){
                for($i=0; $i<count($validCP); $i++){
                    if($validCP[$i]["zone"] == "A"){
                        $validCP[$i]["y_weight"] = 1;
                    }
                    else if($validCP[$i]["zone"] == "B"){
                        $validCP[$i]["y_weight"] = 2;
                    }
                    
                    $validCP[$i]["total"] = $validCP[$i]["x_weight"] + $validCP[$i]["y_weight"];
                    return $validCP;
                }
                
                
                // Zone A lots weight 1
            }
            else if (retrieve_data_where("AREA", "area_id", get_dest())["zone"] == "2"){
                for($i=0; $i<count($validCP); $i++){
                    if($validCP[$i]["zone"] == "A"){
                        $validCP[$i]["y_weight"] = 2;
                    }
                    else if($validCP[$i]["zone"] == "B"){
                        $validCP[$i]["y_weight"] = 1;
                    }
                    
                    $validCP[$i]["total_weight"] = $validCP[$i]["x_weight"] + $validCP[$i]["y_weight"];
                    return $validCP;
                }
            }
        }
        
        function get_best_cp(){
            // returns area_id of bestCP;
            $finalCPList = checkZoneValue();
            array_multisort($finalCPList["total_weight"], SORT_ASC, SORT_NUMERIC,
                    $finalCPList["occupancy"], SORT_ASC, SORT_NUMERIC);
            $bestCP = $finalCPList[0]["area_id"];
            return $bestCP;
        }
        
        

//        function get_start_nodes($routeList, $dest) {
//            // From the array, get value of start node based on end node
//            // Call like get_start_nodes(get_routes(),$_POST[])
////            if (count($checkedNodes) == 0) {
//            $tempArray[];
//                for ($i = 0; $i < count($routeList); $i++) {
//                    $currentNodeChecked = $routeList[$i]["end_node"];
//                    $temp = retrieve_data_where("AREA", "area_id", $currentNodeChecked);
//                    if ($temp["type"] != "hall") {
//                        if (get_lot_occupancy($temp["area_id"]) < $threshold) {
//                            return $currentNodeChecked;
//                        }
//                    }
//                    $tempArray[$i] = $currentNodeChecked;
//                    $checkedNodes[$i] = $currentNodeChecked;
//                }
//                for($n = 0; $n <count())
////            }
////            else {
////                for ($i = 0; $i < count($checkedNodes); $i++){
////                    if ($checkedNodes[$i] == $dest){
////                        $currentNodeChecked == $routesList[$i]["end_node"];
////                        
////                    }
////                }
////            }
//        }
        ?>

    </body>
    <?php include "footer.inc.php"; ?>
</html>