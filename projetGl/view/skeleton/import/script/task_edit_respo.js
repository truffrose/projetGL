function changeTeskPrevious(selectedLi){
	var selectedTaskName = cleanString(selectedLi.innerHTML);
	var previousSelectedLi = document.getElementById("div_tasks_previous").getElementsByClassName("selected_li");

	for (var i = 0; i < previousSelectedLi.length; i++) {
		previousSelectedLi[i].className = "";
	}

	selectedLi.className = "selected_li";

	document.getElementById("href_task_previous").innerHTML = cleanTaskString(selectedLi.innerHTML);
	document.getElementById("task_previous_id").value = selectedLi.value;
}

function changeTeskMother(selectedLi){
	var selectedTaskName = cleanString(selectedLi.innerHTML);
	var previousSelectedLi = document.getElementById("div_tasks_mother").getElementsByClassName("selected_li");

	for (var i = 0; i < previousSelectedLi.length; i++) {
		previousSelectedLi[i].className = "";
	}

	selectedLi.className = "selected_li";

	document.getElementById("href_task_mother").innerHTML = cleanTaskString(selectedLi.innerHTML);
	document.getElementById("task_mother_id").value = selectedLi.value;
}

function cleanTaskString(string){
	var cleaned = string.slice(string.indexOf(";")+1,string.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	cleaned = cleaned.slice(cleaned.indexOf(";")+1,cleaned.length);
	return cleaned;
}

// A mettre sur le 'oninput' event
function searchTaskPrevious(nameOfList){
	var searchBox = document.getElementById("search_field_task_previous");
	var list = document.getElementById(nameOfList).getElementsByTagName("li");
	var searchValue = searchBox.value;

	for(var i=0; i < list.length; i++){
		if(searchValue != ""){
			if (cleanTaskString(list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			    list[i].style.display = "none";
			}
			else{
				list[i].style.display = "list-item";
			}
		}
		else{
			list[i].style.display = "list-item";
		}
	}
}

// A mettre sur le 'onblur' event
function resetFieldTaskPrevious(nameOfList){
	var searchBox = document.getElementById("search_field_task_previous").value = "Rechercher";

	var list = document.getElementById(nameOfList).getElementsByTagName("li");

	for(var i=0; i < list.length; i++){
		list[i].style.display = "list-item";
	}
}

// A mettre sur le 'onclick' event
function emptyFieldTaskPrevious(){
	var searchBox = document.getElementById("search_field_task_previous").value = "";
}

// A mettre sur le 'oninput' event
function searchTaskMother(nameOfList){
	var searchBox = document.getElementById("search_field_task_mother");
	var list = document.getElementById(nameOfList).getElementsByTagName("li");
	var searchValue = searchBox.value;

	for(var i=0; i < list.length; i++){
		if(searchValue != ""){
			if (cleanTaskString(list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
			    list[i].style.display = "none";
			}
			else{
				list[i].style.display = "list-item";
			}
		}
		else{
			list[i].style.display = "list-item";
		}
	}
}

// A mettre sur le 'onblur' event
function resetFieldTaskMother(nameOfList){
	var searchBox = document.getElementById("search_field_task_mother").value = "Rechercher";

	var list = document.getElementById(nameOfList).getElementsByTagName("li");

	for(var i=0; i < list.length; i++){
		list[i].style.display = "list-item";
	}
}

// A mettre sur le 'onclick' event
function emptyFieldTaskMother(){
	var searchBox = document.getElementById("search_field_task_mother").value = "";
}