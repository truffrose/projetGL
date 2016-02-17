<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/client_edit.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <body>
    <div class="client_edit_page">
         <div id="client_box">
         
          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="">Tableau de bord</a></li>
              <li class="single_line selected">
                <a href="">Listes</a>
                <ul>
                  <li><a href="">Projets</a></li>
                  <?php
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=-1">Clients</a></li>';
                  ?>
                  <li><a href="">Collaborateurs</a></li>
                </ul>
              </li>
              <li class="single_line"><a href="<?php echo './index.php?cursor=' . $CURSOR_research; ?>">Recherche</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_compteView; ?>">Mon Compte</a></li>
              <li class="single_line"><a href="<?php echo './index.php?action=' . $ACTION_logOut; ?>">Quitter</a></li>
            </ul>            
            <select id="menu_select_user">
              <option>Collaborateur</option>
              <option selected="selected">Responsable Projet</option>
              <option>Administrateur</option>
            </select>
          </div>

          <div id="msg_box">
            <span id="span_msg">Panneau d'administration</span>
          </div>
           
          <div id="main_box">

            <div id="main_box_title">Edition de Client</div>
            <div id="client_name">Nom : </div>
            <input id="client_name_field" type="text" value="<?php echo $selectClient->getNom(); ?>" />
            <div id="client_address">Adresse : </div>
            <input id="client_address_field" type="text" value="<?php echo $selectClient->getAdresse(); ?>" />

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
            <select id="client_contacts_select">
            </select>
            <input id="add_contacts_btn" type="button" value="+"/>
             
            <div id="client_projects_title">Projets</div>
            <div id="client_projects">
              <ul class="href_list">
                <?php
                  if ($idClient != -1 && isset($listeProjet)) {
                    foreach ($listeProjet as $value) {
                      echo '<li><a href="">' . $value->getNom() . '</a></li>';
                    }
                  }
                ?>
              </ul>
            </div> 
            <select id="client_projects_select">
            </select>
            <input id="add_projects_btn" type="button" value="+"/>

            <input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $selectClient->getId(); ?>'"/>
            <input id="save_btn" type="button" value="Sauvegarder"/>

          </div>

          <div id="clients_list_box">

            <input id="search_field" type="text" value="Rechercher"/>

            <div id="clients_list_title">Clients</div>

            <input id="new_client_btn" type="button" value="Nouveau Client"/>

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