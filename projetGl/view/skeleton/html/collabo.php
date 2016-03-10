<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/collabo.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="collabo_page">
         <div id="collabo_box">
         
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
            <span id="span_msg">Message</span>
          </div>
           
          <div id="main_box">
        
          <?php
            if ($idCollabo == -1) {
              echo '<div id="main_box_title">Collaborateur</div>';
              echo '<div id="collabo_name">Veuillez selectionner un collaborateur</div>';
            }
            else {
              if ($_SESSION["systemData"]->getUserRole() == 2) {
                // <!-- BOUTON A MONTRER SI LE USER EST ADMIN-->
                echo '<input id="edit_btn" type="button" value="Editer" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_collaboEditView . '&action=' . $ACTION_collaboView . '&collabo=' . $idCollabo . '\'"/>';
              }
              echo '<div id="main_box_title">Collaborateur</div>';
              foreach($listeCollabo as $value) {
                if ($value->getId() == $idCollabo) {
                  echo '<div id="collabo_name">Nom : ' . $value->getNom() . ' ' . $value->getPrenom() . '</div>';
                  echo '<div id="collabo_address">Adresse : ' . $value->getAdresse() . '</div>';
                  echo '<div id="collabo_tel">Telephone : ' . $value->getTelephone() . '</div>';
                  echo '<div id="collabo_email">Email : ' . $value->getMail() . '</div>';
                  echo '<input id="collabo_btn" type="button" value="Contacter"/>';
                }
              }
            }
          ?>
          </div>

          <div id="collabos_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('collabos_list');" onclick="emptyField('collabos_list');" oninput="search('collabos_list');"/>

            <div id="collabos_list_title">Collaborateurs</div>
            
            <?php
              if ($_SESSION["systemData"]->getUserRole() == 2) {
                echo '<input id="new_collabo_btn" type="button" value="Nouveau Collaborateur" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_collaboEditView . '&action=' . $ACTION_collaboView . '&collabo=-1\'"/>';
              }
            ?>

            <div id="collabos_list">
              <ul class="href_list">
                <?php
                  foreach($listeCollabo as $value) {
                    if ($value->getId() != $idCollabo) {
                      echo '<li><a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $value->getId() . '">' . $value->getNom() . ' ' . $value->getPrenom() . '</a></li>';
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