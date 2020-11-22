
var sidebarstate = 0;
function opencloseNav() {
    if (sidebarstate == 0) {
        sidebarstate = 1;
        return openNav();
    } else {
        sidebarstate = 0;
        return closeNav();
    }
}


/*content to 250px */
function openNav() {
    document.getElementById("sidebar").style.width = "250px";
    document.getElementById("sidebarbtn").style.marginLeft = "255px";
}

/* Set the width of the sidebar to 0 and the left margin of the page content to 0 */
function closeNav() {
    document.getElementById("sidebar").style.width = "0px";
    document.getElementById("sidebarbtn").style.marginLeft = "5px";
}


//pic slider
var imagearray = new Array();
imagearray[0] = "./assets/pic1.jpg";
imagearray[1] = "./assets/pic2.jpg";
imagearray[2] = "./assets/pic3.jpeg";

var slide_index = 0;
function slideright() {
    slide_index = slide_index + 1;
    if ( slide_index > 2){
        slide_index = 0;
    }
    document.getElementById("frame_big_pic").src = imagearray[slide_index];
    document.getElementById("frame_small_pic").src = imagearray[slide_index];
}


function slideleft() {
    slide_index = slide_index - 1;
    if ( slide_index < 0){
        slide_index = 2;
    }
    document.getElementById("frame_big_pic").src = imagearray[slide_index];
    document.getElementById("frame_small_pic").src = imagearray[slide_index];
}





var popup = document.getElementById("popup");
var span = document.getElementById("close");
var btn = document.getElementById("submit");



btn.onclick = function () {
    popup.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function () {
    popup.style.display = "none";
}

window.onclick = function (event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}



function switchpage(category, div) {
    var page = '';
    switch (category) {
        case 'womens':
            page = "../../html/pages/subpage/Women.php";
            break;
        case 'girls':
            page = "../../html/pages/subpage/Girls.php";
            break;
        case 'boys':
            page = "../../html/pages/subpage/Boys.php";
            break;
        case 'mens':
            page = "../../html/pages/subpage/Men.php";
            break;
        case 'all':
            page = "../../html/pages/subpage/Main.php";
            break; 
        default:
            page = "../../html/pages/subpage/Main.php";
            break;
    }

    $.get(page, function (response) {
        $(div).html(response);
    });

}


function changePage(category) {
    query = "?subpage=" + "mens";
    window.location.href = "../../html/pages/Shopping.php" + query;
}

function selectProduct(id){
    query = "?id=" + id;
    window.location.href = "../../html/pages/Productpage.php" + query;
}





