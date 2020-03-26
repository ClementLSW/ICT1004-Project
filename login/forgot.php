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
        
        <title>Forgot Password</title>
    <style>


        body{
            margin: 0px;
            padding: 0;
            font-family: sans-serif;
            background-size: contain;
            background-color: black;

        }
        .btn-primary{
            background-color: #33ccff !important;
            border: 2px solid  #03fcec !important;
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
            border-bottom: 6px solid #03fcec;
            margin-bottom: 50px;
            padding: 13px 0;
        }
        .textbox{
            width: 100%;
            overflow: hidden;
            font-size: 20px;
            padding: 8px 0;
            margin: 8px 0;
            border-bottom: 1px solid #03fcec;
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
            border: 2px solid #03fcec;
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
    </head>
    <body>
     

        <div class="login-box">
            <h1 style="color:white;">Password Recovery</h1>
            <p style="color:white;"> To recover your password, enter your email associated with the account</p>
            <form action="/ICT1004-Project/login/process_forgot.php" method="post">
                <div class="textbox">
                    <i class="fas fa-user"></i>
                    <input type="email" placeholder="Enter Email" required id="email" name="email">
                </div>
                <div class="form-group"><button class="btn btn-primary" name="submit_email" type="submit">Recover</button></div></form>
            <div>
            </div>
        </div>
    </body>
</html>
