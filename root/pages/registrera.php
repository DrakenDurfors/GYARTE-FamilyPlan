<?php
    require "../includes/navbar.php";
?>

<main>
    <div class="wrapper-main">
        <section class="section-default">
            <h1>Signup</h1>
            <?php
                if(isset($_GET['error'])){
                    if ($_GET['error'] == "emptyfields") {
                        echo '<p>Make sure to fill in all fields!</p>';
                    }
                    else if($_GET['error'] == "invalidmailuser") {
                        echo '<p>Invalid username and e-mail!</p>';
                    }
                    else if($_GET['error'] == "invaliduser") {
                        echo '<p>Invalid username!</p>';
                    }
                    else if($_GET['error'] == "invalidmail") {
                        echo '<p>Invalid e-mail!</p>';
                    }
                    else if($_GET['error'] == "passcheck") {
                        echo '<p>Your passwords do not mach!</p>';
                    }
                    else if($_GET['error'] == "usertaken") {
                        echo '<p>An account with this username allready exists!</p>';
                    }
                }
            else if(isset($_GET['signup'])){
            
                if($_GET['signup'] == "success") {
                echo '<p> Signup succesfull!';
            }
        }
            ?>
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