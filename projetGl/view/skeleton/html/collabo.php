<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/collabo.css' ?>"/>
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
    <div class="collabo_page">
         <div id="collabo_box">
         
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
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&client=-1">Collaborateurs</a></li>';
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

            <!-- BOUTON A MONTRER SI LE USER EST ADMIN-->
            <input id="edit_btn" type="button" value="Editer"/>

            <div id="main_box_title">Collaborateur</div>
            <div id="collabo_name">Nom : Cyril Roussot</div>
            <div id="collabo_address">Adresse : 15 rue des bois, 94230 Cachan</div>
            <div id="collabo_tel">Telephone : 01.56.32.48.95</div>
            <div id="collabo_email">Email : cyril.roussot@maboite.com</div>

            <input id="collabo_btn" type="button" value="Contacter"/>

          </div>

          <div id="collabos_list_box">

            <input id="search_field" type="text" value="Rechercher"/>

            <div id="collabos_list_title">Collaborateurs</div>

            <!-- BOUTON A MONTRER SI LE USER EST ADMIN-->
            <input id="new_collabo_btn" type="button" value="Nouveau Collaborateur"/>

            <div id="collabos_list">
              <ul class="href_list">
                <li><a href="">Marc Dasilvette</a></li>
                <li><a href="">Cyril Roussot</a></li>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>