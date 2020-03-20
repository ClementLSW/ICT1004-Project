<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <div class="login-box">
            <h1>Password Reset</h1>
            <?php
            session_start();
             if (isset($_SESSION["nomatchpass"]) && $_SESSION["nomatchpass"] == 1) {
                echo "<p style='color:red;'>" . "Passwords do not match.Please try again." . "</p>";
            }
            ?>


            <form action="/ICT1004-Project/login/process_reset.php" method="post">
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="New password" required name="pwd">
                </div>
                <div class="textbox">
                    <i class="fas fa-lock"></i>
                    <input type="password" placeholder="Confirm password" required name="cmfpassword">
                </div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Reset</button></div></form>
            <div>
            </div>
        </div>
    </body>
    <?php
$_SESSION['nomatchpass'] = 0;
?>
</html>