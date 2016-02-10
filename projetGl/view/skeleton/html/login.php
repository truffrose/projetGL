<html>
  <link type="text/css" rel="stylesheet" href="<?php echo $path . 'css/login.css'; ?>" />
  <body>
    <div class="login_page">
      <div id="login_Box">
          <div id="main_box"></div>
          <div id="title">Project Manager</div>
		  <FORM method=post action="./">
			  <input type="hidden"  name="action"  value="<?php echo $ACTION_logIn; ?>">
			  <input id="login" type="text" name="login" value="Login" maxlength="20"/>
			  <input id="password" type="password" name="password" value="Password" maxlength="20"/>
			  <input id="btn_connect" type="submit" value="Connexion"/>
		  </FORM>
          <div id="forget"><a href="url">Mot de passe oubli&eacute;</a></div>
      </div>  
    </div>
  </body>
</html>