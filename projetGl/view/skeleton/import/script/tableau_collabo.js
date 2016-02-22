function showNbPage(){
	var nbElement = parseInt(document.getElementById("main_table").rows.length);
	var nbPage = Math.ceil(nbElement/6);
	document.getElementById("title_account").innerHTML = "Tableau de bord" + " (" + nbPage + " pages)";
}

function previous(){
	var currentPage = parseInt(document.getElementById("btn_actual").value);
	var oldPage = parseInt(currentPage);
	var nbElement = parseInt(document.getElementById("main_table").rows.length);
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
	var nbElement = parseInt(document.getElementById("main_table").rows.length);
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