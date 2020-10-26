<?php
session_start();

if (isset($_POST['CP-submit'])) {
    // Checks if the database connects correctly:
    require 'dbh.po.php';
    // Gets the information from the form
    $pName = $_POST['pName'];
    $pStat = $_POST['status'];
    $pId = $_GET['user'];
    $pass = $_POST['plock'];

    if (empty($pName) || empty($pass)) {
        header("Location: ../pages/user-settings-change.php?error=emptyfields&user=$pId");
        exit();
    } else if ($pass == $_SESSION["Ppwd"]) {
        $sql = "UPDATE people SET pName=?, status=? WHERE personID = $pId";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/user-settings-change.php?error=sqlerror&user=$pId");
            exit();
        } else {
            // This hashes the password before sending it into the database so that a hacker cant see all the passwords.
            if (isset($pStat)) {
                $parent = "adult";
                mysqli_stmt_bind_param($stmt, "ss", $pName, $parent);
                mysqli_stmt_execute($stmt);
            } else {
                $child = "child";
                mysqli_stmt_bind_param($stmt, "ss", $pName, $child);
                mysqli_stmt_execute($stmt);
            }
            header("Location: ../pages/user-select.php?change=success");
            exit();
        }
    }
} else if (isset($_POST['CP-delete'])) {
    // Checks if the database connects correctly:
    require 'dbh.po.php';
    // Gets the information from the form
    $pId = $_GET['user'];
    $pass = $_POST['plock'];
    if (empty($pass)) {
        header("Location: ../pages/user-settings-change.php?error=emptyfields&user=$pId");
        exit();
    } else if ($pass == $_SESSION["Ppwd"]) {
        $sql = "DELETE FROM people WHERE personID = $pId";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/user-settings-change.php?error=sqlerror&user=$pId");
            exit();
        } else {
            mysqli_stmt_execute($stmt);
            header("Location: ../pages/user-select.php?delete=success");
            exit();
        }
    }
} else {
    header("Location: ../pages/user-settings-change.php");
    exit();
}
