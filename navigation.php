<!DOCTYPE html>
<?php
        session_start();
        if(isset($_SESSION['username'])){
        echo $_SESSION['username'];
        echo "<br/><a href='logout.php'>logout</a>";
        echo "<button class='btn btn-success'>Logout</button></form> ";
}
        ?>
<nav class="nav navheight">
        <div class="w-100">
            <div class="logo">
                <a href="#">Your Logo</a>
            </div>
            <div id="mainListDiv" class="main_list">
                <ul class="navlinks">
                    <li><a href="index.php">Home</a></li>
                    <li><a href="login/login.php">Login<span class="sr-only">(current)</span></a></li>
                    <li><a href="login/register.php">Register</a></li>
                    <li><a href="management.php">Management</a></li>
                    <li><a href="#">Log Out</a></li>

                </ul>
            </div>
            <span class="navTrigger">
                <i></i>
                <i></i>
                <i></i>
            </span>
        </div>
    </nav>


<!-- 
<nav role="navigation" class="navbar navbar-expand-lg navbar-dark bg-dark" style="height: 10%">
    
    <a class="navbar-brand" href="index.php">LOGO</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNavDropdown">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login/login.php">Login<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="login/register.php">Register</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="management.php">Manage</a>
            </li>
        </ul>
    </div>
</nav> -->

