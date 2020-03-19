<!--<body>
        <main class="header">
            <h1>Members Login</h1>
            <p>For New members, please go to the<a href="/ICT1004-Project/register"> Sign Up page</a>.</p>
            <form action="/ICT1004-Project/login/process_login.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label><input class="form-control" type="username" id="email"name="username" maxlength="50"  placeholder="Enter Username">
                </div>
                <div class="form-group">
                    <label for="pwd">Password:</label><input class="form-control" type="password" name="pwd" required placeholder="Enter password">
                </div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Submit</button></div></form>
        </main>
    </body>-->
<!DOCTYPE html>
<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">

    </head>
    <body id="loginpage">

        <div class="login-box">
            <h1>Members Login</h1>
            <?php
            // session_start();
            if (!empty($_SESSION['error']) && $_SESSION['error'] == 1) {
                echo "<p style='color:red;'>" . "Incorrect email or password.Please try again." . "</p>";
            }
            if (isset($_SESSION["registersuccess"]) && $_SESSION["registersuccess"] == 1){
                echo "<p style='color:green;'>" . "Registration Successful!" . "</p>";
            }
          
            ?>
            <p>For New members, please go to the<a href="/ICT1004-Project/register"> Register page</a>.</p>
            <form action="/ICT1004-Project/login/process_login.php" method="post">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="text" placeholder="Username" required id="email" name="username">
                </div>

                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password"type="password" name="pwd" required placeholder="Enter password">
                </div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Login</button></div></form>
        </div>
    </body>
    <?php
    $_SESSION['error'] = 0;
    $_SESSION['registersuccess'] = 0;
    ?>
</html>
