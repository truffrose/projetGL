<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/contact_edit.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_contactEditView . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="contact_page">
         <div id="contact_box">
         
          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_tableau; ?>">Tableau de bord</a></li>
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
            <div id="main_box_title">Edition de Contact</div>
            
            <div id="contact_company">Societe : </div>
            <select id="contact_company_select">
              <option selected="selected">Altec</option>
              <option>Thales</option>
            </select>
            
            <?php
              if ($idContact == -1 ) {
                echo '<div id="contact_company">Veuillez selectionner un contact (utilise la balise message)</div>';
              }
              else {
                ?>
                <div id="contact_name">Nom : </div>
                <input id="contact_name_field" type="text" value="<?php echo $selectContact->getPersonne()->getPrenom() . ' ' . $selectContact->getPersonne()->getNom(); ?>"/>
                <div id="contact_address">Adresse : </div>
                <input id="contact_address_field" type="text" value="que c'est que c'est quoi?"/>
                <div id="contact_tel">Telephone : </div>
                <input id="contact_tel_field" type="text" value="<?php echo $selectContact->getPersonne()->getTelephone(); ?>"/>
                <div id="contact_email">Email : </div>
                <input id="contact_email_field" type="text" value="<?php echo $selectContact->getPersonne()->getMail(); ?>"/>
                <?php
              }
            ?>
            
            

            <input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $selectContact->getId(); ?>'"/>
            <input id="save_btn" type="button" value="Sauvegarder"/>
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
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_contactEditView . '&action=' . $ACTION_contactView . '&contact=' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getPrenom() . ' ' . $value->getPersonne()->getNom() . '</a></li>';
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