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
    <link rel="stylesheet" href="../css/mainStyle.css">
</head>
<body>
    <div class="navbar">
    <ul class="navlist">
    <li class="navListItem"><a href="../pages/index.php">Home</a></li>
    <?php 
    if(isset($_SESSION['userID'])){
    echo '<li class="navListItem"><a href="#">Calendar</a></li>';
    }
    ?>
    </ul>

    <div class="loginReg">
    <?php 
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