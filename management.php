<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <?php
        include "header.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "navigation.php";
        include "connections.php";
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
                if (sizeof($users) > 0) {
                    for ($i = 0; $i < sizeof($users); $i++) {
                        echo "<tr>"
                        . "<td>" . $users[$i]['username'] . "</td>"
                        . "<td>" . $users[$i]['fname'] . "</td>"
                        . "<td>" . $users[$i]['lname'] . "</td>"
                        . "<td>" . $users[$i]['password'] . "</td>"
                        . "<td>" . $users[$i]['email'] . "</td>"
                        . "<td>" . $users[$i]['contact'] . "</td>"
                        . "<td>" . $users[$i]['permissions'] . "</td>"
                        . "</tr>";
                    }
                    ?>
                </tbody>
            </table>     
            <script>
                $(document).ready(function () {
                    $('#myTable').DataTable();
                });
            </script>

            <?php
        } else {
            echo "0 Results";
        }
        unset($users);
        ?>

    </body>
</html>
