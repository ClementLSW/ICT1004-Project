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
        include "../header.inc.php";
        ?>
    </head>
    <body>
        <?php
        include "../navigation.php";
        include "../connections.php";
        
        $conn = establish_connection();

        $sql = "SELECT * FROM carpark.users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
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
                    while ($row = $result->fetch_assoc()) {
                        echo "<tr style='color:black;'>"
                        . "<td>" . $row['username'] . "</td>"
                        . "<td>" . $row['fname'] . "</td>"
                        . "<td>" . $row['lname'] . "</td>"
                        . "<td>" . $row['password'] . "</td>"
                        . "<td>" . $row['email'] . "</td>"
                        . "<td>" . $row['contact'] . "</td>"
                        . "<td>" . $row['permissions'] . "</td>"
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
        }
        ?>

    </body>
</html>
