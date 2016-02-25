<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/search.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="search.js"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_research . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  
  <body>
    <div class="search_page">
       <div id="search_box">
       
          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_tableau; ?>">Tableau de bord</a></li>
              <li class="single_line">
                <a href="">Listes</a>
                <ul>
                  <li><a href="">Projets</a></li>
                  <?php
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=-1">Clients</a></li>';
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&client=-1">Collaborateurs</a></li>';
                  ?>
                </ul>
              </li>
              <li class="single_line selected"><a href="<?php echo './index.php?cursor=' . $CURSOR_research; ?>">Recherche</a></li>
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

            <div id="title">Recherche</div>
            <div id="search_type_label">Rechercher :</div>
            <select id="search_type_select" onChange="changeFilters()">
              <option selected="selected">Projet</option>
              <option>Client</option>
              <option>Contact</option>
              <option>Collaborateur</option>
            </select>
            <div id="project_filters">
              <div id="label_project_filter_name">Nom :</div>
              <input id="field_project_filter_name" type="text"  value="Azur" maxlength="20"/>
              <div id="label_project_filter_client">Client :</div>
              <select id="project_filter_client_select">
                <option selected="selected">Tous les clients</option>
                <option>Altec</option>
                <option>Thales</option>
              </select>
              <div id="label_project_filter_respo_select">Responsable :</div>
              <select id="project_filter_respo_select" >
                <option>Tous les responsables</option>
                <option selected="selected" >Cyril Roussot</option>
              </select>
              <div id="group_project_filter_state">
                <input id="checkbox_filter_state_ongoing" type="checkbox" checked="checked"/>
                <div id="label_filter_state_ongoing">En Cours</div>
                <input id="checkbox_filter_state_finished" type="checkbox"/>
                <div id="label_filter_state_finished">Termines</div>
                <input id="checkbox_filter_state_archived" type="checkbox"/>
                <div id="label_filter_state_archived">Archives</div>
              </div>
            </div>
            <div id="client_filters">
              <div id="label_client_filter_name">Nom :</div>
              <input id="field_client_filter_name" type="text"  value="" maxlength="20"/>
              <div id="label_client_filter_address">Adresse :</div>
              <input id="field_client_filter_address" type="text"  value="" maxlength="40"/>
              <div id="label_client_filter_project_select">Projet :</div>
              <select id="client_filter_project_select" >
                <option selected="selected">Tous les projets</option>
                <option>Projet Azure</option>
                <option>Spartacus</option>
              </select>
            </div>
            <div id="contact_filters">
              <div id="label_contact_filter_name">Nom :</div>
              <input id="field_contact_filter_name" type="text"  value="" maxlength="20"/>
              <div id="label_contact_filter_firstname">Prenom :</div>
              <input id="field_contact_filter_firstname" type="text"  value="" maxlength="20"/>
              <div id="label_contact_filter_tel">Telephone :</div>
              <input id="field_contact_filter_tel" type="text"  value="" maxlength="15"/>
              <div id="label_contact_filter_client_select">Client :</div>
              <select id="contact_filter_client_select" >
                <option selected="selected">Tous les clients</option>
                <option>Altec</option>
                <option>Thales</option>
              </select>
            </div>
            <div id="collabo_filters">
              <div id="label_collabo_filter_name">Nom :</div>
              <input id="field_collabo_filter_name" type="text"  value="" maxlength="20"/>
              <div id="label_collabo_filter_firstname">Prenom :</div>
              <input id="field_collabo_filter_firstname" type="text"  value="" maxlength="20"/>
              <div id="label_collabo_filter_tel">Telephone :</div>
              <input id="field_collabo_filter_tel" type="text"  value="" maxlength="15"/>
              <div id="label_collabo_filter_project_select">Projet :</div>
              <select id="collabo_filter_project_select" >
                <option selected="selected">Tous les projets</option>
                <option>Projet Azure</option>
                <option>Spartacus</option>
              </select>
            </div>
            <input id="btn_search" type="button" value="Rechercher" />

          </div>

          <div id="results_box">

            <div id="title_results">Resultat</div>
            <div id="results">
              <a href="">Projet Azure</a>
              <br>
            </div>  

          </div>
      </div>
  </body>
</html>