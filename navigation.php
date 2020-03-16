<nav class="nav navheight">
    <div class="w-100">
        <div class="logo">
            <a href="/ICT1004-Project/home">Your Logo</a>
        </div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                 <li><a href='/ICT1004-Project/home'>Home</a></li>
                <?php
                session_start();
                if (isset($_SESSION['username'])) {
                    echo '<li><a>'. $_SESSION['username'] . '</a></li>';
                    echo "<li><a href='login/logout.php'>Logout</a></li>";
                   if ($_SESSION["permissions"] == 'admin'){
                       echo "<li><a href='management.php'>Management</a></li>";
                   }
                }else{
                    //ECHO 
                      echo "<li><a href='/ICT1004-Project/userlogin'>Login<span class='sr-only'>(current)</span></a></li>";
                      echo "<li><a href='/ICT1004-Project/register'>Register</a></li>";
                }
                ?>
            </ul>
        </div>
        <span class="navTrigger">
            <i></i>
            <i></i>
            <i></i>
        </span>
    </div>
</nav>
<div style="height:80px;"></div>



