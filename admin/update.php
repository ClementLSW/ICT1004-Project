<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <script src="https://code.jquery.com/jquery-2.1.3.min.js"></script>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></link>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>   
    </head>
    <body>
                <?php
                require_once "debug.php";
                if (session_status() == PHP_SESSION_NONE) {
                    session_start();
                }
                if ($GLOBALS['local'] == true) {
                    $conn = new mysqli('localhost', 'root', '', 'carpark');
                } else {
                    $conn = new mysqli('localhost', 'sqldev', 'P@ssw0rd', 'carpark');
                }

                if (isset($_GET['user'])) {
                    $id = $_GET['user'];
                    $result = $conn->query("SELECT * FROM users WHERE id='$id'");
                }
                while ($row = $result->fetch_assoc()) {
                        $username = $row['username'];
                        $fname = $row['fname'];
                        $lname = $row['lname'];
                        $password = $row['password'];
                        $email = $row['email'];
                        $contact = $row['contact'];
                        $permissions = $row['permissions'];
                }
                ?>
        <div class="container">
            <div class="row justify-content-center">
                <form action="process.php" method="POST">
                    <div class="form-group">
                        <label>Username</label>
                        <input class="form-control" type="text" name="username" class="form-control" value="<?php echo $username ?>">
                    </div>                
                    <div class="form-group">
                        <label>First Name</label>
                        <input class="form-control" type="text" name="fname" class="form-control" value="<?php echo $fname ?>">
                    </div>       
                    <div class="form-group">
                        <label>Last Name</label>
                        <input class="form-control" type="text" name="lname" class="form-control" value="<?php echo $lname ?>">
                    </div>        
                    <div class="form-group">
                        <label>Password</label>
                        <input class="form-control" type="text" name="password" class="form-control" value="<?php echo $password ?>">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input class="form-control" type="text" name="email" class="form-control" value="<?php echo $email ?>">
                    </div>
                    <div class="form-group">
                        <label>Contact</label>
                        <input class="form-control" type="text" name="contact" class="form-control" value="<?php echo $contact ?>">
                    </div>
                    <div class="form-group">
                        <label>Permissions</label><br>
                        <select id="permissions" name="permissions" class="form-control">
                            <option value="user">User</option>
                            <option value="admin">Admin</option>
                        </select>
                    </div>
                    <input type="hidden" name="id" value="<?php echo $id ?>">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary" name="update">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </body>
</html>

