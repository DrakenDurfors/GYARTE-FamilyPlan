<?php
if(isset($_POST['signup-submit'])) {
    // Checks if the database connects correctly:
    require 'dbh.po.php';
    // Gets the information from the form
    $username = $_POST['user'];
    $email = $_POST['mail'];
    $password = $_POST['pwd'];
    $passwordRepeat = $_POST['pwdrep'];

    if(empty($username) || empty($email) || empty($password) || empty($passwordRepeat)){
        header("Location: ../pages/registrera.php?error=emptyfields&user =".$username."&mail=".$email);
        exit();
    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL) && !preg_match("/^[a-öA-Ö0-9]*$/", $username)){
        header("Location: ../pages/registrera.php?error=invalidmailuser");
        exit();

    }
    else if(!filter_var($email, FILTER_VALIDATE_EMAIL)){
        header("Location: ../pages/registrera.php?error=invalidmail&user =".$username);
        exit();
    }
    else if(!preg_match("/^[a-öA-Ö0-9]*$/", $username)){
        header("Location: ../pages/registrera.php?error=invaliduser&mail =".$email);
        exit();
    }
    else if($password !== $passwordRepeat){
        header("Location: ../pages/registrera.php?error=passcheck&mail=".$email."&user=".$username);
        exit();
    } 
    else {
        $sql = "SELECT userID FROM users WHERE userID=?";
        $stmt = mysqli_stmt_init($conn);
        if(!mysqli_stmt_prepare($stmt, $sql)){
            header("Location: ../pages/registrera.php?error=sqlerror");
            exit();
        }
        else {
            mysqli_stmt_bind_param($stmt, "s", $username);
            mysqli_stmt_execute($stmt);
            mysqli_stmt_store_result($stmt);
            $resultCheck = mysqli_stmt_num_rows($stmt);
            if ($resultCheck > 0){
                header("Location: ../pages/registrera.php?error=usertaken&mail=".$email);
            exit();
            }
            else{
                $sql = "INSERT INTO users (username, userEmail, userPwd) VALUES (?, ?, ?)";
                $stmt = mysqli_stmt_init($conn);
                if(!mysqli_stmt_prepare($stmt, $sql)){
                    header("Location: ../pages/registrera.php?error=sqlerror");
                    exit();
                }
                else {
                    $hashedPwd = password_hash($password, PASSWORD_DEFAULT);



                    mysqli_stmt_bind_param($stmt, "sss", $username, $email, $hashedPwd);
                    mysqli_stmt_execute($stmt);
                    header("Location: ../pages/registrera.php?signup=success");
                    exit();
                }
            }
        }
    }
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
}
else{
    header("Location: ../pages/registrera.php");
    exit();
}