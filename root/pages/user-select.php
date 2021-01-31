<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="mainContainer">

    <div class="userSelectWraper">

        <div>

            <div class="userSelectDisplay">


                <?php
                require "../php-only/dbh.po.php";

                $sql = "SELECT * FROM people WHERE userID = $_SESSION[userID]";
                $result = mysqli_query($conn, $sql);
                if (mysqli_num_rows($result) == 0) {
                    header("Location: ../pages/user-settings.php");
                    exit();
                }
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    if ($row[4] == "adult") {
                        echo ("<a href='../pages/mainPage.php?uId=$row[1]' class='profile-select profile-select1'> $row[2] </a>");
                    } else if ($row[4] == "child") {
                        echo ("<a href='../pages/mainPage.php?uId=$row[1]' class='profile-select profile-select2'> $row[2] </a>");
                    }
                }


                ?>
            </div>
        </div>
    </div>
</div>

<?php
require "../includes/footer.php"
?>