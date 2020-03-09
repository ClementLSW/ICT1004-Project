<head>
        <?php include 'header.inc.php'; ?>
    </head>
    <body>
        <?php include 'navigation.php';?>
<main class="container">
            <h1>Member Registration</h1>
            <p>For existing members, please go to the<a href="Login.php"> Sign In page</a>.</p>
            <form action="process_register.php" method="post">
                <div class="form-group">
                    <label for="username">Username:</label><input class="form-control" type="text" id="username"name="username" maxlength="50" placeholder="Enter username">
                </div>
                <div class="form-group">
                    <label for="fname">First Name:</label><input class="form-control" type="text" id="fname"name="fname" maxlength="50"  pattern=^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$ placeholder="Enter first name">
                </div>
                <div class="form-group">
                    <label for="lname">Last Name:</label><input class="form-control" type="text" id="lname"name="lname" required maxlength="50" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$" placeholder="Enter last name">
                </div>
                <div class="form-group">
                    <label for="email">Email:</label><input class="form-control" type="email" id="email"name="email"required placeholder="Enter email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
                </div>
                <div class="form-group">
                    <label for="Contact">Contact:</label><input class="form-control" type="tel" id="contact"name="contact"required placeholder="Enter contact number" pattern="[0-9]{3}-[0-9]{2}-[0-9]{3}">
                </div>
                <div class="form-group"><label for="pwd">Password:</label><input class="form-control" type="password" name="pwd" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required placeholder="Enter password">
                </div>
                <div class="form-group"><label for="pwd_confirm">Confirm Password:</label><input class="form-control" type="password" pwd_confirm" name="pwd_confirm" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$" required placeholder="Confirm password">
                </div>
                <div class="form-check"><label><input type="checkbox" required name="agree">Agree to terms and conditions.</label>
                </div>
                <div class="form-group"><button class="btn btn-primary" type="submit">Submit</button></div></form>
        </main>
    </body>
