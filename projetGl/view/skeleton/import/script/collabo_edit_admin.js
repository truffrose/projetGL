function autoCheck(){
	var checkRespo = document.getElementById("collabo_permission_check_respo");
	var checkAdmin = document.getElementById("collabo_permission_check_admin");

	if(checkAdmin.checked == true){
		checkRespo.checked = true;
	}
}