<html>
    <head>
        <?php include 'header.inc.php'; ?>
    </head>
    <body>
        <?php include 'navigation.php';?>
        <?php
        include "connections.php";
        $occupancy[];
        
        function get_occupancy(){
            // Returns key value pair array of AreaID and occupancy rate
            // E.g. "11":"65"
            reset($occupancy);
            $lots = retrieve_data_where("AREA", "type", "1");   
            for($i=0; $i < num_rows($lots); $i++){
                $occupancy[$lots["area_id"]] = $lots["occupancy"];
            }
            return $occupancy;
        }
        
        function get_lot_occupancy($LotID){
            // Takes in lotID as param
            // Returns occupancy rate
            // E.g. get_lot_occupancy("11")
            // Return 65;
            $lotOccupancy = retrieve_data_where("AREA", "AreaID", $LotID);
            return $lotOccupancy["Occupancy"];
        }
        ?>
        
    </body>
    <?php include "footer.inc.php"; ?>
</html>
