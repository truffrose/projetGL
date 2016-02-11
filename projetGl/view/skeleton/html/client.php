<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/client.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <body>
    <div class="client_page">
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
              <li class="single_line"><a href="">Recherche</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_compteView; ?>">Mon Compte</a></li>
              <li class="single_line"><a href="<?php echo './index.php?action=' . $ACTION_logOut; ?>">Quitter</a></li>
            </ul>            
            <select id="menu_select_user">
              <option>Collaborateur</option>
              <option selected="selected">Responsable Projet</option>
              <option>Administrateur</option>
            </select>
          </div>
           
          <div id="main_box"></div>

          <input id="edit_btn" type="button" value="Editer"/>

          
  
          <div id="main_box_title">Client</div>
          <?php
            if ($idClient == -1) {
              echo '<div id="client_name">Veuillez selectionner un client (utilise la balise message)</div>';
            }
            else {
              echo '<div id="client_name">Nom : ' . $selectClient->getNom() . '</div>';
              echo '<div id="client_address">Adresse : ' . $selectClient->getAdresse() . '</div>';
            }
          ?>
          
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

          <div id="clients_list_box"></div>

          <input id="search_field" type="text" value="Rechercher"/>

          <div id="clients_list_title">Clients</div>

          <input id="new_client_btn" type="button" value="Nouveau Client"/>

          <div id="clients_list">
            <ul class="href_list">
              <?php
                foreach ($listeClient as $value) {
                  if ($value->getId() != $idClient) {
                    echo '<li><a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                  }
                }
              
              ?>
            </ul>
          </div> 
 
        </div>  
    </div>
  </body>
</html>