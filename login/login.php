<html lang="en">
    <head>
        <?php
        //turn off error reporting
        error_reporting(0);
        include $_SERVER['DOCUMENT_ROOT'] . "/ICT1004-Project/header.inc.php";        
        ?>
    </head>
    <body>
        <?php
        include $_SERVER['DOCUMENT_ROOT'] . "/ICT1004-Project/navigation.php";
        ?>
        <main class="container">
            <h1>Members Login</h1>
            <p>For New members, please go to the<a href="register.php"> Sign Up page</a>.</p>
            <form action="process_login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label><input class="form-control" type="username" id="email"name="username" maxlength="50"  placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label><input class="form-control" type="password" name="pwd" required placeholder="Enter password">
                </div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Submit</button></div></form>
        </main>

    </body>
</html>
