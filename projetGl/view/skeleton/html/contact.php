<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/contact.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="contact_page">
         <div id="contact_box">
         
          <div id="menu_box">
            <ul id="menu">
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li class="single_line"><a href="./index.php?cursor=' . $CURSOR_actu . '">Actualite</a></li>'; ?>
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li><a href="./index.php?cursor=' . $CURSOR_tableau . '">Tableau de bord</a></li>'; ?>
              <li class="single_line selected">
                <a href="">Listes</a>
                <ul>
                  <?php
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=-1">Projets</a></li>';
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=-1">Clients</a></li>';
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=-1">Collaborateurs</a></li>';
                  ?>
                </ul>
              </li>
              <li class="single_line"><a href="<?php echo './index.php?cursor=' . $CURSOR_research; ?>">Recherche</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_compteView; ?>">Mon Compte</a></li>
              <li class="single_line"><a href="<?php echo './index.php?action=' . $ACTION_logOut; ?>">Quitter</a></li>
            </ul>
            <select id="menu_select_user" onchange="changeRole(this)">
              <?php
                foreach (getRoleIdNameByIdUser($_SESSION["user"]->getId()) as $value) {
                  if ($value["id"] == $_SESSION["systemData"]->getUserRole()) {
                   echo '<option value="' . $value["id"] . '" selected="selected">' . $value["nom"] . '</option>';
                  }
                  else {
                    echo '<option value="' . $value["id"] . '">' . $value["nom"] . '</option>';
                  }
                }
              ?>
            </select>
          </div>

          <div id="msg_box">
            <span id="span_msg">Panneau d'administration</span>
          </div>
           
          <div id="main_box">

		  <?php
			if ($_SESSION["systemData"]->getUserRole() != 4){
			  echo '<input id="edit_btn" type="button" value="Editer" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_contactEditView . '&action=' . $ACTION_contactView . '&contact=' . $idContact .'\'"/>';
			}
		  ?>
		  
            <div id="main_box_title">Contact</div>
            
            <?php
              if ($idContact == -1 ) {
                echo '<div id="contact_company">Veuillez selectionner un contact</div>';
              }
              else {
                echo '<div id="contact_company">Societe : ' . $selectClient->getNom() .'</div>';
                echo '<div id="contact_name">Nom : ' . $selectContact->getPersonne()->getPrenom() . ' ' . $selectContact->getPersonne()->getNom() . '</div>';
                echo '<div id="contact_address">Adresse : ' . $selectContact->getPersonne()->getAdresse() . '</div>';
                echo '<div id="contact_tel">Telephone : ' . $selectContact->getPersonne()->getTelephone() . '</div>';
                echo '<div id="contact_email">Email : ' . $selectContact->getPersonne()->getMail() . '</div>';
              }
            ?>
            
            <input id="contact_btn" type="button" value="Contacter"/>

          </div>

          <div id="contacts_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('contacts_list');" onclick="emptyField('contacts_list');" oninput="search('contacts_list');"/>

            <?php
                echo '<div id="contacts_list_title">' . $selectClient->getNom() . '</div>';
            ?>

			<?php
			  if ($_SESSION["systemData"]->getUserRole() != 4){
				echo '<input id="new_contact_btn" type="button" value="Nouveau Contact" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_contactEditView . '&action=' . $ACTION_contactView . '&contact=-1\'"/>';
			  }
			?>
			
            <div id="contacts_list">
              <ul class="href_list">
                <?php
                  if (isset($listeContact)) {
                    foreach ($listeContact as $value) {
                      if ($idContact != $value->getPersonne()->getId()) {
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getPrenom() . ' ' . $value->getPersonne()->getNom() . '</a></li>';
                      }
                    }
                  }
                  else {
                    echo 'no contact';
                  }
                ?>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>