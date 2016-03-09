<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/tableau_respo.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/tableau_respo.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_tableau . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      window.location.assign(strPos);
    }    
  </script>
  <body onload="showNbPage();">
    <div class="account_page">
         <div id="account_box">

          <div id="menu_box">
            <ul id="menu">
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li class="single_line"><a href="./index.php?cursor=' . $CURSOR_actu . '">Actualite</a></li>'; ?>
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li class="selected"><a href="./index.php?cursor=' . $CURSOR_tableau . '">Tableau de bord</a></li>'; ?>
              <li class="single_line">
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
                foreach (getRoleIdNameByIdUser($_SESSION["user"]->getPersonne()->getId()) as $value) {
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

          <div id="filter_box">
            <div id="filter_one">Trier par : </div>
            <select id="filter_one_select">
              <option selected="selected">Avancement</option>
              <option>Date de fin</option>
              <option>Criticité</option>
            </select>
            <div id="filter_two">Afficher le(s) projet(s) suivant(s) : </div>
            <select id="filter_two_select">
              <option selected="selected">Tous les projets</option>
              <?php
              if (getListProjectActifRespo($_SESSION["user"]->getPersonne()->getId()) != null) {
                foreach(getListProjectActifRespo($_SESSION["user"]->getPersonne()->getId()) as $value) {
                  echo '<option>'.$value->getNom().'</option>';
                }
              }
              ?>
            </select>
            <div id="filter_three">Mode d'affichage : </div>
            <select id="filter_three_select" onchange="changeTable();">
              <option selected="selected">Projets</option>
              <option>Tâches</option>
            </select>
          </div>

          <div id="main_box">

            <div id="title_account">Tableau de bord</div>

            <table id="task_table">  
              <tr class="tr_0">
                <th class="th1">Tâche</th>
                <th class="th2">Projet</th>
                <th class="th3">Avancement</th>
                <th class="th4">Date de fin</th>
              </tr>
              <?php
                if (getListTacheRespo($_SESSION["user"]->getPersonne()->getId()) != null)
                  foreach(getListTacheRespo($_SESSION["user"]->getPersonne()->getId()) as $value) {
                    echo '<tr class="tr_1">';
                      echo '<td class="td1"><a href="./index.php?cursor=' . $CURSOR_tacheView . '&action=' . $ACTION_tacheView . '&tache=' . $value->getId() . '">'.$value->getNom().'</a></td>';
                      echo '<td class="td2"><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value->getProjet()->getId() . '">'.$value->getProjet()->getNom().'</a></td>';
                      echo '<td class="td3">'.$value->getAvancement().' %</td>';
                      echo '<td class="td4">'.$value->getDateFinTot().'</td>';
                    echo '</tr>';
                  }
              ?>
            </table>

            <table id="project_table">
              <tr class="tr_0">
                <th class="th1">Projet</th>
                <th class="th2">Avancement</th>
                <th class="th3">Date de fin</th>
              </tr>
              <?php
                if (getListProjectActifRespo($_SESSION["user"]->getPersonne()->getId()) != null)
                  foreach(getListProjectActifRespo($_SESSION["user"]->getPersonne()->getId()) as $value) {
                    echo '<tr class="tr_1"> ';
                      echo '<td class="td1"><a href="./index.php?cursor=' . $CURSOR_projetView . '&action=' . $ACTION_projetView . '&projet=' . $value->getId() . '">'.$value->getNom().'</a></td>';
                      echo '<td class="td2">'.$value->getAvancement().' %</td>';
                      echo '<td class="td3"></td>';
                    echo '</tr>';
                  }
              ?>
            </table>

            <div id="div_btns">
               <input id="btn_previous" type="button" value="<<" onClick="previous();"/>
              <input id="btn_actual" type="button" value="1"/>
              <input id="btn_next" type="button" value=">>" onClick="next();"/>
            </div>

          </div>

         </div>  
    </div>
  </body>
</html>