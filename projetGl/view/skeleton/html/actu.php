<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/actu.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/actu.js' ?>"></script>
  <script type="text/javascript">
    function changeRole(element)
    {
      var idx=element.selectedIndex;
      var val=element.options[idx].value;
      var strPos = "<?php echo './index.php?cursor=' . $CURSOR_actu . '&action=' . $ACTION_changeRole . '&role='; ?>";
      strPos = strPos + "" + val;
      
      window.location.assign(strPos);
    }    
  </script>
  <body onload="loadNbAlerts();">
    <div class="actu_page">
         <div id="actu_box">

          <div id="menu_box">
            <ul id="menu">
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li class="single_line selected"><a href="./index.php?cursor=' . $CURSOR_actu . '">Actualite</a></li>'; ?>
              <?php if ($_SESSION["systemData"]->getUserRole() != 2) echo'<li><a href="./index.php?cursor=' . $CURSOR_tableau . '">Tableau de bord</a></li>'; ?>
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

            <div id="title_box">Actualité</div>

            <input id="search_field" type="text" value="Rechercher" onblur="resetField();" onclick="emptyField();" oninput="search();"/>

            <div id="div_actu_alerts">
              <ul class="alerts_list">
                <input type="hidden" id="alert_state" value="showed">
                <li onclick="hideShowAlerts();" class="alert_title">&nbsp;&nbsp;&nbsp;Alertes (<span id="nb_alerts">-</span>)</li>
                <li onclick="" class="alert_field"><input type="button" class="btn_field" onclick="deleteAlert();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retard Tâche 2.3, Projet Azure (02/01/2016)</li>
                <li onclick="" class="alert_field"><input type="button" class="btn_field" onclick="deleteAlert();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Retard Tâche 3.1, Projet Azure (27/01/2016)</li>

                <input type="hidden" id="task_alert_state" value="showed">
                <li onclick="hideShowTaskAlerts();" class="task_alert_title">&nbsp;&nbsp;&nbsp;Tâches (<span id="nb_task_alerts">-</span>)</li>
                <li onclick="" class="task_alert_field"><input type="button" class="btn_field" onclick="deleteAlert();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Modification Tâche 1.1, Projet Azure (fin : 12/03/2016 - av : 30%)</li>

                <input type="hidden" id="project_alert_state" value="showed">
                <li onclick="hideShowProjectAlerts();" class="project_alert_title">&nbsp;&nbsp;&nbsp;Projets (<span id="nb_project_alerts">-</span>)</li>
                <li onclick="" class="project_alert_field"><input type="button" class="btn_field" onclick="deleteAlert();"/>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Clôture Projet Lunar (11/11/2014)</li>
              </ul>
            </div>

          </div>

         </div>  
    </div>
  </body>
</html>