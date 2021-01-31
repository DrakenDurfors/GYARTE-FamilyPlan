
// Schedule input script:
var scInput = document.getElementById("scheduleInput");
var c_addEvBtn = document.getElementById("console_addEvBtn");

if (c_addEvBtn != null) {
    c_addEvBtn.addEventListener("click", function () {
        scInput.style.display = "flex";
    })
}
if(scInput != null){
scInput.addEventListener("click", function (x) {
    if (x.target.nodeName == "SPAN") {
        scInput.style.display = "none"
    } else if (x.target == scInput) {
        scInput.style.display = "none"
    }
})
}


// Task input script

var taInput = document.getElementById("taskInput");
var c_addTaBtn = document.getElementById("console_addTaBtn");
if(c_addTaBtn != null){
c_addTaBtn.addEventListener("click", function () {
    taInput.style.display = "flex"
})
}
if(taInput != null){
taInput.addEventListener("click", function (x) {
    if (x.target.nodeName == "SPAN") {
        taInput.style.display = "none"
    } else if (x.target == taInput) {
        taInput.style.display = "none"
    }
})
}


// Schedule script --------
// Apparently only works if it's inside the php file
// most proboble reason:
// function readings across different files

// var table = document.getElementById("schedule");
//         for (i = 0; i <= 144; i++) {
//             var x = document.createElement("tr");
//             var y = document.createElement("td");
//             if (i % 6 == 0) {
//                 if (i / 6 >= 10) {
//                     y.innerText = (i / 6) + ":00";
//                 } else {
//                     y.innerText = "0" + (i / 6) + ":00";
//                 }
//                 y.classList.add("tdTime");
//                 y.rowSpan = "6";
//                 x.appendChild(y);
//             }
//             x.id = i;
//             table.appendChild(x);
//         }

//         function addEvent(eventArray) {
//             var startD = Math.round(new Date("2000/10/10 " + eventArray[3]).getTime() / 1000)
//             var startAll = Math.round(new Date("2000/10/10 00:00:00").getTime() / 1000)
//             var start = document.getElementById((parseInt(startD) - parseInt(startAll)) / 600)
//             var duration = Math.round(parseInt(eventArray[0]) / 10)
//             var event = document.createElement("td")
//             event.classList.add("pointer")

//             var title = document.createElement("h5")
//             title.innerText = eventArray[2]
//             var timeDisplay = document.createElement("p")
//             timeDisplay.innerText = (eventArray[3].substring(0, eventArray[3].length - 3) + " - " + eventArray[4].substring(0, eventArray[4].length - 3))

//             var modal = document.createElement("div")
//             modal.classList.add("eventBox")
//             modal.classList.add("unseen")
//             var modalContent = document.createElement("div")
//             modalContent.classList.add("eventBoxContent")
//             var close = document.createElement("span")
//             close.classList.add("close")
//             close.innerText = "X"
//             var modalTitle = document.createElement("h1")
//             modalTitle.innerText = eventArray[2]
//             var modalText = document.createElement("p")
//             modalText.innerText = eventArray[5]
//             var deleteForm = document.createElement("form")
//             deleteForm.method = "POST"
//             deleteForm.action = "../php-only/scEvDis.po.php"
//             var deleteBtn = document.createElement("input")
//             deleteBtn.value = "Delete"
//             deleteBtn.type = "submit"
//             deleteBtn.name = "delConfirm"
//             var delInfo1 = document.createElement("input")
//             delInfo1.type = "hidden"
//             delInfo1.name = "delID"
//             delInfo1.value = eventArray[1]
//             var delInfo2 = document.createElement("input")
//             delInfo2.type = "hidden"
//             delInfo2.name = "id"
//             delInfo2.value = "<?php echo $_GET['uId']; ?>"
//             deleteForm.appendChild(delInfo1)
//             deleteForm.appendChild(delInfo2)
//             deleteForm.appendChild(deleteBtn)

//             modalContent.appendChild(close)
//             modalContent.appendChild(modalTitle)
//             modalContent.innerHTML += "<hr>"
//             modalContent.appendChild(modalText)
//             modalContent.appendChild(deleteForm)
//             modal.appendChild(modalContent)

//             event.onclick = function() {
//                 modal.style.display = "block"
//             }
//             modal.addEventListener("click", function(x) {
//                 if (x.target.nodeName == "SPAN") {
//                     modal.style.display = "none"
//                 } else if (x.target == modal) {
//                     modal.style.display = "none"
//                 }
//             })
//             document.getElementById("body").appendChild(modal)

//             event.appendChild(title)
//             event.appendChild(timeDisplay)
//             event.rowSpan = duration;
//             event.classList.add("event");
//             start.appendChild(event);


//         }

//         function addSpace(timestart, since) {
//             var start = document.getElementById(timestart);
//             var duration = since;
//             event = document.createElement("td");
//             event.rowSpan = duration;
//             event.classList.add("empty");
//             start.appendChild(event);
//         }