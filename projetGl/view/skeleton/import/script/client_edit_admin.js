function confirmDelete(){
  var client = "";
  client = document.getElementById("client_name_field").value;
  var message = "Tous les projets liés à ce client passeront à l'état \"supprimé \" ! " + "\nEtes-vous sûr de vouloir supprimer le client suivant : " + client + " ?";
  /*
  if (confirm(message)) { 
    alert('OK');
  }
  else{
    alert('Annuler');
  }
  */
}