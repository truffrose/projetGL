<html>
  <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/tableau_collabo.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <script type="text/javascript" src="<?php echo $path . 'import/script/tableau_collabo.js' ?>"></script>
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
              <li class="single_line"><a href="">Actualite</a></li>
              <li class="selected"><a href="<?php echo './index.php?cursor=' . $CURSOR_tableau; ?>">Tableau de bord</a></li>
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
              <option>Projet Azurre</option>
              <option>Spartacus</option>
            </select>
          </div>

          <div id="main_box">

            <div id="title_account">Tableau de bord</div>

            <table id="main_table">  
              <tr class="tr_0">
                <th class="th1">Tâche</th>
                <th class="th2">Projet</th>
                <th class="th3">Avancement</th>
                <th class="th4">Date de fin</th>
              </tr>   
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr> 
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>   
              <tr class="tr_1"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">20 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>
              <tr class="tr_2"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">90 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>
               <tr class="tr_2"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">90 %</td>
                <td class="td4">10/11/2015</td> 
              </tr> 
               <tr class="tr_2"> 
                <td class="td1"><a href="">Tâche 1.1</a></td> 
                <td class="td2"><a href="">Projet Azure</a></td> 
                <td class="td3">90 %</td>
                <td class="td4">10/11/2015</td> 
              </tr>              
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