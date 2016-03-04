function loadNbAlerts(){
	var nbAlerts = document.getElementsByClassName("alert_field").length;
	document.getElementById("nb_alerts").innerHTML = nbAlerts;
	nbAlerts = document.getElementsByClassName("task_alert_field").length;
	document.getElementById("nb_task_alerts").innerHTML = nbAlerts;
	nbAlerts = document.getElementsByClassName("project_alert_field").length;
	document.getElementById("nb_project_alerts").innerHTML = nbAlerts;
}

function hideShowAlerts(){
	var state = document.getElementById("alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
		document.getElementById("alert_state").value = "hidden";
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
		document.getElementById("alert_state").value = "showed";
	}
}

function hideShowTaskAlerts(){
	var state = document.getElementById("task_alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("task_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
		document.getElementById("task_alert_state").value = "hidden";
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("task_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
		document.getElementById("task_alert_state").value = "showed";
	}
}

function hideShowProjectAlerts(){
	var state = document.getElementById("project_alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("project_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
		document.getElementById("project_alert_state").value = "hidden";
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("project_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
		document.getElementById("project_alert_state").value = "showed";
	}
}

function cleanString(string){
	var cleaned = string.slice(string.indexOf(";")+1,string.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	return cleaned;
}

function updateNbAlerts(){
	var alerts = document.getElementsByClassName("alert_field");
	var nbAlerts = 0;
	for(var i=0; i < alerts.length; i++){
		if(alerts[i].style.display != "none"){
			nbAlerts++;
		}
	}
	document.getElementById("nb_alerts").innerHTML = nbAlerts;
	
	alerts = document.getElementsByClassName("task_alert_field");
	nbAlerts = 0;
	for(var i=0; i < alerts.length; i++){
		if(alerts[i].style.display != "none"){
			nbAlerts++;
		}
	}
	document.getElementById("nb_task_alerts").innerHTML = nbAlerts;
	
	alerts = document.getElementsByClassName("project_alert_field");
	nbAlerts = 0;
	for(var i=0; i < alerts.length; i++){
		if(alerts[i].style.display != "none"){
			nbAlerts++;
		}
	}
	document.getElementById("nb_project_alerts").innerHTML = nbAlerts;
}

// A mettre sur le 'oninput' event
function search(){
	var searchBox = document.getElementById("search_field");
	var alert_list = document.getElementsByClassName("alert_field");
	var task_alert_list = document.getElementsByClassName("task_alert_field");
	var project_alert_list = document.getElementsByClassName("project_alert_field");
	var searchValue = searchBox.value;

	for(var i=0; i < alert_list.length; i++){
		if(searchValue != ""){
			if (cleanString(alert_list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			    alert_list[i].style.display = "none";
			}
			else{
				alert_list[i].style.display = "list-item";
			}
		}
		else{
			resetField();
			document.getElementById("search_field").value = "";
		}
	}

	for(var i=0; i < task_alert_list.length; i++){
		if(searchValue != ""){
			if (cleanString(task_alert_list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			    task_alert_list[i].style.display = "none";
			}
			else{
				task_alert_list[i].style.display = "list-item";
			}
		}
		else{
			resetField();
			document.getElementById("search_field").value = "";
		}
	}

	for(var i=0; i < project_alert_list.length; i++){
		if(searchValue != ""){
			if (cleanString(project_alert_list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			    project_alert_list[i].style.display = "none";
			}
			else{
				project_alert_list[i].style.display = "list-item";
			}
		}
		else{
			resetField();
			document.getElementById("search_field").value = "";
		}
	}

	if(searchValue != ""){
		updateNbAlerts();
	}
	else{
		loadNbAlerts();
	}
}

// A mettre sur le 'onblur' event
function resetField(){
	var searchBox = document.getElementById("search_field").value = "Rechercher";

	var state = document.getElementById("alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
	}

	state = document.getElementById("task_alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("task_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("task_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
	}

	state = document.getElementById("project_alert_state").value;
	if(state ==  "showed"){
		var fields = document.getElementsByClassName("project_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "list-item";
		}
	}
	else if(state == "hidden"){
		var fields = document.getElementsByClassName("project_alert_field");
		for (var i = 0; i < fields.length; i++) {
			fields[i].style.display = "none";
		}
	}	

	loadNbAlerts();
}

// A mettre sur le 'onclick' event
function emptyField(){
	var searchBox = document.getElementById("search_field").value = "";
}

function deleteAlert(){
	if(confirm("Etes-vous sûr de supprimer cette alerte ?")){
		alert("Alerte supprimée !");
	}
	else{

	}
}