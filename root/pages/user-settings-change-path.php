<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>
            <h1 class="d-flex align-item-center justify-content-center w-100">CHANGE!</h1>

<div class="container-fluid d-flex align-items-center justify-content-center h-75">

    <div class="bg-secondary rounded-lg border border-dark w-25 h-75 d-flex justify-content-center">

        <div class="container">
            <div class="row h-100 d-flex p-5">
                <ul>
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
</div>



<?php
require "../includes/footer.php"
?>