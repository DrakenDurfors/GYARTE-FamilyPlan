<?php
session_start();

if (isset($_POST['NP-submit'])) {
    // Checks if the database connects correctly:
    require 'dbh.po.php';
    // Gets the information from the form
    $pName = $_POST['pName'];
    $pStat = $_POST['status'];
    $uId = $_SESSION['userID'];

        if(empty($pName)){
            header("Location: ../pages/user-settings-new.php?error=emptyfields");
            exit();
        } else {
            $sql = "INSERT INTO people (userID, pName, status) VALUES (?, ?, ?)";
            $stmt = mysqli_stmt_init($conn);
            if (!mysqli_stmt_prepare($stmt, $sql)) {
                header("Location: ../pages/user-settings-new.php?error=sqlerror");
                exit();
            } else {
                // This hashes the password before sending it into the database so that a hacker cant see all the passwords.
                if(isset($pStat)){
                    $parent = "adult";
                mysqli_stmt_bind_param($stmt, "sss", $uId, $pName, $parent);
                mysqli_stmt_execute($stmt);
                } else {
                    $child = "child";
                    mysqli_stmt_bind_param($stmt, "sss", $uId, $pName, $child);
                    mysqli_stmt_execute($stmt);
                }
                header("Location: ../pages/user-select.php?create=success");
                exit();
            }
        }

} else {
    header("Location: ../pages/user-settings-new.php");
    exit();
}