<?php
    session_start();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Family Life</title>

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/mainStyle.css">

</head>
<body>
    <div class="navbar">
    <ul class="navlist">
    <li class="navListItem"><a href="../pages/index.php">Home</a></li>
    <?php 
    // If the user is logged in then the calendar item will be displayed
    if(isset($_SESSION['userID'])){
    echo '<li class="navListItem"><a href="#">Calendar</a></li>';
    }
    ?>
    </ul>
    
    <div class="loginReg">
    <?php 
    // This is where you log in/out or sign up. naturly you dont want to login twice and only log out
    // when you are logged in. therefore we hide one or the other:
    if(isset($_SESSION['userID'])){
        echo  '<form action="../php-only/logout.po.php" class="loginForm" method="POST">
        <input type="submit" value="Logout" class="loginBtn" name="logout-submit">
        </form>';
    }
    else {
        echo '<form action="../php-only/login.po.php" class="loginForm" method="POST">
        <input type="text" name="mailuser" class="loginInputField" placeholder="Username/E-mail...">
        <input type="password" name="pwd" class="loginInputField" placeholder="Password...">
        <input type="submit" value="Login" class="loginBtn" name="login-submit">
        </form>
        <a href="registrera.php" class="regButt">Sign Up</a>';
    }
    ?>
    
    
    </div>
    </div>