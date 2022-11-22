<?php
ob_start(); //turns on output buffering
session_start(); //store variables in a session

$timezone = date_default_timezone_get();

$con = mysqli_connect("localhost","root", "", "social_network");
if(mysqli_connect_errno()){
    echo "Failed to connect: " . mysqli_connect_errno();
}