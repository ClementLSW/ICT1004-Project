<nav id="navBar" style="display:none" class="nav navheight">
    <div class="w-100">
        <div class="logo">
            <a class ="navbar-brand" href="/ICT1004-Project/home" ><img id="logo" alt="logo" style="max-height: 60px; max-width: 60px" src="resources/img/android-chrome-192x192.png"></a>
        </div>
        <div id="mainListDiv" class="main_list">
            <ul class="navlinks">
                <li><a href='/ICT1004-Project/home'>Home</a></li>
                <?php
                if (isset($_SESSION['username'])) {
                    if ($_SESSION["permissions"] == 'admin') {
                        echo '<li><a>' . $_SESSION['username'] . '</a></li>';
                        if ($_SERVER['REQUEST_URI'] == "/ICT1004-Project/manage") {
                            echo "<li><a href='occupancy'>occupancy</a></li>";
                        } else { 
                            echo "<li><a href='manage'>manage</a></li>";
                        }
                        echo "<li><a href='/ICT1004-Project/login/logout.php' aria-label='Log Out'><i class='fas fa-sign-out-alt'></i></a></li>";
                    } else {
                        echo "<li><a href='/ICT1004-Project/history'>History</a></li>";
                        echo "<li><a>" . $_SESSION['username'] . "</a></li>";
                        echo "<li><a href='/ICT1004-Project/login/logout.php' aria-label='Log Out'><i class='fas fa-sign-out-alt'></i></a></li>";
                    }
                } else {
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
<!-- <div style="height:80px;"></div> -->


<script>
    $(document).ready(function () {
        $("#navBar").show();
    })
    $(window).scroll(function () {
        if ($(document).scrollTop() > 10) {
            console.log("OK");
            $('.nav').addClass('affix');
        } else {
            $('.nav').removeClass('affix');
        }
    });


</script>
