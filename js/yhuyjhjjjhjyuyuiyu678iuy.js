function psw_vis(psw, elements) {
    if (psw.type == "password") {
        psw.type = "text";
        elements.classList.remove("icon1");
        elements.classList.add("icon2");
    } else {
        psw.type = "password";
        elements.classList.remove("icon2");
        elements.classList.add("icon1");
    }
    psw.focus();
}

function empty_this(elements) {
    elements.value = "";
    elements.focus();
}

// function show_search(){
//     document.getElementById('top_search').style.width = "100%";
//     document.getElementById('top_search').style.display = "inline-block";
// }

function fscreen_img() {
    document.getElementById('fscreen_container').style.display = "block";
}

function search(search_str) {
    if (search_str.length == 0) {
        document.getElementById("search_res").innerHTML="";
        // document.getElementById("search_res").style.border="0px";
        return;
    }

    if (window.XMLHttpRequest) {
        xmlhttp = new XMLHttpRequest();
    } else {
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
    }

    xmlhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            if(this.responseText == ''){
                document.getElementById("search_res").innerHTML="";
                alert("No response received from server, your session has expired!");
            } else {
                // alert(this.responseText);
                document.getElementById("search_res").innerHTML=this.responseText;
                // document.getElementById("search_res").style.border="1px solid #A5ACB2";
            }
            // document.getElementById("search_res").innerHTML=this.responseText;
            // document.getElementById("search_res").style.border="1px solid #A5ACB2";
        }
    }
    xmlhttp.open("POST", "search.php", true);
    xmlhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xmlhttp.send("search=" + search_str);
}

function focus_search(event) {
    if (event.keyCode == 47 || event.keyCode == 92 || event.which == 47 || event.which == 92 || event.charCode == 47 || event.charCode == 92) {
    	event.preventDefault();
    	document.getElementById('top_search').focus();
    }
}
