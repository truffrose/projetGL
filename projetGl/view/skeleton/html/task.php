<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/task.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/progress_task.js' ?>"></script>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods_tree.js' ?>"></script>
  <body onload="setProgress();">
    <div class="task_page">
         <div id="task_box">
         
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

            <!-- BOUTON A CACHER SELON LE ROLE-->
            <?php
              if ($_SESSION["systemData"]->getUserRole() != 4) {
                echo '<input id="edit_btn" type="button" value="Editer"/>';
              }
            ?>

            <div id="main_box_title"><?php echo $selectedTache->getNom(); ?></div>

            <div id="task_description"><?php echo $selectedTache->getDescription(); ?></div>
            
            <div id="label_task_respo">Responsable : </div>
            <a id="href_task_respo" href="<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $selectedTache->getResponsable()->getId(); ?>"><?php echo $selectedTache->getResponsable()->getNom() . ' ' . $selectedTache->getResponsable()->getPrenom(); ?></a>
            <div id="label_task_contact">Contact : </div>
            <a id="href_task_contact" href="<?php echo './index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $selectedTache->getContact()->getId(); ?>"><?php echo $selectedTache->getContact()->getNom() . ' ' . $selectedTache->getContact()->getPrenom(); ?></a>
            <div id="label_task_previous">Tâche précédente : </div>
            <a id="href_task_previous" href="<?php if($selectedTache->getPredecesseur() != null) echo './index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $selectedTache->getPredecesseur()->getId() . ''; ?>"><?php if($selectedTache->getPredecesseur() != null) echo $selectedTache->getPredecesseur()->getNom(); ?></a>
            <!--
              <div id="label_task_next">Tâche suivante : </div>
              <a id="href_task_next" href="">Tâche 3</a>
            -->

            <div id="label_date_end_soon">Date fin (plus tôt) : <span id="date_end_soon_value"><?php echo $selectedTache->getDateFinTot(); ?></span></div>
            <div id="label_date_end_late">Date fin (plus tard) : <span id="date_end_late_value"><?php echo $selectedTache->getDateFinTard(); ?></span></div>
            <div id="label_time_spend">Temps passé : <span id="time_spend_value"><?php echo $selectedTache->getTempsPasse(); ?></span><span id="time_spend_unit"> <?php echo $selectedTache->getUniteTemps(); ?></span></div>
            <div id="label_time_remain">Temps restant : <span id="time_remain_value"><?php echo $selectedTache->getTempsRestant(); ?></span><span id="time_remain_unit"> <?php echo $selectedTache->getUniteTemps(); ?></span></div>         

            <div id="group_progress">
              <div id="back_bar"></div>
              <div id="bar"></div>             
              <div id="label">Avancement <span id="progress_value"><?php echo $selectedTache->getAvancement(); ?></span> %</div>
            </div>

            <!-- BOUTON A CACHER SI L'UTILISATEUR N'EST PAS COLLABORATEUR -->
            <input id="alert_btn" type="button" value="Alerte"/>

            <input id="contact_btn" type="button" value="Contacter"/>

          </div>

          <div id="tasks_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('tasks_list','tasks_list_search');" onclick="emptyField('tasks_list','tasks_list_search');" oninput="search('tasks_list_search');"/>

            <div id="tasks_list_title"><?php echo $selectedTache->getProjet()->getNom(); ?></div>

            <!-- BOUTON A CACHER SELON LE ROLE-->
            <?php
              if ($_SESSION["systemData"]->getUserRole() != 4) {
                echo '<input id="new_task_btn" type="button" value="Nouvelle Tâche"/>';
              }
            ?>

            <div id="tasks_list">
              <div id="div_tree">
                <ol id="menutree">
                  <?php
                    foreach($selectedTache->getProjet()->getTreeTache() as $value) {
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
            </div> 

            <div id="tasks_list_search">
              <ul class="href_list">
                <?php
                  foreach($selectedTache->getProjet()->getListTache() as $value)
                  {
                    echo '<li><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                  }
                ?>
              </ul>
            </div> 
            
          </div>
 
        </div>  
    </div>
  </body>
</html>