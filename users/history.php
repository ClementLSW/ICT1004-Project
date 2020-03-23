<?php if (isset($GLOBALS['valid'])  && $GLOBALS['valid'] && isset($_SESSION['username'])) : ?>
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.10.20/js/dataTables.bootstrap.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/dataTables.responsive.min.js"></script>
    <script src="https://cdn.datatables.net/responsive/2.2.3/js/responsive.bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap.min.css" type="text/css">
    <link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.3/css/responsive.bootstrap.min.css" type="text/css">
    <script defer src="https://use.fontawesome.com/releases/v5.12.1/js/all.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.12.1/css/all.css">
    <?php
    require $GLOBALS['root'] . '/admin/header.inc.php';;
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
                    <th class="th-sm">Action</th>
                </tr>
            </thead>
            <tbody>
                <?php $allData = [];
                while ($row = $result->fetch_assoc()) { ?>
                    <tr>
                        <td><?php echo $row['date_time']; ?></td>
                        <td><?php echo $row['startingName']; ?></td>
                        <td><?php echo $row['destinationName']; ?></td>
                        <td><a style="margin: auto" name=<?php echo $row['user_id'] ?> class="goToButton btn btn-primary">Go to</a></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
        <form action="/ICT1004-Project/historySearch" method="POST" id="hiddenForm" style="display: none">
            <input id="carparkName" name="carparkName"></input>
            <input id="destlat" name="destlat"></input>
            <input id="destlng" name="destlng"></input>
            <input id="occupancy" name="occupancy"></input>
            <input id="url" name="url"></input>
            <input id="userlat" name="userlat"></input>
            <input id="userlng" name="userlng"></input>
            <input id="shopName" name="shopName"></input>
            <input id="startingName" name="startingName"></input>
            <input id="destinationName" name="destinationName"></input>
            
        </form>
        <script>
               function processInput(currentDestination, currentShop, userlat, userlng, startingName , username) {
                var dateTime = "";
                isLogin = true;
                console.log(currentDestination);
                console.log(currentShop);
                console.log(userlat);

                console.log(userlng);

                console.log(startingName);
                console.log(username);

                dateTime = new Date().toLocaleString();
                console.log(dateTime);

                $.ajax({
                    data: {
                        currentDestination: currentDestination,
                        currentShop: currentShop,
                        userlat: userlat,
                        userlng: userlng,
                        isLogin: isLogin,
                        username: username,
                        dateTime: dateTime,
                        startingName: startingName
                    },
                    url: 'users/user_input_process.php',
                    method: 'POST', // or GET
                    success: function(msg) {
                        var obj = JSON.parse(msg);
                        destinationName = obj['destinationName'];
                        carparkName = obj['carparkName'];
                        destlat = obj['destlat'];
                        destlng = obj['destlng'];
                        occupancy = obj['occupancy'];
                        url = obj['url'];
                        userlat = obj['userlat'];
                        userlng = obj['userlng'];
                        shopName = obj['areaName'];
                        
                        $("#destinationName").val(destinationName);
                        $("#carparkName").val(carparkName);
                        $("#destlat").val(destlat);
                        $("#destlng").val(destlng);
                        $("#occupancy").val(occupancy);
                        $("#url").val(url);
                        $("#userlat").val(userlat);
                        $("#userlng").val(userlng);
                        $("#shopName").val(shopName);
                        $("#startingName").val(startingName);
                        $("#hiddenForm").submit();
                        
                        // var obj = JSON.parse(msg);
                        
                        // destinationName = obj['destinationName'];
                        // carparkName = obj['carparkName'];
                        // destlat = obj['destlat'];
                        // destlng = obj['destlng'];
                        // occupancy = obj['occupancy'];
                        // url = obj['url'];
                        // userlat = obj['userlat'];
                        // userlng = obj['userlng'];
                        // shopName = obj['areaName'];

                        // $("#carpark_dynamic").html(carparkName);
                        // $("#starting_placeholder").text("From : " + startingName);
                        // $("#destination_placeholder").text("To : " + shopName + ", " + destinationName);
                        // $("#occupancy_placeholder").text("Carpark is " + occupancy + "% full");
                        // $('#url_button').attr('href', url);
                        // $('#url_button').attr('target', "_blank");


                        // $("#final_copy").click(function() {
                        //     var copyText = $('#url_button').attr('href');
                        //     var textarea = document.createElement("input");
                        //     textarea.value = copyText;
                        //     textarea.style.position = "fixed";
                        //     document.body.appendChild(textarea);
                        //     textarea.select();
                        //     textarea.setSelectionRange(0, 99999); /*For mobile devices*/
                        //     document.execCommand("copy");
                        //     alert("Successfully copied");
                        //     document.body.removeChild(textarea);
                            /* Alert the copied text */
                        
                        // window.open(msg, '_blank');
                    }
                });

            }

            $(document).ready(function() {
                $('#table').DataTable();
               

                $("#success-message").fadeTo(2000, 500).slideUp(500, function() {
                    $("#success-message").slideUp(500);
                });
            });

            $('.goToButton').click(async function(e) {
                    historyID = e.target.name;
                    await $.ajax({
                        data: {
                            historyID: historyID,
                        },
                        url: 'users/user_input_process.php',
                        method: 'POST', // or GET
                        success: async function(msg) {
                            data = JSON.parse(msg);
                            console.log(data);
                            destinationNameCombined = data[0]['destinationName'];
                            destinationName = destinationNameCombined.split(",")[0];
                            username = data[0]['username'];
                            currentShop = destinationNameCombined.split(", ")[1];
                            userlat = data[0]['start_point'].split(",")[0];
                            userlat = userlat.trim();
                            userlng = data[0]['start_point'].split(",")[1];
                            startingName = data[0]['startingName'];
                            await $.ajax({
                                data: {
                                    destinationName: destinationName,
                                    shopName: currentShop
                                },
                                url: 'users/user_input_process.php',
                                method: 'POST', // or GET
                                success: function(data2) {
                                    obj = JSON.parse(data2);
                                    currentDestination = obj['destinationID'];
                                    currentShop = obj['shopID'];

                                }
                            })
                        processInput(currentDestination, currentShop, userlat, userlng, startingName , username);
                        }

                    });
                });
         
        </script>
    </section>
<?php else : ?>
    <?php require '../header.inc.php' ?>
    <?php include '../views/404.php' ?>
<?php endif; ?>