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
                <h1>CHANGE!</h1>
                <?php
                echo ("<form action='../php-only/CP.po.php?user=$_GET[user]' method='post'>");

                require "../php-only/dbh.po.php";

                $sql = "SELECT pName, status FROM people WHERE personID = $_GET[user]";
                $result = mysqli_query($conn, $sql);
                while ($row = mysqli_fetch_array($result, MYSQLI_NUM)) {
                    echo ('<div class="form-group justify-content-center d-flex">
                    <input type="text" name="pName" value=' . $row[0] . ' autocomplete="off">
                </div>
                <div class="form-group justify-content-center d-flex">
                    <div class="custom-control custom-switch">
                    ');
                    if ($row[1] == "adult") {
                        echo ('
                        <input type="checkbox" class="custom-control-input" id="customSwitch1" name="status" checked>
                        ');
                    } else {
                        echo ('<input type="checkbox" class="custom-control-input" id="customSwitch1" name="status">');
                    }
                    echo ('
                        <label class="custom-control-label" for="customSwitch1">Parent</label>
                    </div>
                </div>
                <p>Confirm with Parent Key:</p>
                <div class="form-group justify-content-center d-flex">
                    <input type="password" name="plock" placeholder="Parrent Key..." autocomplete="off">
                </div>
                <div class="form-group justify-content-center d-flex">
                    <button type="submit" name="CP-submit">Create</button>
                </div>
                    <hr>
                <div class="form-group justify-content-center d-flex">
                <button type="submit" name="CP-delete" class="bg-danger">DELETE</button>
            </div>'
            
            
            );
                }

                ?>


                </form>
            </div>
        </div>
    </div>
</div>



<?php
require "../includes/footer.php"
?>