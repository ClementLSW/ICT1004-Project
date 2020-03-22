

<body id="registerpage">
    <div class="register-box">
          <div class ="card">
        <h1>Members Registration</h1>
        <p>For existing members, please go to the<a href="/ICT1004-Project/userlogin"style="color:#00b8e6"> Login page</a></p>
        <form action="/ICT1004-Project/login/process_register.php" method="post">
            <?php
            session_start();
            if (!empty($_SESSION['duplicateerror']) && $_SESSION['duplicateerror'] == 1) {
                echo "<p style='color:red;'>" . "Duplicate username.Please try again." . "</p>";
            }
             if (!empty($_SESSION['duplicateemail']) && $_SESSION['duplicateemail'] == 1) {
                echo "<p style='color:red;'>" . "Duplicate Email.Please try again." . "</p>";
            }
            ?>
            
            <div class="textbox">
               
                <i class="fas fa-user"></i>
                <input type="text" placeholder="Username (required)" id="username" required name="username" maxlength="50">
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
                <input type="email" name="email" id="email" required placeholder="Email (required)" pattern="^([a-zA-Z0-9_\-\.]+)@([a-zA-Z0-9_\-\.]+)\.([a-zA-Z]{2,5})$">
            </div>
            <div class="textbox">
                <i class="fas fa-user"></i>
                <input type="tel" name="contact" id="contact" required placeholder="Contact number" pattern="[0-9]{3}[0-9]{2}[0-9]{3}">
            </div>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pwd" required placeholder="Password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
            </div>
             <p class ="smalltext" style ="font-size:12px" >Min.8 Characters, alplanumeric, at least one upper case and lower case character and one special character</p>
            <div class="textbox">
                <i class="fas fa-lock"></i>
                <input type="password" name="pwd_confirm" required placeholder="Confirm Password" pattern="^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$%^&*-]).{8,}$">
            </div>        
            <p id="terms"><label><input type="checkbox" required name="agree"> <a href="Park_now_tAc.pdf" target="_blank" style="color: #00b8e6">I agree to terms and conditions.</a></label></p>              
            <div class="form-group"><button class="btn btn-primary" type="submit">Register</button></div></form>
    </div>
    </div>
    <?php $_SESSION['duplicateerror'] = 0;
          $_SESSION['duplicateemail'] = 0;
    ?>
    <style>
        .btn-primary{
            background-color:#00b8e6 !important;
            border: 2px solid #00b8e6 !important;
        }
        
        
        </style>
</body>
