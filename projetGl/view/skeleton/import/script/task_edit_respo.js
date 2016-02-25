function changeTeskPrevious(selectedLi){
	var selectedTaskName = cleanString(selectedLi.innerHTML);
	var previousSelectedLi = document.getElementById("div_tasks_previous").getElementsByClassName("selected_li");

	for (var i = 0; i < previousSelectedLi.length; i++) {
		previousSelectedLi[i].className = "";
	}

	selectedLi.className = "selected_li";

	document.getElementById("href_task_previous").innerHTML = cleanString(selectedLi.innerHTML);
}

function changeTeskMother(selectedLi){
	var selectedTaskName = cleanString(selectedLi.innerHTML);
	var previousSelectedLi = document.getElementById("div_tasks_mother").getElementsByClassName("selected_li");

	for (var i = 0; i < previousSelectedLi.length; i++) {
		previousSelectedLi[i].className = "";
	}

	selectedLi.className = "selected_li";

	document.getElementById("href_task_mother").innerHTML = cleanString(selectedLi.innerHTML);
}

function cleanString(string){
	var cleaned = string.slice(string.indexOf(";")+1,string.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	return cleaned;
}