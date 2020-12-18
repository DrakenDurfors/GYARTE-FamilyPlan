<?php
require "../includes/navbar.php";
require "../php-only/dbh.po.php";
// Makes sure the user is in fact logged in
if (!isset($_SESSION['userID'])) {
    header("Location: ../pages/index.php");
    exit();
}
?>
<main id="body" class="container-fluid d-flex justify-content-around h-75">
    <section>
        <div id="scheduleInput">
            <form action="../php-only/scEvAdd.po.php" method="post">
            <input type="hidden" name="pID" value="<?php echo $_GET['uId']; ?>">
                <select class="custom-select" name="eventDate" id="eventDate">
                    <option selected>Select day</option>
                    <option value="1">Monday</option>
                    <option value="2">Tuesday</option>
                    <option value="3">Wednesday</option>
                    <option value="4">Thursday</option>
                    <option value="5">Friday</option>
                    <option value="6">Saturday</option>
                    <option value="7">Sunday</option>
                </select>  <br>
                <label for="eventStart">Starttime</label> <br>
                <input type="time" name="eventStart" id="eventStart"> <br>
                <label for="eventEnd">Endtime</label> <br>
                <input type="time" name="eventEnd" id="eventEnd"> <br>
                <label for="title">Title</label> <br>
                <input type="text" name="title" id="title"> <br>
                <label for="content">Description</label> <br>
                <textarea name="content" id="content" cols="30" rows="10"></textarea>
                 <br>
                <input type="submit" value="Submit" name="scEvAdd-submit">
            </form>
        </div>
    </section>
    <section>
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


    <script>
        var table = document.getElementById("schedule");
        for (i = 0; i <= 144; i++) {
            var x = document.createElement("tr");
            var y = document.createElement("td");
            if (i % 6 == 0) {
                if (i / 6 >= 10) {
                    y.innerText = (i / 6) + ":00";
                } else {
                    y.innerText = "0" + (i / 6) + ":00";
                }
                y.classList.add("tdTime");
                y.rowSpan = "6";
                x.appendChild(y);
            }
            x.id = i;
            table.appendChild(x);
        }

        function addEvent(eventArray) {
            var startD = Math.round(new Date("2000/10/10 " + eventArray[3]).getTime() / 1000)
            var startAll = Math.round(new Date("2000/10/10 00:00:00").getTime() / 1000)
            var start = document.getElementById((parseInt(startD) - parseInt(startAll)) / 600)
            var duration = Math.round(parseInt(eventArray[0]) / 10)
            var event = document.createElement("td")

            var title = document.createElement("h2")
            title.innerText = eventArray[2]
            var timeDisplay = document.createElement("p")
            timeDisplay.innerText = (eventArray[3].substring(0, eventArray[3].length - 3) + " - " + eventArray[4].substring(0, eventArray[4].length - 3))

            var modal = document.createElement("div")
            modal.classList.add("eventBox")
            modal.classList.add("unseen")
            var modalContent = document.createElement("div")
            modalContent.classList.add("eventBoxContent")
            var close = document.createElement("span")
            close.classList.add("close")
            close.innerText = "X"
            var modalTitle = document.createElement("h1")
            modalTitle.innerText = eventArray[2]
            var modalText = document.createElement("p")
            modalText.innerText = eventArray[5]

            modalContent.appendChild(close)
            modalContent.appendChild(modalTitle)
            modalContent.innerHTML += "<hr>"
            modalContent.appendChild(modalText)
            modal.appendChild(modalContent)

            event.onclick = function() {
                modal.style.display = "block"
            }
            modal.addEventListener("click", function(x) {
                if (x.target.nodeName == "SPAN") {
                    modal.style.display = "none"
                } else if (x.target == modal) {
                    modal.style.display = "none"
                }
            })
            document.getElementById("body").appendChild(modal)

            event.appendChild(title)
            event.appendChild(timeDisplay)
            event.rowSpan = duration;
            event.classList.add("event");
            start.appendChild(event);


        }

        function addSpace(timestart, since) {
            var start = document.getElementById(timestart);
            var duration = since;
            event = document.createElement("td");
            event.rowSpan = duration;
            event.classList.add("empty");
            start.appendChild(event);
        }
        <?php
        for ($i = 1; $i <= 7; $i++) {
            $sql = "SELECT TIMESTAMPDIFF(MINUTE, eStart, eEnd) AS minutes, eID, eTitle, eStart, eEnd, eDes FROM events WHERE pID = " . $_GET['uId'] . " AND eDate = $i ORDER BY eStart ASC";
            $result = mysqli_query($conn, $sql);
            $lastDate = strtotime("00:00:00");
            while ($row = mysqli_fetch_array($result)) {
                $time = strtotime($row[3]);
                $since = $time - $lastDate;
                $since = round($since / 600);
                $timestart = round(($lastDate - strtotime("00:00:00")) / 600);
                echo "addSpace($timestart, $since);
                addEvent(" . json_encode($row) . ");";
                $lastDate = strtotime($row[4]);
            }
            $time = strtotime("24:00:00");
            $since = $time - $lastDate;
            $since = round($since / 600);
            $timestart = round(($lastDate - strtotime("00:00:00")) / 600);
            echo "addSpace($timestart, $since);";
        }

        ?>
    </script>

    </TBody>

    </table>

    </div>
    </section>

</main>



<?php
require "../includes/footer.php"
?>