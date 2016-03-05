<?php

	/**

		Projet GL
		Projet de gestion de projet en lien avec l'école Polytech Paris Sud
		
		Autheur: 	Castelain Florian
					DaSilva Thomas
					Rousseau Aurelien
					Djian Thomas
					LaPorte Aurelien

		Version: 1.2 (09/02/2016 at 23:21:00)

	**/

	// make the web site working

		// import the models
		require_once("./model/personne.php");
		require_once("./model/user.php");
		require_once("./model/userParameters.php");
		require_once("./model/client.php");
		require_once("./model/contact.php");
		require_once("./model/systemData.php");
		require_once("./model/tache.php");
		require_once("./model/projet.php");
        
		
		// import the Controller
		require_once("./controller/controller.php");
		
		// import the view
		require_once("./view/view.php");

        
        // utile uniquement pour le debug
        /* *
        echo '</br></br></br></br>';
        echo '</br></br></br></br>';
        if (isset($_SESSION))
            print_r($_SESSION);
        /* */
?>
