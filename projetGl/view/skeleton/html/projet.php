<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/projet.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/progress.js' ?>"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods_tree_project.js' ?>"></script>
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
                  <input id="search_field_task" type="text" value="Rechercher" onblur="resetFieldTask('div_tree','tasks_list_search');" onclick="emptyFieldTask('div_tree','tasks_list_search');" oninput="searchTask('tasks_list_search');"/>
      
                  <div id="div_tree">
                    <ol id="menutree">
                      
                  <?php
                    foreach($projectSelected->getTreeTache() as $value) {
                      if($value->getFille() == null) {
                        echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                      }
                      else {
                        echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></label><ol>';
                        foreach($value->getFille() as $lvl1) {
                          if ($lvl1->getFille() == null) {
                            echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl1->getId() . '">' . $lvl1->getNom() . '</a></li>';
                          }
                          else {
                            echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl1->getId() . '">' . $lvl1->getNom() . '</a></label><ol>';
                            foreach($lvl1->getFille() as $lvl2) {
                              if ($lvl2->getFille() == null) {
                                echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl2->getId() . '">' . $lvl2->getNom() . '</a></li>';
                              }
                              else {
                                echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl2->getId() . '">' . $lvl2->getNom() . '</a></label><ol>';
                                foreach($lvl2->getFille() as $lvl3) {
                                  if ($lvl3->getFille() == null) {
                                    echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl3->getId() . '">' . $lvl3->getNom() . '</a></li>';
                                  }
                                  else {
                                    echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl3->getId() . '">' . $lvl3->getNom() . '</a></label><ol>';
                                    foreach($lvl3->getFille() as $lvl4) {
                                      if ($lvl4->getFille() == null) {
                                        echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $lvl4->getId() . '">' . $lvl4->getNom() . '</a></li>';
                                      }
                                      else {
                                        // trop profond pour devoir l'afficher
                                      }
                                    }
                                    echo '</ol></li>';
                                  }
                                }
                                echo '</ol></li>';
                              }
                            }
                            echo '</ol></li>';
                          }
                        }
                        echo '</ol></li>';
                      }
                     }
                  ?>
                    </ol>
                  </div>

                  <div id="tasks_list_search">
                    <ul class="href_list">
                      <?php
                        if ($projectSelected->getId() != -1)
                          foreach($projectSelected->getListTache() as $value) {
                            // echo '<li><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                          }
                      ?>
                    </ul>
                  </div>
      
                </div>
                <?php
              }
            ?>

          <div id="projects_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('projects_list');" onclick="emptyField('projects_list');" oninput="search('projects_list');"/>

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
                  if (getListProjectActif() != null)
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