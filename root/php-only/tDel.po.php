<?php
session_start();

if (isset($_POST['tSubmit'])) {
    require 'dbh.po.php';
    $TID = $_POST['tID'];
    $sql = 'DELETE FROM tasks WHERE tID = ' . $TID . '';
    $query = mysqli_query($conn, $sql);
    header("Location: ../pages/mainPage.php?uId=" . $_POST['pID'] . " ");
    exit();

} else {
    header("Location: ../pages/mainPage.php?uId=" . $_POST['pID'] . " ");
    exit();
}
