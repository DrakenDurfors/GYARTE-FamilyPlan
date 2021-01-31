<?php
require "../includes/navbar.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
require "../php-only/dbh.po.php";

?>

<div class="firstPage">

    <div class="userSelectWraper">

        <div class="container">
            
                <section class="accountSettings">
                    <?php
                    // This will get the user name and email and then display them
                    $sql = "SELECT userEmail, username FROM users WHERE userID = $_SESSION[userID] LIMIT 1";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    echo "<h2>Username:<br> " . $row['username'] . "</h2>";
                    echo "<h2>E-mail:<br> " . $row['userEmail'] . "</h2>";
                    echo '<hr> <br>';
                    // This part shows what the user wants to change based on the input given. 
                    if (!isset($_GET['s'])) {
                        // This is the selection menu of the things the user can change
                        echo '
        <a href="user-settings-account.php?s=u">Change Family name</a> <br>
        <a href="user-settings-account.php?s=m">Change E-mail</a> <br>
        <a href="user-settings-account.php?s=p">Change Password</a> <br>
        <a href="user-settings-account.php?s=pp">Change Parent Password</a> <br>
        <a href="user-settings-account.php?s=d" class="text-white bg-danger">Delete Account</a>
        ';
                    } else if ($_GET['s'] == 'u') {
                        // This is the form for changeing the username
                        echo '<form action="../php-only/account-change.po.php" method="POST">
            <div class="form-group2">
                <label for="username">Change Username:</label> <br>
                <input type="text" class="form-control" name="username" id="username" value="' . $row["username"] . '" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
                <label for="username">Confirm With Password:</label> <br>
                <input type="password" class="form-control" name="passconf" id="passconf" required>
            </div> <br>
            <div class="form-group2">
            <input type="submit" value="Confirm Change" name="CUSub" class="articleChangeBtn edit ">
            </div>
        </form> <br>
            <a href="user-settings-account.php">Back</a>
            ';
                    } else if ($_GET['s'] == 'm') {
                        // This is the code for changeing the email of the user
                        echo '<form action="../php-only/account-change.po.php" method="POST">
            <div class="form-group2">
                <label for="mail">Change E-mail:</label>  <br>
                <input type="text" class="form-control" name="mail" id="mail" value="' . $row["userEmail"] . '" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
                <label for="username">Confirm With Password:</label>  <br>
                <input type="password" class="form-control" name="passconf" id="passconf" required>
            </div> <br>
            <div class="form-group2">
            <input type="submit" value="Confirm Change" name="CMSub" class="articleChangeBtn edit ">
            </div>
            </form> <br>
            <a href="user-settings-account.php">Back</a>
            ';
                    } else if ($_GET['s'] == 'p') {
                        // This is the form for changeing the password
                        echo '<form action="../php-only/account-change.po.php" method="POST">
            <div class="form-group2">
                <label for="passconf">Old Password:</label>  <br>
                <input type="password" class="form-control" name="passconf" id="passconf" required>
            </div> <br>
            <div class="form-group2">
                <label for="pass1">New Password:</label>  <br>
                <input type="password" class="form-control" name="pass1" id="pass1" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
                <label for="pass2">Confirm New Password:</label>  <br>
                <input type="password" class="form-control" name="pass2" id="pass2" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
            <input type="submit" value="Confirm Change" name="CPSub" class="articleChangeBtn edit ">
            </div>
        </form>
            <a href="user-settings-account.php">Back</a>
            ';
                    } else if ($_GET['s'] == 'pp') {
                        // This is the form for changeing the parent password
                        echo '<form action="../php-only/account-change.po.php" method="POST">
            <div class="form-group2">
                <label for="passconf">Old Parent Password:</label>  <br>
                <input type="password" class="form-control" name="Ppassconf" id="passconf" required>
            </div> <br>
            <div class="form-group2">
                <label for="pass1">New Parent Password:</label>  <br>
                <input type="password" class="form-control" name="pass1" id="pass1" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
                <label for="pass2">Confirm New Parent Password:</label>  <br>
                <input type="password" class="form-control" name="pass2" id="pass2" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
                <label for="pass2">Confirm with Password:</label>  <br>
                <input type="password" class="form-control" name="passconf" id="pass3" required autocomplete="off">
            </div> <br>
            <div class="form-group2">
            <input type="submit" value="Confirm Change" name="CPPSub" class="articleChangeBtn edit ">
            </div>
        </form>
            <a href="user-settings-account.php">Back</a>
            ';
                    } else if ($_GET['s'] == 'd') {
                        // This is the form for deleting the account
                        echo '<form action="../php-only/account-change.po.php" method="POST">
            <div class="form-group2">
                <label for="passconf">Enter Password:</label>  <br>
                <input type="password" class="form-control" name="passconf" id="passconf" required>
            </div> <br>
            <div class="form-group2">
                <input type="radio" name="check" id="check" required>
                <label for="check">Are you sure?</label> 
                </div> <br>
                <div class="form-group2">
            <input type="submit" value="Confirm Delete" name="CDSub" class="articleChangeBtn delete ">
                </div>
        </form> <br>
            <a href="user-settings-account.php">Back</a>
            ';
                    }

                    ?>

                </section>
            </div>
        </div>
    </div>
</div>



<?php
require "../includes/footer.php"
?>