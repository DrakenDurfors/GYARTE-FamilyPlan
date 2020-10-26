<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="container-fluid d-flex align-items-center justify-content-center h-75">

    <div class="bg-secondary rounded-lg border border-dark w-25 h-75 d-flex align-items-center justify-content-center">

        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <form action="../php-only/NP.po.php" method="post">
                    <div class="form-group justify-content-center d-flex">
                        <input type="text" name="pName" placeholder="Name..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status">
                            <label class="custom-control-label" for="customSwitch1">Parent</label>
                        </div>
                    </div>
                    <p>Confirm with Parent Key:</p>
                    <div class="form-group justify-content-center d-flex">
                        <input type="password" name="plock" placeholder="Parrent Key..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <button type="submit" name="NP-submit">Create</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<?php
require "../includes/footer.php"
?>