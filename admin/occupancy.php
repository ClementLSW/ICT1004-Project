<?php
if ($GLOBALS['valid'] && isset($_SESSION["permissions"])):
    if ($_SESSION["permissions"] == "admin"):
        ?>
        <?php
        require __DIR__ . '/header.inc.php';
        require $GLOBALS['root'] . '/navigation.php';
        require_once "debug.php";
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
            if ($GLOBALS['local'] == true) {
                $conn = new mysqli('localhost', 'root', '', 'carpark');
            } else {
                $config = parse_ini_file('/var/www/private/db-config.ini');
                $conn = new mysqli($config['servername'], $config['username'], $config['password'], $config['dbname']);
            }
            if ($conn->connect_error) {
                die("Connection error: " . $conn->connect_error);
            }
            $type = "carpark";
            $result = $conn->prepare("SELECT * FROM area WHERE type=?");
            $result->bind_param('s', $type);
            $result->execute();
            $rows = $result->get_result();
            ?> 
            <table id="table" class="table table-bordered dt-responsive nowrap rounded" cellspacing="0" width="100%" style="background-color: white;">
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
                    <?php while ($row = $rows->fetch_assoc()) { ?>
                        <tr>                            
                    <form action="/ICT1004-Project/admin/process.php" method="get">
                        <td><?php echo $row['area_id']; ?></td>
                        <input type="hidden" name="area_id" value="<?php echo $row['area_id']; ?> ">
                        <td><?php echo $row['type']; ?></td>                   
                        <td><input type="text" style="color:black;" name="new_occupancy" value="<?php echo $row['occupancy']; ?>"></td>  
                        <td><?php echo $row['location_id']; ?></td>
                        <td><?php echo $row['name']; ?></td>                                                           
                        <td><input type="submit" value="Update" class="btn btn-success""></a></td>
                    </form> 
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
        <?php include $GLOBALS['root'] . "/views/404.php"; ?>
    <?php endif; ?>
<?php else : ?>
    <?php include $GLOBALS['root'] . "/views/404.php"; ?>
<?php endif; ?>