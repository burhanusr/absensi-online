// Sidebar close and open
let sidebar = document.getElementById("sidebar");
let sidebarBtn = document.querySelector(".bx-menu");

// Keep sidebar close or open when change to another page
if(localStorage.getItem("side") === "closed") {
    sidebar.classList.add("close");
} else if (localStorage.getItem("side") === "opened"){
    console.log("local storage open");
    sidebar.classList.remove("close");
} 

// Close or Open Sidebar
sidebarBtn.addEventListener("click", ()=>{
    if(sidebar.classList.contains("close")) {
        sidebar.classList.remove("close")
        localStorage.setItem("side", "opened");
    } else {
        sidebar.classList.add("close");
        localStorage.setItem("side", "closed");
    } 
});

// Arrow dropdown menu in Sidebar
let arrow = document.querySelectorAll(".arrow");
for(var i = 0; i < arrow.length; i++) {
    arrow[i].addEventListener("click", (e)=>{
        let arrowParent = e.target.parentElement.parentElement;
        arrowParent.classList.toggle("showMenu");
    });
}

