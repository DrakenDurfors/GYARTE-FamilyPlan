<?php
$server = "localhost";
$user = "root";
$pass = "";
$db = "GYARTE";

$conn = new mysqli($server, $user, $pass, $db);

if($conn->connect_error){
    die("Connection failed: " . $conn->connect_error);
}

$username = $POST['uname'];
$password = $POST['pword'];


$result = mysql_query("select * from login where uname = '$username' and pword = '$password'")
        or die("Failed " .mysql_error() );
?>