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

            <div id="main_box_title">Edition de projet</div>
            
			<?php
			  if ($projectSelected->getId() != -1) {
			?>
				<FORM method=post action="./">
				  
				  <input type="hidden"  name="action"  value="<?php echo $ACTION_projetSave; ?>">
				  <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_projetView; ?>">
				  <input type="hidden"  name="projet"  value="<?php echo $projectSelected->getId(); ?>">
				  
				  <div id="label_project_name">Nom du projet : </div>
				  <input type="text" id="project_name" name="project_name" value="<?php echo $projectSelected->getNom(); ?>" maxlength="20"/>
	  
				  <div id="label_project_description">Description : </div>
				  <textarea id="project_description" name="project_description" cols="40" rows="5" maxlength="500"><?php echo $projectSelected->getDescription(); ?></textarea>
				  
				  <div id="label_project_client">Client : </div>
				  <select id="select_project_client" name="select_project_client">
					<?php
					  foreach(getListActiveClient() as $value) {
						if ($value->getId() == $projectSelected->getClient()->getId()) {
						  echo '<option selected="selected" value="' . $projectSelected->getClient()->getId() . '">' . $projectSelected->getClient()->getNom() . '</option>';
						}
						else {
						  echo '<option  value="' . $value->getId() . '">' . $value->getNom() . '</option>';
						}
					  }
					?>
					
				  </select>
				  <div id="label_project_respo">Responsable : </div>
				  <select id="select_project_respo" name="select_project_respo">
					<?php
					  echo '<option selected="selected" value="' . $projectSelected->getResponsable()->getId() . '">' . $projectSelected->getResponsable()->getNom() . ' ' . $projectSelected->getResponsable()->getPrenom() . '</option>';
					  if ($projectSelected->getResponsable()->getListActiveUserByRole(3) != null)
						foreach($projectSelected->getResponsable()->getListActiveUserByRole(3) as $pers) {
						  echo '<option value="' . $pers["id"] . '">' . $pers["nom"] . ' ' . $pers["prenom"] . '</option>';
						}
					?>
				  </select>

				  <div id="label_unit">Unité de temps : </div>
				  <!-- ATTENTION ATTENTION ATTENTION -->
				  <!-- A REMPLIR AVEC LES CHAMPS DE LA BASE -->
				  <select id="select_unit" name="select_unit">
					<option>Jours</option>
					<option>Heure</option>
				  </select>
				  
				  <div id="list_title">Liste des tâches</div>
				  <input id="search_field_task" type="text" value="Rechercher" onblur="resetFieldTask('div_tasks');" onclick="emptyFieldTask('div_tasks');" oninput="searchTask('div_tasks');"/>
	  
				  <div id="div_tasks">
					<ul class="href_list">
					  <?php
						if ($projectSelected->getListTache() != null)
						  foreach($projectSelected->getListTache() as $value) {
							echo '<li>&nbsp;&nbsp;&nbsp;<a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
						  }
					  ?>
					</ul>
				  </div>
	  
				  <input id="task_btn" type="button" value="Créer une nouvelle tâche"/>
	  
				  <input id="cancel_btn" type="button" value="Annuler" <?php echo ' onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $projectSelected->getId() . '\'"'; ?>/>
				  <input id="delete_btn" type="button" value="Supprimer" <?php echo ' onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetDelete . '&projet=' . $projectSelected->getId() . '\'"'; ?>/>
				  <input id="save_btn" type="submit" value="Sauvegarder"/>
				</FORM>
			<?php
			  }
			  else {
			?>
				<FORM method=post action="./">
				  
				  <input type="hidden"  name="action"  value="<?php echo $ACTION_projetCreate; ?>">
				  <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_projetView; ?>">
				  
				  <div id="label_project_name">Nom du projet : </div>
				  <input type="text" id="project_name" name="project_name" value="" maxlength="20"/>
	  
				  <div id="label_project_description">Description : </div>
				  <textarea id="project_description" name="project_description" cols="40" rows="5" maxlength="500"></textarea>
				  
				  <div id="label_project_client">Client : </div>
				  <select id="select_project_client" name="select_project_client">
					<?php
					  foreach(getListActiveClient() as $value) {
						echo '<option  value="' . $value->getId() . '">' . $value->getNom() . '</option>';
					  }
					?>
					
				  </select>
				  <div id="label_project_respo">Responsable : </div>
				  <select id="select_project_respo" name="select_project_respo">
					<?php
					  if (getRespoList() != null)
						foreach(getRespoList() as $pers) {
						  echo '<option value="' . $pers->getId() . '">' . $pers->getNom() . ' ' . $pers->getPrenom() . '</option>';
						}
					?>
				  </select>

				  <div id="label_unit">Unité de temps : </div>
				  <!-- ATTENTION ATTENTION ATTENTION -->
				  <!-- A REMPLIR AVEC LES CHAMPS DE LA BASE -->
				  <select id="select_unit" name="select_unit">
					<option>Jours</option>
					<option>Heure</option>
				  </select>
<!--
				  <div id="list_title">Liste de tâches</div>
				  <input id="search_field_task" type="text" value="Rechercher" onblur="resetFieldTask('div_tasks');" onclick="emptyFieldTask('div_tasks');" oninput="searchTask('div_tasks');"/>
	  
				  <div id="div_tasks">
					<ul class="href_list">
					</ul>
				  </div>
	  
				  <input id="task_btn" type="button" value="Créer une nouvelle tâche"/>
-->	  
				  <input id="cancel_btn" type="button" value="Annuler" <?php echo ' onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=-1\'"'; ?>/>
				  <input id="save_btn" type="submit" value="Créer"/>
				</FORM>
			<?php	
			  }
			?>
          </div>

          <div id="projects_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('projects_list');" onclick="emptyField('projects_list');" oninput="search('projects_list');"/>

            <div id="projects_list_title">Projets</div>

            <!-- BOUTON A CACHER SELON LE ROLE-->
            <input id="new_project_btn" type="button" value="Nouveau Projet" <?php echo ' onclick="window.location.href=\'./index.php?cursor=' . $CURSOR_projetEdit . '&action=' . $ACTION_projetView . '&projet=-1\'"'; ?>/>

            <div id="projects_list">
              <ul class="href_list">
                <?php
                  if (getListProjectActif() != null)
                    foreach(getListProjectActif() as $value) {
                      if ($projectSelected->getId() != $value->getId()) {
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_projetEdit . '&action=' . $ACTION_projetView . '&projet=' . $value->getId() . '">' . $value->getNom() . '</a></li>';
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