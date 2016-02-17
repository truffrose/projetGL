function changeTable(){
	var selectMode = document.getElementById("filter_three_select").options[document.getElementById("filter_three_select").selectedIndex].value;

	if(selectMode == "Tâches"){
		document.getElementById("task_table").style.display = "table";
		document.getElementById("project_table").style.display = "none";
	}
	else if(selectMode == "Projets"){
		document.getElementById("project_table").style.display = "table";
		document.getElementById("task_table").style.display = "none";
	}

	var currentPage = parseInt(document.getElementById("btn_actual").value);
	var toHideElements = document.getElementsByClassName("tr_"+currentPage);
	for (var i = 0; i < toHideElements.length; i++) {
	    toHideElements[i].style.display = "none";
	}
	currentPage = 1;
	document.getElementById("btn_actual").value = currentPage;
	var toShowElements = document.getElementsByClassName("tr_"+currentPage);
	for (var i = 0; i < toShowElements.length; i++) {
	    toShowElements[i].style.display = "table-row";
	}
}

function getNbElements(){
	var selectMode = document.getElementById("filter_three_select").options[document.getElementById("filter_three_select").selectedIndex].value;

	if(selectMode == "Tâches"){
		return parseInt(document.getElementById("task_table").rows.length);
	}
	else if(selectMode == "Projets"){
		return parseInt(document.getElementById("project_table").rows.length);
	}
}

function previous(){
	var currentPage = parseInt(document.getElementById("btn_actual").value);
	var oldPage = parseInt(currentPage);
	var nbElement = getNbElements();
	var nbPage = Math.ceil(nbElement/6);

	if(currentPage > 1){
		currentPage = currentPage - 1;
		document.getElementById("btn_actual").value = currentPage;
		
		var toHideElements = document.getElementsByClassName("tr_"+oldPage);
		for (var i = 0; i < toHideElements.length; i++) {
		    toHideElements[i].style.display = "none";
		}

		var toShowElements = document.getElementsByClassName("tr_"+currentPage);
		for (var i = 0; i < toShowElements.length; i++) {
		    toShowElements[i].style.display = "table-row";
		}
	}
}

function next(){
	var currentPage = parseInt(document.getElementById("btn_actual").value);
	var oldPage = parseInt(currentPage);
	var nbElement = getNbElements();
	var nbPage = Math.ceil(nbElement/6);

	if(currentPage < nbPage){
		currentPage = currentPage + 1;
		document.getElementById("btn_actual").value = currentPage;
		
		var toHideElements = document.getElementsByClassName("tr_"+oldPage);
		for (var i = 0; i < toHideElements.length; i++) {
		    toHideElements[i].style.display = "none";
		}

		var toShowElements = document.getElementsByClassName("tr_"+currentPage);
		for (var i = 0; i < toShowElements.length; i++) {
		    toShowElements[i].style.display = "table-row";
		}
	}
}