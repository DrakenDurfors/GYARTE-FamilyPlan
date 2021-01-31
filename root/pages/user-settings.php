<?php
require "../includes/navbar.php";
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="firstPage">

    <div class="userSelectWraper">
        <div class="container">
            <div class="userSelectDisplay" id="settings">
                <a href ="user-settings-new.php" class="profile-select profile-select1" id="newUserBtn">
                    New User
                </a>
                <a href="user-settings-change-path.php" class="profile-select profile-select1">
                    Edit Users
                </a>
                <a href="user-settings-account.php" class="profile-select profile-select1">
                    Account settings
                </a>
            </div>
        </div>


    </div>
</div>

<?php
require "../includes/footer.php"
?>