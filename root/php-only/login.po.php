<?php

if(isset($_POST['login-submit'])) {
    require 'dbh.po.php';
    $mailuser = $_POST['mailuser'];
    $password = $_POST['pwd'];

    if(empty($mailuser) || empty($password)){
        header("Location: ../pages/index.php?error=emtyfields");
    exit();
    }
    else {
        $sql = "SELECT * FROM users WHERE username=? OR userEmail=?;";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/index.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "ss", $mailuser, $mailuser);
            mysqli_stmt_execute($stmt);
            $result = mysqli_stmt_get_result($stmt);
            if($row = mysqli_fetch_assoc($result)){
                $pwdCheck = password_verify($password, $row['userPwd']);
                if($pwdCheck == false){
                    header("Location: ../pages/index.php?error=wrongpwd");
                    exit();
                } 
                else if($pwdCheck == true){
                    session_start();
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['username'] = $row['username'];
                    header("Location: ../pages/index.php?login=success");
                    exit();
                }
                else{
                    header("Location: ../pages/index.php?error=wrongpwd");
                    exit();
                }
            }
            else {
                header("Location: ../pages/index.php?error=nouser");
                exit();
            }
        }
    }
}
else {
    header("Location: ../pages/index.php");
    exit();
}