<?php
require "../includes/navbar.php";
require "../php-only/dbh.po.php";

$sql = 'SELECT userID from people WHERE personID=' . $_GET["uId"] . ' LIMIT 1';
$query = mysqli_query($conn, $sql);

// Makes sure the user is in fact logged in and does not attempt to acces other accounts
if (!isset($_SESSION['userID']) || $_SESSION['userID'] != mysqli_fetch_array($query)[0]) {
    header("Location: ../pages/index.php");
    exit();
}
?>

<main id="body" class="firstPage mainPage">

    <section>
        <!-- The schedule table -->
        <table id="schedule">
            <tr>
                <th class="thDay">Tid</th>
                <th class="thDay">Mon</th>
                <th class="thDay">Tue</th>
                <th class="thDay">Wed</th>
                <th class="thDay">Thu</th>
                <th class="thDay">Fri</th>
                <th class="thDay">Sat</th>
                <th class="thDay">Sun</th>
            </tr>
        </table>
    </section>

    <section>
        <div class="mainRightConsole">
            <div class="console">
                <p id="console_addEvBtn" class="pointer">+ Add Event</p>
                <?php
                // This selects the status and id of the schedlue's owner
                $sql_P = 'SELECT userID, status FROM people WHERE personID = ' . $_GET["uId"] . ' LIMIT 1';
                $query_P = mysqli_query($conn, $sql_P);
                $result_P = mysqli_fetch_assoc($query_P);
                // Checks if the user status
                if ($result_P['status'] == 'adult') {
                ?>
                    <p id="console_addTaBtn" class="pointer">+ Add Task</p>
                    <!-- Displays a list of all the children events shared with parents -->
                    <h1>Child events:</h1>
                    <table class="eventTable">
                        <tr>
                            <th>Name</th>
                            <th>Day</th>
                            <th>Time</th>
                            <th>Event</th>
                        </tr>
                        <?php
                        // Selects all users on the account and cycles through all with the child tag
                        $sql_PID = 'SELECT personID, pName, status FROM people WHERE userID = ' . $result_P["userID"] . '';
                        $query_PID = mysqli_query($conn, $sql_PID);
                        while ($result_PID = mysqli_fetch_assoc($query_PID)) {
                            if ($result_PID['status'] == "child") {
                                // Selects the events shared with parents
                                $sql_PEV = 'SELECT * FROM events WHERE parentview = 1 AND pID = ' . $result_PID["personID"] . '';
                                $query_PEV = mysqli_query($conn, $sql_PEV);
                                while ($result_PEV = mysqli_fetch_assoc($query_PEV)) {
                                    // Displays the event
                                    $eDay =  $result_PEV["eDate"];
                                    switch($eDay){
                                        case 1:
                                            $eDayName = "Monday";
                                        break;
                                        case 2:
                                            $eDayName = "Tuesday";
                                        break;
                                        case 3:
                                            $eDayName = "Wednesday";
                                        break;
                                        case 4:
                                            $eDayName = "Thursday";
                                        break;
                                        case 5:
                                            $eDayName = "Friday";
                                        break;
                                        case 6:
                                            $eDayName = "Saturday";
                                        break;
                                        case 7:
                                            $eDayName = "Sunday";
                                        break;
                                        default:
                                    break;
                                    }
                                    echo '
                                <tr>
                                    <td>' . $result_PID["pName"] . '</td>
                                    <td>' . $eDayName . '</td>
                                    <td>' . substr($result_PEV['eStart'], 0, -3) . ' - ' . substr($result_PEV['eEnd'], 0, -3) . '</td>
                                    <td>' . $result_PEV['eTitle'] . '</td>
                                </tr>
                                
                                ';
                                }
                            }
                        }
                        ?>
                    </table>

                <?php
                } else {
                ?>
                    <!-- If the user is a child it will display the tasks given by the parents -->
                    <h1>Your tasks: </h1>
                    <Table class="eventTable">
                        <tr>
                            <th>Task Name</th>
                            <th>Task Desription</th>
                            <th> </th>
                        </tr>

                        <?php
                        // Selects all the users tasks
                        $sql_PTA = 'SELECT tName, tDes, tID FROM tasks WHERE pID = ' . $_GET["uId"] . '';
                        $query_PTA = mysqli_query($conn, $sql_PTA);
                        while ($result_PTA = mysqli_fetch_array($query_PTA)) {
                            echo '
                            <tr>
                                <td>' . $result_PTA[0] . '</td>
                                <td>' . $result_PTA[1] . '</td>
                                <td> <form action="../php-only/tDel.po.php" method="post">
                                <input type="hidden" name="tID" value="' . $result_PTA[2] . '">
                                <input type="hidden" name="pID" value="' . $_GET["uId"] . '">
                                <input type="submit" value="&#10003;" name="tSubmit">
                                </form> </td>
                            </tr>
                            ';
                        }
                        ?>
                    </Table>

                <?php
                }

                ?>

            </div>
        </div>
    </section>
    <script>
        // gets the schedule-table
        var table = document.getElementById("schedule");
        // this will create 144 rows for the table
        for (i = 0; i <= 288; i++) {
            // creates a row and a data element
            var x = document.createElement("tr");
            var y = document.createElement("td");
            // if the row number is perfectly diviseble by 6 it will put a data element with the time in it
            if (i % 12 == 0 && (i / 12) != 24) {
                // if the hour is earlier than 10 (only have a single digit) it will add a 0 before the digit.
                if (i / 12 >= 10) {
                    y.innerText = (i / 12) + ":00";
                } else {

                    y.innerText = "0" + (i / 12) + ":00";
                }
                // puts in the data element inside the row
                y.classList.add("tdTime");
                y.rowSpan = "12";
                x.appendChild(y);
            }
            // gives the row an id and inputs it into the table
            x.id = i;
            table.appendChild(x);
        }

        // This function creates the event, the information is passed via the eventArray from the sql code
        function addEvent(eventArray) {
            // Sets the start of the event
            var startD = Math.round(new Date("2000/10/10 " + eventArray[3]).getTime() / 1000)
            // Sets the start of the day
            var startAll = Math.round(new Date("2000/10/10 00:00:00").getTime() / 1000)
            // Sets the start of the event relative to the start of the day
            var start = document.getElementById((parseInt(startD) - parseInt(startAll)) / 300)
            // Sets the duration of the event
            var duration = Math.round(parseInt(eventArray[0]) / 5)
            // Creates the event in the form of a data element
            var event = document.createElement("td")
            // Gives the event the pointer-class making the cursor change on hover
            event.classList.add("pointer")

            // Creates a title and inputs the text from the array
            var title = document.createElement("h3")
            title.innerText = eventArray[2]
            // Creates the time-display paragraph and inputs that information from the array
            var timeDisplay = document.createElement("p")
            timeDisplay.innerText = (eventArray[3].substring(0, eventArray[3].length - 3) + " - " + eventArray[4].substring(0, eventArray[4].length - 3))

            // Creates the modal showing a detailed view of the event when clicked:
            // Creates a div covering the entire page:
            var modal = document.createElement("div")
            // Gives the div the proper classes:
            modal.classList.add("eventBox")
            modal.classList.add("unseen")
            // Creates a div for the cotent of the modal and assigns the classes:
            var modalContent = document.createElement("div")
            modalContent.classList.add("eventBoxContent")
            // Creates the close button
            var close = document.createElement("span")
            close.classList.add("close")
            close.innerText = "X"
            // Creates the title element and gives it the value from the array
            var modalTitle = document.createElement("h1")
            modalTitle.innerText = eventArray[2]
            // Creates the description element and gives it the value from the array
            var modalText = document.createElement("p")
            modalText.innerText = eventArray[5]
            // Creates a from for the delete button:
            var deleteForm = document.createElement("form")
            deleteForm.method = "POST"
            deleteForm.action = "../php-only/scEvDis.po.php"
            // Creates the delete button
            var deleteBtn = document.createElement("input")
            deleteBtn.value = "Delete"
            deleteBtn.type = "submit"
            deleteBtn.name = "delConfirm"
            deleteBtn.classList.add("delete")
            // Assigns a hidden input with the id of the event
            var delInfo1 = document.createElement("input")
            delInfo1.type = "hidden"
            delInfo1.name = "delID"
            delInfo1.value = eventArray[1]
            // Assigns a hidden input with the id of the user
            var delInfo2 = document.createElement("input")
            delInfo2.type = "hidden"
            delInfo2.name = "id"
            delInfo2.value = "<?php echo $_GET['uId']; ?>"
            // This inserts the elements into the modal
            deleteForm.appendChild(delInfo1)
            deleteForm.appendChild(delInfo2)
            deleteForm.appendChild(deleteBtn)

            modalContent.appendChild(close)
            modalContent.appendChild(modalTitle)
            modalContent.innerHTML += "<hr>"
            modalContent.appendChild(modalText)
            modalContent.appendChild(deleteForm)
            modal.appendChild(modalContent)

            // When an event is clicked it will display the modal for that event
            event.onclick = function() {
                modal.style.display = "block"
            }
            // When you click on the modal, it will check if you clicked on the close button or outside of the box and will then close the modal
            modal.addEventListener("click", function(x) {
                if (x.target.nodeName == "SPAN") {
                    modal.style.display = "none"
                } else if (x.target == modal) {
                    modal.style.display = "none"
                }
            })
            // inserts the modal into the page
            document.getElementById("body").appendChild(modal)
            // inserts the title and duration of the event
            event.appendChild(title)
            event.appendChild(timeDisplay)
            // Sets the amount of rows the event takes up
            event.rowSpan = duration;
            // gives the event it's class
            event.classList.add("event");
            // Inserts the event on the correct row
            start.appendChild(event);


        }
        // Adds the space between the events
        function addSpace(timestart, since) {
            var start = document.getElementById(timestart);
            var duration = since;
            event = document.createElement("td");
            event.rowSpan = duration;
            event.classList.add("empty");
            start.appendChild(event);
        }
        <?php
        // This for-loop cycles the events of each day
        for ($i = 1; $i <= 7; $i++) {
            // The sql-code that gets all the events of the day currently given by the for-loop above
            if ($result_P['status'] == 'adult') {
                $sql = "SELECT TIMESTAMPDIFF(MINUTE, eStart, eEnd) AS minutes, eID, eTitle, eStart, eEnd, eDes FROM events WHERE pID = " . $_GET['uId'] . " AND eDate = $i ORDER BY eStart ASC";
            } else {
                $sql = "SELECT TIMESTAMPDIFF(MINUTE, eStart, eEnd) AS minutes, eID, eTitle, eStart, eEnd, eDes FROM events WHERE pID = " . $_GET['uId'] . " AND eDate = $i ORDER BY eStart ASC";
            }
            $result = mysqli_query($conn, $sql);
            // Assigns the start of the day
            $lastDate = strtotime("00:00:00");
            // Cycles through all the events
            while ($row = mysqli_fetch_array($result)) {
                // Assigns all the timing values
                $time = strtotime($row[3]);
                $since = $time - $lastDate;
                $since = round($since / 300);
                $timestart = round(($lastDate - strtotime("00:00:00")) / 300);
                // Echoes the js functions into the script-tag with the array values
                echo "addSpace($timestart, $since);
                addEvent(" . json_encode($row) . ");";
                // Assigns the time of the end of the previous event
                $lastDate = strtotime($row[4]);
            }
            // This inserts the final empty-space of the day
            $time = strtotime("24:00:00");
            $since = $time - $lastDate;
            $since = round($since / 300);
            $timestart = round(($lastDate - strtotime("00:00:00")) / 300);
            echo "addSpace($timestart, $since);";
        }

        ?>
    </script>

