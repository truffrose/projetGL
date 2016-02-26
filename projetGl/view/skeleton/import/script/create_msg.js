function selectReceiver(li){
	if(li.className != "selected_li"){
		li.className = "selected_li";
	}
	else{
		li.className = "";
	}
}