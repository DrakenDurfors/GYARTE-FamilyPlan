
// Schedule input script:
var scInput = document.getElementById("scheduleInput");
var c_addEvBtn = document.getElementById("console_addEvBtn");

c_addEvBtn.addEventListener("click", function(){
    scInput.style.display = "flex"
})

scInput.addEventListener("click", function(x) {
    if (x.target.nodeName == "SPAN") {
        scInput.style.display = "none"
    } else if (x.target == scInput) {
        scInput.style.display = "none"
    }
})