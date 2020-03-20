

<body id="registerpage">
    <div class="register-box">
        <h1>Members Registration</h1>
        <p>For existing members, please go to the<a href="/ICT1004-Project/userlogin"> Login page</a>.</p>
        <form action="/ICT1004-Project/login/process_register.php" method="post">
            <?php
            // session_start();
            if (!empty($_SESSION['duplicateerror']) && $_SESSION['duplicateerror'] == 1) {
                echo "<p style='color:red;'>" . "Duplicate username.Please try again." . "</p>";
            }
            ?>

            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username" id="username" required name="username" maxlength="50" placeholder="Enter username">
            </div>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="fname" id="fname" required placeholder="First Name" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">
            </div>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="text" name="lname" id="lname" required placeholder="Last Name" pattern="^(?=.{1,40}$)[a-zA-Z]+(?:[-'\s][a-zA-Z]+)*$">
            </div>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="email" name="email" id="email" required placeholder="Email" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
            </div>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="tel" name="contact" id="contact" required placeholder="Contact number" pattern="[0-9]{3}[0-9]{2}[0-9]{3}">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pwd" required placeholder="Password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pwd_confirm" required placeholder="Confirm Password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
            </div>        
            <p id="terms"><label><input type="checkbox" required name="agree"> <a href="Park_now_tAc.pdf" target="_blank">I agree to terms and conditions.</a></label></p>              
            <div class="form-group"><button class="btn btn-primary" type="submit">Register</button></div></form>
    </div>
    <?php $_SESSION['duplicateerror'] = 0;
    ?>
</body>