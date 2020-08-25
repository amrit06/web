
var sidebarstate = 0;
function opencloseNav(){ 
    if (sidebarstate == 0){
        sidebarstate = 1;
        return openNav();
    }else{
        sidebarstate = 0;
        return closeNav();
    }
}


/*content to 250px */
function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("sidebarbtn").style.marginLeft = "250px";
} 

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
 function closeNav() {
    document.getElementById("sidebar").style.width = "0px";
    document.getElementById("sidebarbtn").style.marginLeft = "0px";
}  


//pic slider
var imagearray = new Array();
imagearray[0] = "./assets/pic1.jpg";
imagearray[1] = "./assets/pic2.jpg";
imagearray[2] = "./assets/pic3.jpeg";
imagearray[3] = "./assets/bg.jpg";
var index = 0;

function slideright(){
    if (index > 3){
        index = 0;
    }
    document.getElementById("mainpic").src = imagearray[index];
    document.getElementById("cardpic").src = imagearray[index];
    
    index = index + 1;
}


function slideleft(){
    if (index < 0 ){
        index = 3;
    }
    document.getElementById("mainpic").src = imagearray[index];
    document.getElementById("cardpic").src = imagearray[index];
    
    index = index - 1;
}