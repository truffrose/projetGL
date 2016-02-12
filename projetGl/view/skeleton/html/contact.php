<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/contact.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <body>
    <div class="contact_page">
         <div id="contact_box">
         
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

          <div id="msg_box">
            <span id="span_msg">Panneau d'administration</span>
          </div>
           
          <div id="main_box">

            <input id="edit_btn" type="button" value="Editer"/>

            <div id="main_box_title">Contact</div>
            
            <?php
              if ($idContact == -1 ) {
                echo '<div id="contact_company">Veuillez selectionner un contact (utilise la balise message)</div>';
              }
              else {
                echo '<div id="contact_company">Societe : ' . $selectClient->getNom() .'</div>';
                foreach ($listeContact as $value) {
                  if ($idContact == $value->getPersonne()->getId()) {
                    echo '<div id="contact_name">Nom : ' . $value->getPersonne()->getPrenom() . ' ' . $value->getPersonne()->getNom() . '</div>';
                    echo '<div id="contact_address">Adresse : 2 avenue de Paris, 74000 Annecy // c est quoi cette adress</div>';
                    echo '<div id="contact_tel">Telephone : ' . $value->getPersonne()->getTelephone() . '</div>';
                    echo '<div id="contact_email">Email : ' . $value->getPersonne()->getMail() . '</div>';
                  break;
                  }
                }
              }

              
            ?>
            
            <input id="contact_btn" type="button" value="Contacter"/>

          </div>

          <div id="contacts_list_box">

            <input id="search_field" type="text" value="Rechercher"/>

            <div id="contacts_list_title">Altec</div>

            <input id="new_contact_btn" type="button" value="Nouveau Contact"/>

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