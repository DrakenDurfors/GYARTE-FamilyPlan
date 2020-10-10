<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();

    
}

function runMyFunction() {
    echo 'I just ran a php function';
  }

  if (isset($_GET['settings'])) {
    runMyFunction();
  }

?>

<div class="container-fluid d-flex align-items-center justify-content-center h-75">
    <div class="bg-secondary rounded-lg border border-dark w-75 h-75 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row h-25 d-flex align-items-center justify-content-center">


                <?php
                require "../php-only/dbh.po.php";

                $sql = "SELECT * FROM people WHERE userID = $_SESSION[userID]";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    echo ("<div class='profile-select d-flex align-items-center justify-content-center'> $row[2] </div>");
                }

                ?>
            </div>
            <div class="row d-flex align-items-center justify-content-center">
                <a class="profile-select d-flex align-items-center justify-content-center" href="user-select.php?settings=open">
                settings
                </a>
            </div>
        </div>
    </div>
</div>

<?php
require "../includes/footer.php"
?>