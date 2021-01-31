<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="firstPage">
    <div class="userSelectWraper">
        <div>
            <h1>CHANGE!</h1>

            <ul class="settings-change">
                <?php
                require "../php-only/dbh.po.php";

                $sql = "SELECT * FROM people WHERE userID = $_SESSION[userID]";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    echo ("<a href='user-settings-change.php?user=$row[1]'><li> $row[2]</li> </a>");
                }

                ?>
            </ul>
        </div>
    </div>
</div>



<?php
require "../includes/footer.php"
?>