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

        <form action="../php-only/NP.po.php" method="post">
            <div class="form-group">
                <input type="text" name="pName" placeholder="Name..." autocomplete="off">
            </div>
            <div class="form-group">
                <div class="custom-control custom-switch">
                    <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status">
                    <label class="custom-control-label" for="customSwitch1">Parent</label>
                </div>
            </div>
            <p>Confirm with Parent Key:</p>
            <div class="form-group">
                <input type="password" name="plock" placeholder="Parrent Key..." autocomplete="off">
            </div>
            <div class="form-group">
                <button type="submit" name="NP-submit">Create</button>
            </div>

        </form>
    </div>
</div>



<?php
require "../includes/footer.php"
?>