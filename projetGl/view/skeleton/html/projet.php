<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/projet.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/progress.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body onload="setProgress();">
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

            <?php
              if ($projectSelected->getId() == -1) {
                ?>
                  <div id="main_box_title">Projet</div>
                  <div id="project_description">Veuillez selectionner un projet</div>
      
                  <div id="div_gantt"></div>
      
                  <div id="group_progress">
                    <div id="back_bar"></div>
                    <div id="bar"></div>             
                    <div id="label">Avancement <span id="progress_value">0</span> %</div>
                  </div>
                  
                  <div id="list_title">Liste de tâches</div>
                  <input id="search_field_task" type="text" value="Rechercher"/>
      
                  <div id="div_tree">
                    <ol id="menutree">
                    </ul>
                  </div>
                
                </div>
                <?php
              }
              else {
                if ($_SESSION["systemData"]->getUserRole() != 4) {
                  echo '<input id="edit_btn" type="button" value="Editer" onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetEdit . '&action=' . $ACTION_projetView . '&projet=' . $projectSelected->getId() . '\'"/>';
                }
                ?>
                
                  <div id="main_box_title"><?php echo $projectSelected->getNom(); ?></div>
                  <div id="project_description"><?php echo $projectSelected->getDescription(); ?></div>
                  <div id="label_project_client">Client : </div>
                  <a id="href_project_client" href="<?php echo './index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $projectSelected->getClient()->getId() . ''; ?>"><?php echo $projectSelected->getClient()->getNom(); ?></a>
                  <div id="label_project_respo">Responsable : </div>
                  <a id="href_project_respo" href="<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $projectSelected->getResponsable()->getId(); ?>"><?php echo $projectSelected->getResponsable()->getNom() . ' ' . $projectSelected->getResponsable()->getPrenom(); ?></a>
      
                  <div id="div_gantt"></div>
      
                  <div id="group_progress">
                    <div id="back_bar"></div>
                    <div id="bar"></div>             
                    <div id="label">Avancement <span id="progress_value"><?php echo $projectSelected->getAvancement(); ?></span> %</div>
                  </div>
                  
                  <div id="list_title">Liste de tâches</div>
                  <input id="search_field_task" type="text" value="Rechercher"/>
      
                  <div id="div_tree">
                    <ol id="menutree">
                      <li>
                        <input type="checkbox"/>
                        <label class="tree_label"><a href="#">Tâche 1</a></label>
                        <ol>
                          <li>
                            <input type="checkbox"/>
                            <label class="tree_label"><a href="#">Tâche 1.1</a></label>
                            <ol>
                              <li class="page"><a href="#">Tâche 1.1.1</a></li>
                              <li class="page"><a href="#">Tâche 1.1.2</a></li>
                              <li class="page"><a href="#">Tâche 1.1.3</a></li>
                            </ol>
                          </li>
                          <li>
                            <li class="page"><a href="#">Tâche 1.2</a></li>
                        </ol>
                      </li>
      
                      <li>
                        <input type="checkbox"/>
                        <label class="tree_label"><a href="#">Tâche 2</a></label>
                        <ol>
                          <li class="page"><a href="#">Tâche 2.1</a></li>
                          <li class="page"><a href="#">Tâche 2.2</a></li>
                        </ol>
                      </li>
                      <li class="page"><a href="#">Tâche 3</a></li>
                      <li class="page"><a href="#">Tâche 4</a></li>
                      <li class="page"><a href="#">Tâche 5</a></li>
                    </ul>
                  </div>
      
                </div>
                <?php
              }
            ?>

          <div id="projects_list_box">

            <input id="search_field" type="text" value="Rechercher"/>

            <div id="projects_list_title">Projets</div>

            <!-- BOUTON A CACHER SELON LE ROLE-->
            <?php
              if ($_SESSION["systemData"]->getUserRole() != 4) {
                echo '<input id="new_project_btn" type="button" value="Nouveau Projet"/>';
              }
            ?>
            

            <div id="projects_list">
              <ul class="href_list">
                <?php
                  foreach(getListProjectActif() as $value) {
                    if ($projectSelected->getId() != $value->getId()) {
                      echo '<li><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
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