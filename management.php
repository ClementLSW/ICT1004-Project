<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="resources/js/lib/data_tables.js"></script>
        <link type="text/css" href="resources/css/management.css" rel="stylesheet">
        <?php
        include "header.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "navigation.php";
        include "connection_test.php";
        ?>        
        <table id="myTable" class="display" style="width:100%;">
            <thead>
                <tr>
                    <th>Username</th>
                    <th>First Name</th>
                    <th>Last Name</th>
                    <th>Password</th>
                    <th>Email</th>
                    <th>Contact</th>
                    <th>Permissions</th>
                </tr>
            </thead>
            <tbody>                
                <?php
                retrieve_all_data('users');
                foreach ($data as $row) {
                    echo $row['username'] . "<br>";
                }
//                if (sizeof($results) > 0) {
//                    foreach ($results as $user) {
//                        echo "<tr style='color:black;'>"
//                        . "<td>" . $user['username'] . "</td>"
//                        . "<td>" . $user['fname'] . "</td>"
//                        . "<td>" . $user['lname'] . "</td>"
//                        . "<td>" . $user['password'] . "</td>"
//                        . "<td>" . $user['email'] . "</td>"
//                        . "<td>" . $user['contact'] . "</td>"
//                        . "<td>" . $user['permissions'] . "</td>"
//                        . "</tr>";
//                    }                
                ?>
            </tbody>
        </table>     
        <script>
            $(document).ready(function () {
                $('#myTable').DataTable();
            });
        </script>

        <?php
//        } else {
//            echo "0 Results";
//        }
        ?>

    </body>
</html>