</main>
<section class="schedlueForm" id="scheduleInput">
    <div class="schedlueFormDiv">
        <span class="close">X</span>
        <!-- This form creates a new event -->
        <form action="../php-only/scEvAdd.po.php" method="post">
            <input type="hidden" name="pID" value="<?php echo $_GET['uId']; ?>">
            <div class="form-group2">
                <select class="custom-select" name="eventDate" id="eventDate">
                    <option selected value="">Select day</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>
            </div>
            <div class="form-group2">
                <input type="time" name="eventStart" id="eventStart" step="300">
                <label for="eventStart">Starttime</label>
            </div>
            <div class="form-group2">
                <input type="time" name="eventEnd" id="eventEnd" step="300">
                <label for="eventEnd">Endtime</label>
            </div>
            <div class="form-group2">
                <input type="radio" name="parentView" id="parentView">
                <label for="parentview">Send to parents</label>
            </div>
            <div class="form-group2">
                <input type="text" name="title" id="title" placeholder="Title...">
            </div>
            <div class="form-group2">
                <textarea name="content" id="content" cols="30" rows="10" placeholder="Description..."></textarea>

            </div>
            <div class="form-group2">
                <input type="submit" value="Submit" name="scEvAdd-submit">
            </div>
        </form>
    </div>
</section>

<!-- --------------------- -->

<section class="schedlueForm" id="taskInput">
    <div class="schedlueFormDiv">
        <span class="close">X</span>
        <!-- This form creates a new task (only seen by adult accounts) -->
        <form action="../php-only/taskAdd.po.php" method="post">
            <div class="form-group2">
                <input type="text" name="Tname" placeholder="Task name..." autocomplete="off">
            </div>
            <div class="form-group2">
                <input type="text" name="Tdes" placeholder="Task description..." autocomplete="off">
            </div>
            <div class="form-group2">
                <select name="Tchild" id="">
                    <option value="" disabled>-- Select Child --</option>
                    <?php
                    $sql = 'SELECT pName, personID FROM people WHERE status = "child" AND userID = ' . $_SESSION['userID'] . '';
                    $query = mysqli_query($conn, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                        echo '
                    <option value="' . $row[1] . '">' . $row[0] . '</option>
                    ';
                    }
                    ?>
                </select>
            </div>
            <div class="form-group2">
                <input type="hidden" name="pID" value="<?php echo $_GET['uId']; ?>">
                <input type="submit" value="Assign Task" name="taSubmit">
            </div>

        </form>
    </div>
</section>


<?php
require "../includes/footer.php"
?>