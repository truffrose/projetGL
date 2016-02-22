/* Fonctions pour faire un recherche sur un input text */
/* onblur="resetField();" onclick="emptyField();" oninput="search();" */

// A mettre sur le 'oninput' event
function search(){
	var searchBox = document.getElementById("search_field");
	var list = document.getElementById("contacts_list").getElementsByTagName("li");
	var searchValue = searchBox.value;

	for(var i=0; i < list.length; i++){
		if(searchValue != ""){
			if (cleanString(list[i].innerHTML).toLowerCase().indexOf(searchValue.toLowerCase()) == -1) {
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

function cleanString(string){
	var cleaned = string.slice(string.indexOf(">")+1,string.indexOf("</a>"));
	return cleaned;
}

// A mettre sur le 'onblur' event
function resetField(){
	var searchBox = document.getElementById("search_field").value = "Rechercher";

	var list = document.getElementById("contacts_list").getElementsByTagName("li");

	for(var i=0; i < list.length; i++){
		list[i].style.display = "list-item";
	}
}

// A mettre sur le 'onclick' event
function emptyField(){
	var searchBox = document.getElementById("search_field").value = "";
}


