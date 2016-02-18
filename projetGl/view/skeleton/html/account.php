<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/account.css' ?>"/>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/menu.css' ?>"/>
  <body>
    <div class="account_page">
         <div id="account_box">

          <div id="menu_box">
            <ul id="menu">
              <li class="single_line"><a href="">Actualite</a></li>
              <li><a href="<?php echo './index.php?cursor=' . $CURSOR_tableau; ?>">Tableau de bord</a></li>
              <li class="single_line">
                <a href="">Listes</a>
                <ul>
                  <li><a href="">Projets</a></li>
                  <?php
                  echo '<li><a href="./index.php?cursor=' . $CURSOR_clientView . '&action=' . $ACTION_clientView . '&client=-1">Clients</a></li>';
                  ?>
                  <li><a href="">Collaborateurs</a></li>
                </ul>
              </li>
              <li class="single_line"><a href="<?php echo './index.php?cursor=' . $CURSOR_research; ?>">Recherche</a></li>
              <li class="selected"><a href="<?php echo './index.php?cursor=' . $CURSOR_compteView; ?>">Mon Compte</a></li>
              <li class="single_line"><a href="<?php echo './index.php?action=' . $ACTION_logOut; ?>">Quitter</a></li>
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

            <div id="title_account">Mon Compte</div>

            <div id="password_label">Nouveau mot de passe :</div>
            <input id="password_field" type="password" value="<?php echo $_SESSION["user"]->getPassword(); ?>" maxlength="20"/>
            <div id="adress_label">Adresse :</div>
            <input id="adress_field" type="text" value="<?php echo $personneAccount->getAdresse(); ?>" maxlength="40"/>
            <div id="tel_label">Telephone :</div>
            <input id="tel_field" type="text" value="<?php echo $personneAccount->getTelephone(); ?>" maxlength="15"/>
            <div id="email_label">Email :</div>
            <input id="email_field" type="text" value="<?php echo $personneAccount->getMail(); ?>" maxlength="40"/>
           
            <div id="title_settings">Parametres</div>

            <div id="group_setting_one">
              <input id="checkbox_setting_one" type="checkbox"/>
              <div id="label_setting_one">Recevoir les notifications par email</div>
            </div>
            <div id="group_setting_two">
              <input id="checkbox_setting_two" type="checkbox" checked="checked"/>
              <div id="label_setting_two">Recevoir les notifications via le systeme</div>
            </div>

            <div id="group_default_user_type">
              <div id="label_default_user_type">Role par defaut :</div>
              <select id="select_default_user_type" >
                <option selected="selected">Collaborateur</option>
                <option>Responsable de Projet</option>
                <option>Administrateur</option>
              </select>
            </div>

            <input id="btn_cancel" type="button" value="Annuler" onClick="alert('Bouton de annuler');"/>
            <input id="btn_save" type="button" value="Sauvegarder" onClick="alert('Bouton de sauvegarde');"/>  

          </div>

         </div>  
    </div>
  </body>
</html>