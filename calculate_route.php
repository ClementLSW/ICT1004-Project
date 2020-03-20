
        <?php
        // include "connections.php";
        $connection2 = new connections();

        function get_dest($hallValue)
        {
            $dest = $hallValue;
            return $dest;
        }

        function get_available_CP()
        {
            global $connection2;
            $availCP = $connection2->retrieve_cp_by_occupancy(80);
            return $availCP;
        }

        function checkZoneValue($hallValue)
        {
            global $connection2;
            $validCP = get_available_CP();
            $validCPList = [];
            for($i = 0; $i < count($validCP); $i++){
                if($validCP[$i]["location_id"] == 1){
                    if($validCP[$i]["type"] != "hall"){
                        array_push($validCPList, $validCP[$i]);
                    }
                }
            }

            $validCP = $validCPList;
                for ($i = 0; $i < count($validCP); $i++) {
                    if ($validCP[$i]["zone"] == "A") {
                        $validCP[$i]["yweight"] = 1;
                    } else if ($validCP[$i]["zone"] == "B") {
                        $validCP[$i]["yweight"] = 2;
                    }

                    $validCP[$i]["total"] = $validCP[$i]["xweight"] + $validCP[$i]["yweight"];}
            print_r($validCP);
                return $validCP;

                // Zone A lots weight 1
            // } else if ($connection2->retrieve_data_where("AREA", "area_id", get_dest($hallValue))["zone"] == "2") {
            //     for ($i = 0; $i < count($validCP); $i++) {
            //         if ($validCP[$i]["zone"] == "A") {
            //             $validCP[$i]["y_weight"] = 2;
            //         } else if ($validCP[$i]["zone"] == "B") {
            //             $validCP[$i]["y_weight"] = 1;
            //         }

            //         $validCP[$i]["total_weight"] = $validCP[$i]["x_weight"] + $validCP[$i]["y_weight"];
            //         return $validCP;
            //     }
            
        }

        function get_best_cp($hallValue)
        {   
         
            // returns area_id of bestCP;
            $finalCPList = checkZoneValue($hallValue);
            array_multisort(
                $finalCPList,
                $finalCPList["total"],
                SORT_ASC,
                SORT_NUMERIC,
                $finalCPList["occupancy"],
                SORT_ASC,
                SORT_NUMERIC
            );
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
