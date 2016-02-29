<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
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
  
  <body onLoad="changeFilters()">
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
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=-1">Collaborateurs</a></li>';
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
            <FORM method="POST" action="./">
              
              <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_research; ?>">
              <input type="hidden"  name="action"  value="<?php echo $ACTION_showResult; ?>">
              
              <div id="search_type_label">Rechercher :</div>
              <select id="search_type_select" name="search_type_select" onChange="changeFilters()">
                <?php
                  if (isset($_SESSION["resultat"]) && $_SESSION["resultat"] != NULL && $_SESSION["resultat"][1] != NULL) {
                    if ($_SESSION["resultat"][0] == 0) {
                      // projet
                      echo '<option selected="selected" value="0">Projet</option>';
                      echo '<option value="1">Client</option>';
                      echo '<option value="2">Contact</option>';
                      echo '<option value="3">Collaborateur</option>';
                    }
                    elseif ($_SESSION["resultat"][0] == 1) {
                      // client
                      echo '<option value="0">Projet</option>';
                      echo '<option selected="selected" value="1">Client</option>';
                      echo '<option value="2">Contact</option>';
                      echo '<option value="3">Collaborateur</option>';
                    }
                    elseif ($_SESSION["resultat"][0] == 2) {
                      // contact
                      echo '<option value="0">Projet</option>';
                      echo '<option value="1">Client</option>';
                      echo '<option selected="selected" value="2">Contact</option>';
                      echo '<option value="3">Collaborateur</option>';
                    }
                    elseif ($_SESSION["resultat"][0] == 3) {
                      // collaborateur
                      echo '<option value="0">Projet</option>';
                      echo '<option value="1">Client</option>';
                      echo '<option value="2">Contact</option>';
                      echo '<option selected="selected" value="3">Collaborateur</option>';
                    }
                  }
                  else {
                    echo '<option selected="selected" value="0">Projet</option>';
                    echo '<option value="1">Client</option>';
                    echo '<option value="2">Contact</option>';
                    echo '<option value="3">Collaborateur</option>';
                  }
                ?>
              </select>
              
              <div id="project_filters">
                <div id="label_project_filter_name">Nom :</div>
                <input id="field_project_filter_name" name="field_project_filter_name" type="text"  value="" maxlength="20"/>
                <div id="label_project_filter_client">Client :</div>
                <select id="project_filter_client_select" name="project_filter_client_select">
                  <option selected="selected" value="-1">Tous les clients</option>
                  <?php
                    foreach(getListActiveClient() as $value) {
                      echo '<option value="' . $value->getId() . '">' . $value->getNom() . '</option>';
                    }
                  ?>
                </select>
                <div id="label_project_filter_respo_select">Responsable :</div>
                <select id="project_filter_respo_select" name="project_filter_respo_select">
                  <option selected="selected" value="-1">Tous les responsables</option>
                  <?php
                    foreach(getRespoList() as $value) {
                      echo '<option value="' . $value->getId() . '">' . $value->getNom() . ' ' . $value->getPrenom() . '</option>';
                    }
                  ?>
                </select>
                <div id="group_project_filter_state">
                  <input id="checkbox_filter_state_ongoing" name="checkbox_filter_state_ongoing" value="check" type="checkbox" checked="checked"/>
                  <div id="label_filter_state_ongoing">En Cours</div>
                  <input id="checkbox_filter_state_finished" name="checkbox_filter_state_finished" value="check" type="checkbox"/>
                  <div id="label_filter_state_finished">Termines</div>
                  <input id="checkbox_filter_state_archived" name="checkbox_filter_state_archived" value="check" type="checkbox"/>
                  <div id="label_filter_state_archived">Archives</div>
                </div>
              </div>
              <div id="client_filters">
                <div id="label_client_filter_name">Nom :</div>
                <input id="field_client_filter_name" name="field_client_filter_name" type="text"  value="" maxlength="20"/>
                <div id="label_client_filter_address">Adresse :</div>
                <input id="field_client_filter_address" name="field_client_filter_address" type="text"  value="" maxlength="40"/>
                <div id="label_client_filter_project_select">Projet :</div>
                <select id="client_filter_project_select" name="client_filter_project_select" >
                  <option selected="selected" value="-1">Tous les projets</option>
                  <?php
                    foreach(getListProjectActif() as $value) {
                      echo '<option value="' . $value->getId() . ' ">' . $value->getNom() . '</option>';
                    }
                  ?>
                </select>
              </div>
              <div id="contact_filters">
                <div id="label_contact_filter_name">Nom :</div>
                <input id="field_contact_filter_name" name="field_contact_filter_name" type="text"  value="" maxlength="20"/>
                <div id="label_contact_filter_firstname">Prenom :</div>
                <input id="field_contact_filter_firstname" name="field_contact_filter_firstname" type="text"  value="" maxlength="20"/>
                <div id="label_contact_filter_tel">Telephone :</div>
                <input id="field_contact_filter_tel" name="field_contact_filter_tel" type="text"  value="" maxlength="15"/>
                <div id="label_contact_filter_client_select">Client :</div>
                <select id="contact_filter_client_select" name="contact_filter_client_select">
                  <option selected="selected" value="-1">Tous les clients</option>
                  <?php
                    foreach(getListActiveClient() as $value) {
                      echo '<option value="' . $value->getId() . '">' . $value->getNom() . '</option>';
                    }
                  ?>
                </select>
              </div>
              <div id="collabo_filters">
                <div id="label_collabo_filter_name">Nom :</div>
                <input id="field_collabo_filter_name" name="field_collabo_filter_name" type="text"  value="" maxlength="20"/>
                <div id="label_collabo_filter_firstname">Prenom :</div>
                <input id="field_collabo_filter_firstname" name="field_collabo_filter_firstname" type="text"  value="" maxlength="20"/>
                <div id="label_collabo_filter_tel">Telephone :</div>
                <input id="field_collabo_filter_tel" name="field_collabo_filter_tel" type="text"  value="" maxlength="15"/>
                <div id="label_collabo_filter_project_select">Projet :</div>
                <select id="collabo_filter_project_select" name="collabo_filter_project_select" >
                  <option selected="selected" value="-1">Tous les projets</option>
                  <?php
                    foreach(getListProjectActif() as $value) {
                      echo '<option value="' . $value->getId() . ' ">' . $value->getNom() . '</option>';
                    }
                  ?>
                </select>
              </div>
             <input id="btn_search" type="submit" value="Rechercher" />
            </FORM>

          </div>

          <div id="results_box">

            <div id="title_results">Resultat</div>
            <div id="results">
              <?php
                if (isset($_SESSION["resultat"]) && $_SESSION["resultat"] != NULL && $_SESSION["resultat"][1] != NULL) {
                  foreach($_SESSION["resultat"][1] as $value) {
                    if ($_SESSION["resultat"][0] == 0) {
                      // projet
                      echo '<a href="">' . $value->getNom() . '</a><br/>'; // pas encore les id pour redirection
                    }
                    elseif ($_SESSION["resultat"][0] == 1) {
                      // client
                      echo '<a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $value->getId() . '">' . $value->getNom() . '</a><br/>';
                    }
                    elseif ($_SESSION["resultat"][0] == 2) {
                      // contact
                      echo '<a href="./index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getNom() . ' ' . $value->getPersonne()->getPrenom() . '</a><br/>';
                    }
                    else if ($_SESSION["resultat"][0] == 3) {
                      // collaborateur
                      echo '<a href="./index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $value->getId() . '">' . $value->getNom() . ' ' . $value->getPrenom() . '</a><br/>'; // pas encore les id pour redirection
                    }
                  }
                  unset($_SESSION["resultat"]);
                }
                else {
                  echo 'Pas d résultat';
                }
              ?>
              <br>
            </div>  

          </div>
      </div>
  </body>
</html>