<?php
session_start();
require "dbh.po.php";

if (!isset($_SESSION['userID']) || !isset($_POST['delConfirm'])) {
    header("Location: ../pages/index.php");
    exit();
}

$evID = $_POST['delID'];

$sql = 'DELETE FROM events WHERE eID = ' . $evID . '';
$query = mysqli_query($conn, $sql);

header("Location: ../pages/mainPage.php?uId=" . $_POST['id'] . "");
exit();
