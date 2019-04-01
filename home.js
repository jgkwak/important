/**
This function shows the "view events" section and hides the other sections.
**/
function viewEvent(){
    document.getElementById("view").style.display = "block";
    document.getElementById("create").style.display = "none";
    document.getElementById("edit").style.display = "none";
}

/**
This function shows the "create events" section and hides the other sections.
**/
function addEvent(){
    document.getElementById("view").style.display = "none";
    document.getElementById("create").style.display = "block";
    document.getElementById("edit").style.display = "none";
}

/**
This function shows the "remove events" section and hides the other sections.
**/
function editEvent(){
    document.getElementById("view").style.display = "none";
    document.getElementById("create").style.display = "none";
    document.getElementById("edit").style.display = "block";
}

/**
This function clears out the text input box in the "create events" section.
**/
function eventClear(){
	document.getElementById("event_title").value = "";
	document.getElementById("event_date").value = "";
	document.getElementById("event_time").value = "";
}

/**
This function clears out the text input box in the "delete events" section.
**/
function eraseClear(){
    document.getElementById("event_code").value = "";
}

