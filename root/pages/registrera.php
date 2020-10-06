<?php
    require "../includes/navbar.php";
?>

<main>
    <div class="container-fluid d-flex justify-content-center">
        <section>
            <h1>Signup</h1>
            <?php
            // This code checks if there have been an error (errors would have been given from the signup.po.php) ant then displays an error-text.
                if(isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p class="alert alert-warning" role="alert">Make sure to fill in all fields!</p>';
                    }
                    else if($_GET['error'] == "invalidmailuser") {
                        echo '<p class="alert alert-warning" role="alert">Invalid username and e-mail!</p>';
                    }
                    else if($_GET['error'] == "invaliduser") {
                        echo '<p class="alert alert-warning" role="alert">Invalid username!</p>';
                    }
                    else if($_GET['error'] == "invalidmail") {
                        echo '<p class="alert alert-warning" role="alert">Invalid e-mail!</p>';
                    }
                    else if($_GET['error'] == "passcheck") {
                        echo '<p class="alert alert-warning" role="alert">Your passwords do not mach!</p>';
                    }
                    else if($_GET['error'] == "usertaken") {
                        echo '<p class="alert alert-warning" role="alert">An account with this username already exists!</p>';
                    }
                }
                // If the signup was successful then that will be shown with the code below:
            else if(isset($_GET['signup'])){
            
                if($_GET['signup'] == "success") {
                echo '<p class="alert alert-success" role="alert"> Signup succesfull!';
            }
        }
            ?>
            <!-- This is the basic html form for signup: -->
            <form action="../php-only/signup.po.php" method="post">
                <input type="text" name="user" placeholder="Username...">
                <input type="text" name="mail" placeholder="E-mail...">
                <input type="password" name="pwd" placeholder="Password...">
                <input type="password" name="pwdrep" placeholder="Repeat password...">
                <button type="submit" name="signup-submit">Signup</button>
            </form>
        </section>
    </div>
</main>

<?php 
    require "../includes/footer.php"
?>