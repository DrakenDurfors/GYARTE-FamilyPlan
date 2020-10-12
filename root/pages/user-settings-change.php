<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<div class="container-fluid d-flex align-items-center justify-content-center h-75">

    <div class="bg-secondary rounded-lg border border-dark w-75 h-75 d-flex align-items-center justify-content-center">

        <div class="container">
            <div class="row d-flex align-items-center justify-content-center">
                <form action="../php-only/signup.po.php" method="post">
                    <div class="form-group justify-content-center d-flex">
                        <input type="text" name="user" placeholder="Username..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <input type="text" name="mail" placeholder="E-mail..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <input type="password" name="pwd" placeholder="Password..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <input type="password" name="pwdrep" placeholder="Repeat password..." autocomplete="off">
                    </div>
                    <div class="form-group justify-content-center d-flex">
                        <button type="submit" name="signup-submit">Signup</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>



<?php
require "../includes/footer.php"
?>