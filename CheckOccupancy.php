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
            $lots = retrieve_data_where("AREA", "type", "1");   
            for($i=0; $i < num_rows($lots); $i++){
                $occupancy[$lots["area_id"]] = $lots["occupancy"];
            }
            return $occupancy;
        }
        
        function get_lot_occupancy($LotID){
            $lotOccupancy = retrieve_data_where("AREA", "AreaID", $LotID);
            return $lotOccupancy["Occupancy"];
        }
        ?>
        
    </body>
    <?php include "footer.inc.php"; ?>
</html>
