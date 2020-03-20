<html lang="en" dir="ltr">
    <head>
        <meta charset="utf-8">
    </head>
    <body>

        <div class="login-box">
            <h1 style="color:white;">Password Reset</h1>
            
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

    <style>


        body{
            margin: 0px;
            padding: 0;
            font-family: sans-serif;
            background-size: contain;
            background-color: black;

        }

        .login-box{
            width: 280px;
            position: absolute;
            top: 50%;
            left: 50%;
            bottom: -5px;
            transform: translate(-50%,-50%);

        }
        .loginsuccess{
            position: absolute;
            top: 50%;
            left: 50%;
        }
        .login-box h1{
            float: left;
            font-size: 40px;
            border-bottom: 6px solid #4caf50;
            margin-bottom: 50px;
            padding: 13px 0;
        }
        .textbox{
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid #4caf50;
        }
        .textbox i{
            width: 26px;
            float: left;
            text-align: center;
        }
        .textbox input{
            border: none;
            outline: none;
            background: none;
            color: white;
            font-size: 18px;
            width: 80%;
            float: left;
            margin: 0 10px;
        }
        .btn{
            width: 100%;
            background: none;
            border: 2px solid #4caf50;
            color: white;
            padding: 5px;
            font-size: 18px;
            cursor: pointer;
            margin: 12px 0;
        }
        p{
            font-size: 20px;
        }
        .register-box{

            width: 280px;
            position: absolute;
            top: 45%;
            left: 50%;
            bottom: -5px;
            transform: translate(-50%,-50%);

        }
        #terms{
            font-size: 20px;

        }
    </style>

</html>