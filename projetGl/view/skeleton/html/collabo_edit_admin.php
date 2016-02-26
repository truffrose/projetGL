<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/collabo_edit_admin.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
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
              <li class="single_line selected">
                <a href="">Listes</a>
                <ul>
                  <li><a href="">Projets</a></li>
                  <?php
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
            foreach($listeCollabo as $value) {
              if ($value->getId() == $idCollabo) {
                $currentCollabo = $value;
              }
            }
          ?>


            <div id="main_box_title">Edition Collaborateur</div>
            
            <FORM method=post action="./">
              
			  <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_collabo; ?>">
			  <input type="hidden"  name="action"  value="<?php echo $ACTION_collaboSave; ?>">
			  <input type="hidden"  name="collabo"  value="<?php echo $idCollabo; ?>">
              
              <div id="collabo_name">Nom :</div>
              <input id="collabo_name_field" name="collabo_name_field" type="text" value="<?php echo $currentCollabo->getNom(); ?>" maxlength="30">
  
              <div id="collabo_firstname">Prenom :</div>
              <input id="collabo_firstname_field" name="collabo_firstname_field" type="text" value="<?php echo $currentCollabo->getPrenom(); ?>" maxlength="30">
  
              <div id="collabo_password">Mot de passe :</div>
              <input id="collabo_password_field" name="collabo_password_field" type="password" value="*****" maxlength="20">
  
              <div id="collabo_address">Adresse :</div>
              <input id="collabo_address_field" name="collabo_address_field" type="text" value="<?php echo $currentCollabo->getAdresse(); ?>" maxlength="40">
  
              <div id="collabo_phone">Telephone :</div>
              <input id="collabo_phone_field" name="collabo_phone_field" type="text" value="<?php echo $currentCollabo->getTelephone(); ?>" maxlength="15">
  
              <div id="collabo_email">Email :</div>
              <input id="collabo_email_field" name="collabo_email_field" type="text" value="<?php echo $currentCollabo->getMail(); ?>" maxlength="40">
  
              <div id="collabo_permission">Droits :</div>
              <div id="collabo_permission_checks">
                
                
              <?php
                $tempArray[0][0] = 4;
                $tempArray[0][1] = " Collaborateur";
                $tempArray[0][2] = false;
				$tempArray[0][3] = "collabo";
                $tempArray[1][0] = 3;
                $tempArray[1][1] = " Responsable de projet";
                $tempArray[1][2] = false;
				$tempArray[1][3] = "respo";
                $tempArray[2][0] = 2;
                $tempArray[2][1] = " Administrateur";
                $tempArray[2][2] = false;
				$tempArray[2][3] = "admin";
                foreach (getRoleIdNameByIdUser(getUserIdFromPers($idCollabo)) as $value) {
                  for ($i = 0; $i < 3; $i++) {
                    if ($tempArray[$i][0] == $value["id"]) {
                      $tempArray[$i][2] = true;
                    }
                  }
                }
                for ($i = 0; $i < 3; $i++) {
                  if ($tempArray[$i][2]) {
                    echo '<input id="collabo_permission_check_' . $tempArray[$i][3] . '"  name="collabo_permission_check_' . $tempArray[$i][3] . '"  type="checkbox" value="check" checked="checked">' . $tempArray[$i][1] . '<p>';
                  }
                  else {
                    echo '<input id="collabo_permission_check_' . $tempArray[$i][3] . '" name="collabo_permission_check_' . $tempArray[$i][3] . '"  type="checkbox" value="check">' . $tempArray[$i][1] . '<p>';
                  }
                }
              ?>
              </div>
  
              <input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $idCollabo; ?>'"/>
              <input id="delete_btn" type="button" value="Supprimer" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboDelete . '&collabo=' . $idCollabo; ?>'"/>
              <input id="save_btn" type="submit" value="Sauvegarder"/>

            </FORM>
            
          </div>

          <div id="collabos_list_box">

            <input id="search_field" type="text" value="Rechercher"/>

            <div id="collabos_list_title">Collaborateurs</div>

            <input id="new_collabo_btn" type="button" value="Nouveau Collaborateur"/>

            <div id="collabos_list">
              <ul class="href_list">
                <?php
                  foreach($listeCollabo as $value) {
                    if ($value->getId() != $idCollabo) {
                      echo '<li><a href="./index.php?cursor=' . $CURSOR_collaboEditView . '&action=' . $ACTION_collaboView . '&collabo=' . $value->getId() . '">' . $value->getNom() . ' ' . $value->getPrenom() . '</a></li>';
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