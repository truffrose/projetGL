<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/task_edit_collabo.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods_tree.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="task_page">
         <div id="task_box">
         
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
            <FORM method=post action="./">
              <input type="hidden"  name="tache"  value="<?php echo $selectedTache->getId(); ?>">
              <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_tacheView; ?>">
              <input type="hidden"  name="action"  value="<?php echo $ACTION_tacheSave; ?>">
              
              <div id="main_box_title"><?php echo $selectedTache->getNom(); ?></div>
  
              <div id="task_description"><?php echo $selectedTache->getDescription(); ?></div>
              
              <div id="label_task_respo">Responsable : </div>
              <a id="href_task_respo" href="<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $selectedTache->getResponsable()->getId(); ?>"><?php echo $selectedTache->getResponsable()->getNom() . ' ' . $selectedTache->getResponsable()->getPrenom(); ?></a>
              <div id="label_task_contact">Contact : </div>
              <a id="href_task_contact" href="<?php echo './index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $selectedTache->getContact()->getId(); ?>"><?php echo $selectedTache->getContact()->getNom() . ' ' . $selectedTache->getContact()->getPrenom(); ?></a>
              <div id="label_task_previous">Tâche précédente : </div>
              <a id="href_task_previous" href="<?php if($selectedTache->getPredecesseur() != null) echo './index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $selectedTache->getPredecesseur()->getId() . ''; ?>"><?php if($selectedTache->getPredecesseur() != null) echo $selectedTache->getPredecesseur()->getNom(); ?></a>
              <!--<div id="label_task_next">Tâche suivante : </div>
              <a id="href_task_next" href="">Tâche 3</a>  --> 
  
              <div id="label_date_end_soon">Date fin (plus tôt) : <span id="date_end_soon_value"><?php echo $selectedTache->getDateFinTot(); ?></span></div>
              <div id="label_date_end_late">Date fin (plus tard) : <span id="date_end_late_value"><?php echo $selectedTache->getDateFinTard(); ?></span></div>
              <div id="label_time_spend">Temps passé (jours) : <input id="time_spend_value" name="time_spend_value" type="text" value="6" maxlength="5" value="<?php echo $selectedTache->getTempsPasse(); ?>"/></div> 
              <div id="label_time_remain">Temps restant (jours) : <input id="time_remain_value" name="time_remain_value" type="text" value="1" maxlength="5" value="<?php echo $selectedTache->getTempsPasse(); ?>"/></div>   
  
              <div id="label_progress">Avancement (%) : <input id="progress" name="progress" type="text" value="<?php echo $selectedTache->getAvancement(); ?>" maxlength="5"/></div>    
  
              <input id="cancel_btn" type="button" value="Annuler" <?php echo 'onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $selectedTache->getId() . '\'"'; ?>/>
              <?php
                if ($_SESSION["user"]->getParameters()->getAutoAlert()) {
                  echo '<div id="label_generate"><input id="generate_check" type="checkbox" checked="checked"/>Générer alerte</div>';
                }
                else {
                  echo '<div id="label_generate"><input id="generate_check" type="checkbox" />Générer alerte</div>';
                }
              ?>
              
              <input id="save_btn" type="submit" value="Sauvegarder"/>
            </FORM>
          </div>

          <div id="tasks_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('tasks_list','tasks_list_search');" onclick="emptyField('tasks_list','tasks_list_search');" oninput="search('tasks_list_search');"/>

            <div id="tasks_list_title"><?php echo $selectedTache->getProjet()->getNom(); ?></div>
            
            <div id="tasks_list">
              <div id="div_tree">
                <ol id="menutree">
                  <?php
                    foreach($selectedTache->getProjet()->getTreeTache() as $value) {
                      if($value->getFille() == null) {
                        echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                      }
                      else {
                        echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></label><ol>';
                        foreach($value->getFille() as $lvl1) {
                          if ($lvl1->getFille() == null) {
                            echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl1->getId() . '">' . $lvl1->getNom() . '</a></li>';
                          }
                          else {
                            echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl1->getId() . '">' . $lvl1->getNom() . '</a></label><ol>';
                            foreach($lvl1->getFille() as $lvl2) {
                              if ($lvl2->getFille() == null) {
                                echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl2->getId() . '">' . $lvl2->getNom() . '</a></li>';
                              }
                              else {
                                echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl2->getId() . '">' . $lvl2->getNom() . '</a></label><ol>';
                                foreach($lvl2->getFille() as $lvl3) {
                                  if ($lvl3->getFille() == null) {
                                    echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl3->getId() . '">' . $lvl3->getNom() . '</a></li>';
                                  }
                                  else {
                                    echo '<li><input type="checkbox"/><label class="tree_label"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl3->getId() . '">' . $lvl3->getNom() . '</a></label><ol>';
                                    foreach($lvl3->getFille() as $lvl4) {
                                      if ($lvl4->getFille() == null) {
                                        echo '<li class="page"><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $lvl4->getId() . '">' . $lvl4->getNom() . '</a></li>';
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
                    echo '<li><a href="./index.php?cursor=' . $CURSOR_tacheEdit . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
                  }
                ?>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>