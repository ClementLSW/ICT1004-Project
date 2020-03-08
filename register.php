<head>
        <title>This is the title of the webpage!</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"></meta>
        <!-- External JS-->
        <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
        <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
        <script src="../resources/js/lib/userhome.js"></script>

        <!-- External Style Sheet -->
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous"></link>
        <link href="https://stackpath.bootstrapcdn.com/bootswatch/4.4.1/darkly/bootstrap.min.css" rel="stylesheet" integrity="sha384-rCA2D+D9QXuP2TomtQwd+uP50EHjpafN+wruul0sXZzX/Da7Txn4tB9aLMZV4DZm" crossorigin="anonymous">
        <link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
        
        <!-- Own Style Sheet -->
        <link rel="stylesheet" href="resources/css/main.css"></link>
       

    </head>
    <body>
        <?php include 'navigation.php';?>
<main class="container">
            <h1>Member Registration</h1>
            <p>For existing members, please go to the<a href="Login.php"> Sign In page</a>.</p>
            <form action="process_register.php" method="post">
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
