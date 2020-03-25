<?php

//Resetting the session
session_start();
session_destroy();
header('location:/ICT1004-Project/home');
?>
