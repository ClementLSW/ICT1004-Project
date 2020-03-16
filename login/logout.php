<html lang="en">

    <head>
        <?php include '../header.inc.php'; ?>
    </head>

<body>
        <?php include "../navigation.php"; ?>
        <main class="container">
        <?php
        session_start();
        session_destroy();
            if(isset($_COOKIE["username"])and isset($_COOKIE["pwd"])){
                $username = $_COOKIE["username"];
                $password = $_COOKIE["pwd"];
                setcookie("username", $username, time()-1);
                setcookie("pwd", $password, time()-1);
            }
            echo "You have successfully logged out.";
            echo "<form action = '../index.php'>";
            echo "<button class='btn btn-success'>Return Home</button></form> "
        
        ?>
           
        </main>
        
    </body>

s





</html>