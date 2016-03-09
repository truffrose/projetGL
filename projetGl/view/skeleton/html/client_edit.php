<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/client_edit.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/client_edit_admin.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_clientEditView . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="client_edit_page">
         <div id="client_box">
         
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
            <FORM method=post action="./">
              <input type="hidden"  name="client"  value="<?php echo $selectClient->getId(); ?>">    
              <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_clientView; ?>">
			  <?php
				if ($selectClient->getId() == -1) {
					echo '<input type="hidden"  name="action"  value="' . $ACTION_clientCreate . '">';
				}
				else {
					echo '<input type="hidden"  name="action"  value="' . $ACTION_clientSave . '">';
				}
			  ?>
               
              <div id="main_box_title">Edition de Client</div>
              <div id="client_name">Nom : </div>
              <input id="client_name_field" name="client_name_field" type="text" value="<?php echo $selectClient->getNom(); ?>" />
              <div id="client_address">Adresse : </div>
              <input id="client_address_field" name="client_address_field" type="text" value="<?php echo $selectClient->getAdresse(); ?>" />
  
              <div id="client_contacts_title">Contacts</div>
              <div id="client_contacts">
                <ul class="href_list">
                  <?php
                    if ($idClient != -1 && isset($listeContact)) {
                      foreach ($listeContact as $value) {
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getPrenom() . ' ' . $value->getPersonne()->getNom() . '</a></li>';
                      }
                    }
                  ?>
                </ul>
              </div> 
              
              <input id="add_contacts_btn" type="button" value="Nouveau" <?php echo 'onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_contactEditView . '&action=' . $ACTION_contactView . '&contact=-1\'"'; ?>/>
               
              <div id="client_projects_title">Projets</div>
              <div id="client_projects">
                <ul class="href_list">
                  <?php
                    if ($idClient != -1 && isset($listeProjet)) {
                      foreach ($listeProjet as $value) {
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                      }
                    }
                  ?>
                </ul>
              </div> 
              
              <input id="add_projects_btn" type="button" value="Nouveau"/>
  
  
			  <?php
				if ($selectClient->getId() == -1) {
					echo '<input id="save_btn" type="submit" value="Créer"/>';
				}
				else {
					echo '<input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $selectClient->getId() . '\'"/>';
					if ($_SESSION["systemData"]->getUserRole() != 4) {
					  echo '<input id="delete_btn" type="button" value="Supprimer" onclick="confirmDelete(); window.location.href=\'./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientDelete . '&client=' . $selectClient->getId() . '\'"/>';
					}
					echo '<input id="save_btn" type="submit" value="Sauvegarder"/>';
				}
			  ?>
              
            </FORM>
          </div>

          <div id="clients_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('clients_list');" onclick="emptyField('clients_list');" oninput="search('clients_list');"/>

            <div id="clients_list_title">Clients</div>

            <input id="new_client_btn" type="button" value="Nouveau Client" <?php echo 'onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_clientEditView . '&action=' . $ACTION_clientView . '&client=-1\'"'; ?>/>

            <div id="clients_list">
              <ul class="href_list">
                <?php
                  foreach ($listeClient as $value) {
                    if ($value->getId() != $idClient) {
                      echo '<li><a href="./index.php?cursor=' . $CURSOR_clientEditView . '&action=' . $ACTION_clientView . '&client=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                    }
                  }
                ?>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>