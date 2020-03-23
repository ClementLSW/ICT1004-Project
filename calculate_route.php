
        <?php
        // include "connections.php";
        $connection = new connections();

        function get_dest($hallValue)
        {
            $dest = $hallValue;
            return $dest;
        }

        function get_available_CP(){
            global $connection;
            $availCP = $connection->retrieve_cp_by_occupancy(80);
            if($availCP == NULL){
                $availCP = $connection->retrieve_data_where("AREA", "type", "carpark");
            }
            return $availCP;
        }

        function checkZoneValue($hallValue)
        {
            global $connection;
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

        function get_best_cp($destzone){
            global $connection;
            $threshold = 80;
            
            // Gets the list by zone
            $listA = $connection->retrieve_cp_by_zone('A');
            $listB = $connection->retrieve_cp_by_zone('B');
            $listC = $connection->retrieve_cp_by_zone('C');
            
            // Orders the lists by occupancy
            usort($listA, function($a, $b){
                return $a['occupancy'] <=> $b['occupancy'];
            });
            usort($listB, function($a, $b){
                return $a['occupancy'] <=> $b['occupancy'];
            });
            usort($listC, function($a, $b){
                return $a['occupancy'] <=> $b['occupancy'];
            });
            
            // Depending on destination hall's zone, run through lists in specific sequence
            switch($destzone){
                case "A":
                    for($i=0; $i<count($listA); $i++){
                        if($listA[$i]['occupancy'] <= $threshold){
                            return Array($listA[$i]['area_id'], $listA[$i]['occupancy']);
                        }
                    }
                    for($i=0; $i<count($listB); $i++){
                        if($listB[$i]['occupancy'] <= $threshold){
                            return Array($listB[$i]['area_id'], $listB[$i]['occupancy']);
                        }
                    }
                    for($i=0; $i<count($listC); $i++){
                        if($listC[$i]['occupancy'] <= $threshold){
                            return Array($listC[$i]['area_id'] ,$listC[$i]['occupancy']);


                        }
                    }
                break;
                case "B":
                    for($i=0; $i<count($listB); $i++){
                        if($listB[$i]['occupancy'] <= $threshold){
                            return Array($listB[$i]['area_id'], $listB[$i]['occupancy']);


                        }
                    }
                    for($i=0; $i<count($listA); $i++){
                        if($listA[$i]['occupancy'] <= $threshold){
                            return Array($listA[$i]['area_id'], $listA[$i]['occupancy']);

                        }
                    }
                    for($i=0; $i<count($listC); $i++){
                        if($listC[$i]['occupancy'] <= $threshold){
                            return Array($listC[$i]['area_id'] ,$listC[$i]['occupancy']);


                        }
                    }
                break;
                case "C":
                    for($i=0; $i<count($listC); $i++){
                        if($listC[$i]['occupancy'] <= $threshold){
                            return Array($listC[$i]['area_id'] ,$listC[$i]['occupancy']);


                        }
                    }
                    for($i=0; $i<count($listB); $i++){
                        if($listB[$i]['occupancy'] <= $threshold){
                            return Array($listB[$i]['area_id'], $listB[$i]['occupancy']);

                        }
                    }
                    for($i=0; $i<count($listA); $i++){
                        if($listA[$i]['occupancy'] <= $threshold){
                            return Array($listA[$i]['area_id'], $listA[$i]['occupancy']);

                        }
                    }
                break;
            }
            
            // In case no available lots just give best in their area
            switch($destzone)
            {
                case "A":
                    return Array($listA[0]['area_id'], $listA[0]['occupancy']);

                case "B":
                    return Array($listB[0]['area_id'], $listB[0]['occupancy']);

                case "C":
                    return Array($listC[0]['area_id'] ,$listC[0]['occupancy']);

            }
        }

        
//        

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


