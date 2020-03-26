<?php
if (isset($GLOBALS['valid'])&& $GLOBALS['valid'] && isset($_SESSION["permissions"])):
    if ($_SESSION["permissions"] == "admin"):
        ?>
        <?php
        require __DIR__ . '/header.inc.php';
        require $GLOBALS['root'] . '/navigation.php';
        require_once "debug.php";
        ?>        
        <section id="container2" style="margin-top: 120px;width: 100%; margin-left: 2%; margin-right: 2%;" role="main">
            <?php if (isset($_SESSION['message'])) { ?>
                <div id="success-message" class="alert alert-<?php echo $_SESSION['msg_type'] ?>">
                    <?php
                    echo $_SESSION['message'];
                    unset($_SESSION['message']);
                    ?>
                </div>
            <?php } ?>                

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
            $result = $conn->query("SELECT * FROM users");
            ?> 
            <table id="table" class="table table-bordered dt-responsive nowrap rounded" cellspacing="0" width="100%" style="background-color: white;">
                <thead>
                    <tr>                        
                        <th class="th-sm">Username</th>
                        <th class="th-sm">First Name</th>
                        <th class="th-sm">Last Name</th>
                        <th class="th-sm">Password</th>
                        <th class="th-sm">Email</th>
                        <th class="th-sm">Contact</th>
                        <th class="th-sm">Permissions</th>                    
                        <th class="th-sm">Actions</th>                          
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()) { ?>
                        <tr>                            
                            <td><?php echo $row['username']; ?></td>
                            <td><?php echo $row['fname']; ?></td>
                            <td><?php echo $row['lname']; ?></td>
                            <td><?php echo $row['password']; ?></td>
                            <td><?php echo $row['email']; ?></td>
                            <td><?php echo $row['contact']; ?></td>
                            <td><?php echo $row['permissions']; ?></td>
                            <td><a href="/ICT1004-Project/admin/update.php?user=<?php echo $row['id']; ?>" class="btn btn-success">Edit</a>
                                <a href="/ICT1004-Project/admin/process.php?delete=<?php echo $row['id']; ?>" class="btn btn-danger">Delete</a> </td>
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
    <?php else : 
        header("location:/ICT1004-Project/error");?>     
    <?php endif; ?>
<?php else : 
    header("location:/ICT1004-Project/error");?>
<?php endif; ?>