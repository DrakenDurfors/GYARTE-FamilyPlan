<?php
// checks that the user pressed "login" and didnt access this page using any other means.
if (isset($_POST['login-submit'])) {
    require 'dbh.po.php';
    // Variables aquired from the login
    $mailuser = $_POST['mailuser'];
    $password = $_POST['pwd'];
    // checks if fields are empty
    if (empty($mailuser) || empty($password)) {
        header("Location: ../pages/index.php?error=emtyfields");
        exit();
    } else {
        // SQL - code I want to use
        $sql = "SELECT * FROM users WHERE username=? OR userEmail=?;";
        // A statement that handles the username and email
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/index.php?error=sqlerror");
            exit();
        } else {
            // sends in the username and email
            mysqli_stmt_bind_param($stmt, "ss", $mailuser, $mailuser);
            mysqli_stmt_execute($stmt);
            // gives back the correct row in the database
            $result = mysqli_stmt_get_result($stmt);
            // checks if there is a user
            if ($row = mysqli_fetch_assoc($result)) {
                // verifies password
                $pwdCheck = password_verify($password, $row['userPwd']);
                if ($pwdCheck == false) {
                    header("Location: ../pages/index.php?error=wrongpwd");
                    exit();
                } else if ($pwdCheck == true) {
                    // This code is used to later change things on the website depending on if you are logged in or not
                    session_start();
                    $_SESSION['userID'] = $row['userID'];
                    $_SESSION['username'] = $row['username'];
                    $_SESSION['Ppwd'] = $row['parentPwd'];
                    header("Location: ../pages/index.php?login=success");
                    exit();
                } else {
                    header("Location: ../pages/index.php?error=wrongpwd");
                    exit();
                }
            } else {
                header("Location: ../pages/index.php?error=nouser");
                exit();
            }
        }
    }
} else {
    header("Location: ../pages/index.php");
    exit();
}
