<?php if($GLOBALS['valid'] && isset($_SESSION['username'])): ?>
<script src="https://code.jquery.com/jquery-3.3.1.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" type="text/css">                            
    <?php
    require $GLOBALS['root'] . '/admin/header.inc.php';
    require $GLOBALS['root'] . '/navigation.php';    
    ?>
<section id="container2" style="margin-top: 120px;width: 100%; margin-left: 2%; margin-right: 2%;">        
    <?php if (isset($_SESSION['message'])) { ?>
        <div id="success-message" class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
            <?php
            echo $_SESSION['message'];
            unset($_SESSION['message']);
            ?>
        </div>
    <?php } ?>                
    <?php
    if (isset($_SESSION['username'])) {
        $user = $_SESSION['username'];
    } else {
        //redirects to error page
    }
    ?>
    <?php
    if ($GLOBALS['localtesting'] == true) {
        $conn = new mysqli('localhost', 'root', '', 'carpark');
    } else {
        $config = parse_ini_file('/var/www/private/db-config.ini');
        $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
    }
    if ($conn->connect_error) {
        die("Connection error: " . $conn->connect_error);
    }
    
    $result = $conn->query("SELECT * FROM history WHERE username='" . $_SESSION['username'] . "'");
    $conn->close();
    ?> 
    <table id="table" class="table table-bordered dt-responsive nowrap" cellspacing="0" width="100%" style="background-color: #fff">
        <thead>
            <tr>                        
                <th class="th-sm">Date/Time</th>
                <th class="th-sm">Starting Location</th>
                <th class="th-sm">Destination</th>                                 
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()) { ?>
                <tr>                            
                    <td><?php echo $row['date_time']; ?></td>
                    <td><?php echo $row['startingName']; ?></td>
                    <td><?php echo $row['destinationName']; ?></td>                        
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
</section>
<?php else : ?>
    <?php require $GLOBALS['root']. '/header.inc.php' ?>
    <?php include $GLOBALS['root']. '/views/404.php' ?>
<?php endif; ?>