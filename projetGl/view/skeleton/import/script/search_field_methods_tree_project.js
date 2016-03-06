/* Fonctions pour faire un recherche sur un input text */
/* onblur="resetField();" onclick="emptyField();" oninput="search();" */

// A mettre sur le 'oninput' event
function search(nameOfList){
  var searchBox = document.getElementById("search_field_task");
  var list = document.getElementById(nameOfList).getElementsByTagName("li");
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
function resetField(nameOfTree, nameOfList){
  var searchBox = document.getElementById("search_field_task").value = "Rechercher";

  var list = document.getElementById(nameOfList).getElementsByTagName("li");

  for(var i=0; i < list.length; i++){
    list[i].style.display = "list-item";
  }
  document.getElementById(nameOfTree).style.display = "block";
  document.getElementById(nameOfList).style.display = "none";
}

// A mettre sur le 'onclick' event
function emptyField(nameOfTree, nameOfList){
  var searchBox = document.getElementById("search_field_task").value = "";
  document.getElementById(nameOfTree).style.display = "none";
  document.getElementById(nameOfList).style.display = "block";
}