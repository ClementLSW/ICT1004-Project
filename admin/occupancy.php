<html>
    <head>                     
        <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
        <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css">
        <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" type="text/css">        
        <?php include "header.inc.php"; ?>       
        <link rel="stylesheet" href="main.css" type="text/css">       
    </head>
    <body style="color:white;">
        <?php
        include "../navigation.php";
        require_once "process.php";
        require_once "debug.php";
        ?>        
        <div style="height:80px;"></div>        
        <div id="container1">
            <?php if (isset($_SESSION['message'])) { ?>
                <div id="success-message" class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>                
            <?php
            if ($GLOBALS['local'] == true) {
                $conn = new mysqli('localhost', 'root', '', 'carpark');
            } else {
                $config = parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            }
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            }
            $result = $conn->query("SELECT * FROM area");
            ?> 
            <table id="table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%">
                <thead>
                    <tr>                        
                        <th class="th-sm">Area ID</th>
                        <th class="th-sm">Type</th>
                        <th class="th-sm">Occupancy</th>
                        <th class="th-sm">Location ID</th>
                        <th class="th-sm">Name</th>      
                        <th class="th-sm">Action</th>                        
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>                            
                            <td><?php echo $row['area_id']; ?></td>
                            <td><?php echo $row['type']; ?></td>
                            <td><?php echo $row['occupancy']; ?></td>
                            <td><?php echo $row['location_id']; ?></td>
                            <td><?php echo $row['name']; ?></td>                                                           
                            <td><a href="update.php?area=<?php echo $row['area_id']; ?>" class="btn btn-success">Edit</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
            <script>
                $(document).ready(function () {
                    $('#table').DataTable();
                });

                $("#success-message").fadeTo(2000, 500).slideUp(500, function () {
                    $("#success-message").slideUp(500);
                });
            </script>  
        </div>
    </body>
</html>