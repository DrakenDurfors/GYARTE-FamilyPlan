<?php
require "../includes/navbar.php";
?>
<main class="container-fluid d-flex align-items-center justify-content-center h-75">
    <section class="rounded border border-dark p-5">
        <h1 class="text-center">Signup</h1>
        <p>
            <?php
            // This code checks if there have been an error (errors would have been given from the signup.po.php) and then displays an error-text.
            if (isset($_GET['error'])) {
                if ($_GET['error'] == "emptyfields") {
                    echo '<p class="alert alert-warning" role="alert">Make sure to fill in all fields!</p>';
                } else if ($_GET['error'] == "invalidmailuser") {
                    echo '<p class="alert alert-warning" role="alert">Invalid username and e-mail!</p>';
                } else if ($_GET['error'] == "invaliduser") {
                    echo '<p class="alert alert-warning" role="alert">Invalid username!</p>';
                } else if ($_GET['error'] == "invalidmail") {
                    echo '<p class="alert alert-warning" role="alert">Invalid e-mail!</p>';
                } else if ($_GET['error'] == "passcheck") {
                    echo '<p class="alert alert-warning" role="alert">Your passwords do not mach!</p>';
                } else if ($_GET['error'] == "usertaken") {
                    echo '<p class="alert alert-warning" role="alert">An account with this username already exists!</p>';
                }
            }
            // If the signup was successful then that will be shown with the code below:
            else if (isset($_GET['signup'])) {

                if ($_GET['signup'] == "success") {
                    echo '<p class="alert alert-success" role="alert"> Signup succesfull!';
                }
            }
            ?>
        </p>
        <!-- This is the basic html form for signup: -->
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
    </section>

</main>
<?php
require "../includes/footer.php"
?>