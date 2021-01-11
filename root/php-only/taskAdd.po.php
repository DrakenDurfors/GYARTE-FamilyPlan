<?php
session_start();

if (isset($_POST['taSubmit'])) {
    require 'dbh.po.php';
    $TID = $_POST['Tchild'];
    $Tname = mysqli_real_escape_string($conn, $_POST['Tname']);
    $Tdes = mysqli_real_escape_string($conn, $_POST['Tdes']);

    if (empty($TID) || empty($Tname) || empty($Tdes)) {
        // These headers send you back to the signup form with an error/success message
        header("Location: ../pages/mainPage.php?error=emptyfields&uId=" . $_POST['pID'] . " ");
        exit();
    } else {
        // And finally we put in the values into the database (saftly)
        $sql = "INSERT INTO tasks (pID, tName, tDes) VALUES (?, ?, ?)";
        $stmt = mysqli_stmt_init($conn);
        if (!mysqli_stmt_prepare($stmt, $sql)) {
            header("Location: ../pages/mainPage.php?error=sqlerror2&uId=" . $_POST['pID'] . " ");
            exit();
        } else {
            mysqli_stmt_bind_param($stmt, "sss", $TID, $Tname, $Tdes);
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
