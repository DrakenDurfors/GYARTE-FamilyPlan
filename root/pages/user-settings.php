<?php
require "../includes/navbar.php";
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="container-fluid d-flex align-items-center justify-content-center h-75">

    <div class="bg-secondary rounded-lg border border-dark w-50 h-75 d-flex align-items-center justify-content-center">
        <div class="container">
            <div class="row d-flex align-items-center justify-content-center" id="settings">
                <a href ="user-settings-new.php" class="profile-select d-flex align-items-center justify-content-center" id="newUserBtn">
                    New User
                </a>
                <a href="user-settings-change-path.php" class="profile-select d-flex align-items-center justify-content-center">
                    Edit Users
                </a>
                <a href="user-settings-account.php" class="profile-select d-flex align-items-center justify-content-center">
                    Account settings
                </a>
            </div>
        </div>


    </div>
</div>

<?php
require "../includes/footer.php"
?>