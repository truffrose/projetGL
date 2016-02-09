function changeFilters(){
  var selected_type_search = document.getElementById("search_type_select").selectedIndex;
  if(selected_type_search == 0){
    document.getElementById("project_filters").style.visibility = 'visible';
    document.getElementById("client_filters").style.visibility = 'hidden';
    document.getElementById("contact_filters").style.visibility = 'hidden';
    document.getElementById("collabo_filters").style.visibility = 'hidden';
  }
  else if(selected_type_search == 1){
    document.getElementById("project_filters").style.visibility = 'hidden';
    document.getElementById("client_filters").style.visibility = 'visible';
    document.getElementById("contact_filters").style.visibility = 'hidden';
    document.getElementById("collabo_filters").style.visibility = 'hidden';
  }
  else if(selected_type_search == 2){
    document.getElementById("project_filters").style.visibility = 'hidden';
    document.getElementById("client_filters").style.visibility = 'hidden';
    document.getElementById("contact_filters").style.visibility = 'visible';
    document.getElementById("collabo_filters").style.visibility = 'hidden';
  }
  else if(selected_type_search == 3){
    document.getElementById("project_filters").style.visibility = 'hidden';
    document.getElementById("client_filters").style.visibility = 'hidden';
    document.getElementById("contact_filters").style.visibility = 'hidden';
    document.getElementById("collabo_filters").style.visibility = 'visible';
  }
  else{
    document.getElementById("project_filters").style.visibility = 'visible';
    document.getElementById("client_filters").style.visibility = 'hidden';
    document.getElementById("contact_filters").style.visibility = 'hidden';
    document.getElementById("collabo_filters").style.visibility = 'hidden';
  }
}