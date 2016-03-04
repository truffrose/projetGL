<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/contact_delete_admin.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/search_field_methods.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_contactDelete . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body>
    <div class="contact_page">
         <div id="contact_box">
         
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
            <FORM method=post action="./">
              <div id="main_box_title">Suppression contact : </div>
              <div id="contact_name"><?php echo $selectContact->getPersonne()->getNom() . ' ' . $selectContact->getPersonne()->getPrenom(); ?></div>
  
              <div id="div_table">
  
                <div id="info_div">Si vous voulez que le nouveau contact d'une tâche soit le contact de la tache mère, choisir "Automatique".</div>
  
                <table id="title_table">
                  <tr>
                    <th class="th1">Projet</th>
                    <th class="th2">Tâche</th>
                    <th class="th3">Nouveau Contact</th>
                  </tr>    
                </table>
  
                <div id="div_table_contact"> 
              
                  <table id="contact_table">
                    <?php
                      // pas encore de connection pour voir la tache
                      $nbChange = 0;
                      if ($selectContact->tacheListeDelete() != null) {
                        foreach($selectContact->tacheListeDelete() as $value) {
                          echo '<tr><td class="td1"><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value["pid"] . '">' . $value["pnom"] . '</a></td>';
                          echo '<td class="td2"><a href="">' . $value["tnom"] . '</a></td> ';
                          echo '<input type="hidden"  name="tacheId' . $nbChange . '"  value="' . $value["tid"] . '">';
                          echo '<td class="td3"><select class="select_new_contact" name="select_new_contact' . $nbChange . '">';
                          foreach ($listeContact as $value) {
                            if ($idContact != $value->getPersonne()->getId()) {
                              echo '<option value="' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getNom() . ' ' . $value->getPersonne()->getPrenom() . '</option>';
                            }
                          }
                          echo '</select></td></tr>';
                          $nbChange ++;
                        }
                      }
                    ?>
                  </table>
  
                </div>
              </div>
              
			  <input type="hidden"  name="nbCahnge"  value="<?php echo $nbChange; ?>">
			  <input type="hidden"  name="action"  value="<?php echo $ACTION_contactDelete; ?>">
			  <input type="hidden"  name="deleteID"  value="<?php echo $selectContact->getPersonne()->getId(); ?>">
			  <input type="hidden"  name="client"  value="<?php echo $selectContact->getClient(); ?>">
			  <input type="hidden"  name="cursor"  value="<?php echo $CURSOR_clientView; ?>">
              

              <input id="cancel_btn" type="button" value="Annuler" onclick="window.location.href='<?php echo './index.php?cursor=' . $CURSOR_contactView . '&action=' . $ACTION_contactView . '&contact=' . $selectContact->getPersonne()->getId(); ?>'"/>
              <input id="delete_btn" type="submit" value="Supprimer"/>
          
            </FORM>
          </div>

          <div id="contacts_list_box">

            <input id="search_field" type="text" value="Rechercher" onblur="resetField('contacts_list');" onclick="emptyField('contacts_list');" oninput="search('contacts_list');"/>

            <div id="contacts_list_title"><?php echo $selectClient->getNom(); ?></div>

            <input id="new_contact_btn" type="button" value="Nouveau Contact"/>

            <div id="contacts_list">
              <ul class="href_list">
                <?php
                  if (isset($listeContact)) {
                    foreach ($listeContact as $value) {
                      if ($idContact != $value->getPersonne()->getId()) {
                        echo '<li><a href="./index.php?cursor=' . $CURSOR_contactDelete . '&action=' . $ACTION_contactView . '&contact=' . $value->getPersonne()->getId() . '">' . $value->getPersonne()->getPrenom() . ' ' . $value->getPersonne()->getNom() . '</a></li>';
                      }
                    }
                  }
                  else {
                    echo 'no contact';
                  }
                ?>
              </ul>
            </div> 

          </div>
 
        </div>  
    </div>
  </body>
</html>