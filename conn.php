<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if(!isset($_SESSION)) session_start(); //Starts a session to pass your session variables

if($_SERVER["SERVER_NAME"] == "dev.billiemckenzie.ca") {
    //production - connects to PLESK database
    $conn = mysqli_connect("localhost", "design_net_user", "z7f*iK97", "designers_network");
} else {
    //development/local - connects to MAMP database
    $conn = mysqli_connect("localhost", "root", "root", "designers_network");
}

if(mysqli_connect_errno($conn) ) {
    echo "failed to connect to MySQL:" . mysqli_connect_error();
}

?>


