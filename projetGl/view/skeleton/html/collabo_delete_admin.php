<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/collabo_delete_admin.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_collaboDelete . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="collabo_page">
         <div id="collabo_box">
         
          <div id="menu_box">
            <ul id="menu">
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
            <?php
              foreach($listeCollabo as $value) {
                if ($value->getId() == $idCollabo) {
                  $currentCollabo = $value;
                }
              }
            ?>
            
            <FORM method=post action="./">
              
  
              <div id="main_box_title">Suppression Collaborateur : </div>
              <div id="collabo_name"><?php echo $currentCollabo->getNom() . ' ' . $currentCollabo->getPrenom(); ?></div>
  
              <div id="div_table_project">
  
                <div id="info_div_project">Indiquez un nouveau responsable pour chaque projet.</div>
  
                <table id="title_table_project">
                  <tr>
                    <th class="th1">Projet</th>
                    <th class="th2">Nouveau Responsable</th>
                  </tr>    
                </table>
  
                <div id="div_table_collabo_project"> 
              
                  <table id="collabo_table_project">
                    <?php
                      $nbRespo = 0;
                      if ($currentCollabo->projetListeDelete() != null) {
                        foreach($currentCollabo->projetListeDelete() as $value) {
                          echo '<tr><td class="td1"><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value["pid"] . '">' . $value["pnom"] . '</a></td> ';
                          echo '<input type="hidden"  name="projetId' . $nbRespo . '"  value="' . $value["pid"] . '">';
                          echo '<td class="td2"><select class="select_new_collabo" name="select_new_respo' . $nbRespo . '">';
                          if ($currentCollabo->getListActiveUserByRole(3) != null)
                            foreach($currentCollabo->getListActiveUserByRole(3) as $pers) {
                              echo '<option value="' . $pers["id"] . '">' . $pers["nom"] . ' ' . $pers["prenom"] . '</option>';
                            }
                          echo '</select></td></tr>';
                          $nbRespo ++;
                        }
                      }
                    ?>
                  </table>
                </div>
              </div>
  
              <div id="div_table_task">
  
                <div id="info_div_task">Si vous voulez que le nouveau responsable d'une tâche soit le collaborateur de la tache mère, le choisir dans la liste.</div>
  
                <table id="title_table_task">
                  <tr>
                    <th class="th1">Projet</th>
                    <th class="th2">Tâche</th>
                    <th class="th3">Nouveau Responsable</th>
                  </tr>    
                </table>
  
                <div id="div_table_collabo_task"> 
              
                  <table id="collabo_table_task">
                      <?php
                      $nbCollabo = 0;
                      if ($currentCollabo->tacheListeDelete() != null) {
                        foreach($currentCollabo->tacheListeDelete() as $value) {
                          echo '<tr><td class="td1"><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value["pid"] . '">' . $value["pnom"] . '</a></td> ';
                          echo '<td class="td2"><a href="">' . $value["tnom"] . '</a></td>';
                          echo '<input type="hidden"  name="tacheId' . $nbCollabo . '"  value="' . $value["tid"] . '">';
                          echo '<td class="td3"><select class="select_new_collabo" name="select_new_collabo' . $nbCollabo . '">';
                          if ($currentCollabo->getListActiveUserByRole(4) != null)
                            foreach($currentCollabo->getListActiveUserByRole(4) as $pers) {
                              echo '<option value="' . $pers["id"] . '">' . $pers["nom"] . ' ' . $pers["prenom"] . '</option>';
                            }
                          echo '</select></td></tr>';
                          $nbCollabo ++;
                        }
                      }
                      ?>
                  </table>
                </div>
              </div>
  
			  <input type="hidden"  name="nbRespo"  value="<?php echo $nbRespo; ?>">
			  <input type="hidden"  name="nbCollabo"  value="<?php echo $nbCollabo; ?>">
			  <input type="hidden"  name="deleteID"  value="<?php echo $currentCollabo->getId(); ?>">
			  <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_collabo; ?>">
			  <input type="hidden"  name="action"  value="<?php echo $ACTION_collaboDelete; ?>">
              
  
              <input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_collabo . '&action=' . $ACTION_collaboView . '&collabo=' . $currentCollabo->getId(); ?>'"/>
              <input id="delete_btn" type="submit" value="Supprimer"/>
      
            </FORM>
  
          </div>

          <div id="collabos_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('collabos_list');" onclick="emptyField('collabos_list');" oninput="search('collabos_list');"/>

            <div id="collabos_list_title">Collaborateurs</div>

            <input id="new_collabo_btn" type="button" value="Nouveau Collaborateur"/>

            <div id="collabos_list">
              <ul class="href_list">
                <?php
                  foreach($listeCollabo as $value) {
                    if ($value->getId() != $idCollabo) {
                      echo '<li><a href="./index.php?cursor=' . $CURSOR_collaboDelete . '&action=' . $ACTION_collaboView . '&collabo=' . $value->getId() . '">' . $value->getNom() . ' ' . $value->getPrenom() . '</a></li>';
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