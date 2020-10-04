<?php

$servername = "localhost";
$dBUsername = "root";
$dBPassword = "";
$dBName = "gyarte";

$conn = mysqli_connect($servername, $dBUsername, $dBPassword, $dBName);

if(!$conn){
    die("Connection unsuccesfull: " .mysqli_connect_error());
}