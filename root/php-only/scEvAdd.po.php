<?php
session_start();

if (isset($_POST['scEvAdd-submit'])) {
    require 'dbh.po.php';
    $eventD = $_POST['eventDate'];
    $startT = $_POST['eventStart'];
    $endT = $_POST['eventEnd'];
    if(isset($_POST['parentView'])){
        $parent = true;
    } else {
        $parent = false;
    }
    $title = mysqli_real_escape_string($conn, $_POST['title']);
    $descrip = mysqli_real_escape_string($conn, $_POST['content']);

    if (empty($eventD) || empty($startT) || empty($endT) || empty($title) || empty($descrip)) {
        // These headers send you back to the signup form with an error/success message
        header("Location: ../pages/mainPage.php?error=emptyfields&uId=" . $_POST['pID'] . " ");
        exit();
    } else {
        // And finally we put in the values into the database (saftly)
        $sql = "INSERT INTO events (eDate, eStart, eEnd, eTitle, eDes, pID, parentView) VALUES (?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/mainPage.php?error=sqlerror2&uId=" . $_POST['pID'] . " ");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sssssss", $eventD, $startT, $endT, $title, $descrip, $_POST['pID'], $parent);
            mysqli_stmt_execute($stmt);
            header("Location: ../pages/mainPage.php?book=success&uId=" . $_POST['pID'] . " ");
            exit();
        }
    }
    // ends the statement and connection, making sure the webbsite uses ass little as possible.
    mysqli_stmt_close($stmt);
    mysqli_close($conn);
} else {
    header("Location: ../pages/mainPage.php&uId=" . $_POST['pID'] . " ");
    exit();
}
