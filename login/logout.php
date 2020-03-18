<body>
        <main class="header">
        <?php
            session_destroy();

//            if(isset($_COOKIE["username"])and isset($_COOKIE["pwd"])){
//                $username = $_COOKIE["username"];
//                $password = $_COOKIE["pwd"];
//                setcookie("username", $username, time()-1);
//                setcookie("pwd", $password, time()-1);
//            }   
              header('location:/ICT1004-Project/home');
           
        ?>
           
        </main>
        
    </body>




