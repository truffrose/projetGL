<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/projet_edit.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods_projet_edit.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_projetEdit . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="project_page">
         <div id="project_box">
         
          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_tableau; ?>">Tableau de bord</a></li>
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
              <li ><a href="<?php echo './index.php?cursor=' . $CURSOR_compteView; ?>">Mon Compte</a></li>
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

            <div id="main_box_title">Edition de projet</div>
            <FORM method=post action="./">
              <div id="label_project_name">Nom du projet : </div>
              <input type="text" id="project_name" value="<?php echo $projectSelected->getNom(); ?>" maxlength="20"/>
  
              <div id="label_project_description">Description : </div>
              <textarea id="project_description" cols="40" rows="5" maxlength="500"><?php echo $projectSelected->getDescription(); ?></textarea>
              
              <div id="label_project_client">Client : </div>
              <select id="select_project_client">
                <?php
                  foreach(getListActiveClient() as $value) {
                    if ($value->getId() == $projectSelected->getClient()->getId()) {
                      echo '<option selected="selected" value="' . $projectSelected->getClient()->getId() . '">' . $projectSelected->getClient()->getNom() . '</option>';
                    }
                    else {
                      echo '<option  value="' . $projectSelected->getClient()->getId() . '"****>' . $projectSelected->getClient()->getNom() . '</option>';
                    }
                  }
                ?>
                
              </select>
              <div id="label_project_respo">Responsable : </div>
              <select id="select_project_respo">
                <option>Marc Dasilvette</option>
                <option selected="selected">Cyril Roussot</option>
              </select>
              
              <div id="list_title">Liste de tâches</div>
              <input id="search_field_task" type="text" value="Rechercher" onblur="resetFieldTask('div_tasks');" onclick="emptyFieldTask('div_tasks');" oninput="searchTask('div_tasks');"/>
  
              <div id="div_tasks">
                <ul class="href_list">
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 1</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 1.1</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 1.2</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 1.3</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 2</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 2.1</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 2.2</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 3</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 4</a></li>
                  <li>&nbsp;&nbsp;&nbsp;<a href="">Tâche 5</a></li>
                </ul>
              </div>
  
              <input id="task_btn" type="button" value="Créer une nouvelle tâche"/>
  
              <input id="cancel_btn" type="button" value="Annuler" <?php echo ' onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $projectSelected->getId() . '\'"'; ?>/>
              <input id="delete_btn" type="button" value="Supprimer"/>
              <input id="save_btn" type="button" value="Sauvegarder"/>
            </FORM>
          </div>

          <div id="projects_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('projects_list');" onclick="emptyField('projects_list');" oninput="search('projects_list');"/>

            <div id="projects_list_title">Projets</div>

            <!-- BOUTON A CACHER SELON LE ROLE-->
            <input id="new_project_btn" type="button" value="Nouveau Projet"/>

            <div id="projects_list">
              <ul class="href_list">
                <li><a href="">Azure</a></li>
                <li><a href="">Spartacus</a></li>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>