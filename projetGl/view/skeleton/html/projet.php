<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/projet.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/progress.js' ?>"></script>
  <body onload="setProgress();">
    <div class="project_page">
         <div id="project_box">
         
          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="">Tableau de bord</a></li>
              <li class="single_line selected">
                <a href="">Listes</a>
                <ul>
                  <li><a href="">Projets</a></li>
                  <li><a href="">Clients</a></li>
                  <li><a href="">Collaborateurs</a></li>
                </ul>
              </li>
              <li class="single_line"><a href="">Recherche</a></li>
              <li><a href="">Mon Compte</a></li>
              <li class="single_line"><a href="">Quitter</a></li>
            </ul>            
            <select id="menu_select_user">
              <option>Collaborateur</option>
              <option selected="selected">Responsable Projet</option>
              <option>Administrateur</option>
            </select>
          </div>

          <div id="msg_box">
            <span id="span_msg">Message</span>
          </div>
           
          <div id="main_box">

            <?php
              if ($projectSelected->getId() == -1) {
                ?>
                  <!-- BOUTON A CACHER SELON LE ROLE-->
                  <input id="edit_btn" type="button" value="Editer"/>
                  <div id="main_box_title">Projet Azure</div>
                  <div id="project_description">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident.</div>
                  <div id="label_project_client">Client : </div>
                  <a id="href_project_client" href="">Altec</a>
                  <div id="label_project_respo">Responsable : </div>
                  <a id="href_project_respo" href="">Marc Dasilvette</a>
      
                  <div id="div_gantt"></div>
      
                  <div id="group_progress">
                    <div id="back_bar"></div>
                    <div id="bar"></div>             
                    <div id="label">Avancement <span id="progress_value">65</span> %</div>
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
                
                <?php
              }
              else {
                ?>
                
                  <!-- BOUTON A CACHER SELON LE ROLE-->
                  <input id="edit_btn" type="button" value="Editer"/>
                  
                  <div id="main_box_title"><?php echo $projectSelected->getNom(); ?></div>
                  <div id="project_description"><?php echo $projectSelected->getDescription(); ?></div>
                  <div id="label_project_client">Client : </div>
                  <a id="href_project_client" href="<?php echo './index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=' . $projectSelected->getClient()->getId() . ''; ?>"><?php echo $projectSelected->getClient()->getNom(); ?></a>
                  <div id="label_project_respo">Responsable : </div>
                  <a id="href_project_respo" href=""><?php echo $projectSelected->getResponsable()->getNom() . ' ' . $projectSelected->getResponsable()->getPrenom(); ?></a>
      
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
            <input id="new_project_btn" type="button" value="Nouveau Projet"/>

            <div id="projects_list">
              <ul class="href_list">
                <?php
                  foreach(getListProjectActif() as $value) {
                    if ($projectSelected->getId() != $value->getId()) {
                      echo '<li><a href="">' . $value->getNom() . '</a></li>';
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