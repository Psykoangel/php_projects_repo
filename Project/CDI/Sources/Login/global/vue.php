<html>
<head>
	<title> Logiciel de gestion CDI - Exia Cesi </title>
	<link rel="stylesheet" type="text/css" href="<?php echo $path['ressources']; ?>login/style.css" media="screen" />
	<link rel="stylesheet" type="text/css" href="<?php echo $path['ressources']; ?>messages/style.css" media="screen" />
</head>
<body>
	<header>
		<img src="<?php echo $path['ressources']; ?>login/logo.png" >
		<br /> <br /> 
		<h1> Logiciel de gestion CDI </h1>
	</header>
	<form name="Connexion" method="POST" action="?login&amp;connexion" id="connexion">
		<?php if(!$data['session']) { if(isset($data['erreur'])) { ?> <!-- Infos -->

			<div class="message_erreur"><?php echo $data['erreur']; ?></div>

		<?php } else if(isset($data['info'])) { ?><!-- Erreurs -->
	
			<div class="message_info"><?php echo $data['info']; ?></div>
			
		<?php } ?><!-- Formulaire de connexion -->

		Login : <input type="text" name="pseudo" class="input_connex"/> <br />
		Mot de passe : <input type="password" name="passe" class="input_connex" /> <br />
		Persistant :  <input type="checkbox" name="cookie" class="input_connex" style="margin-right:128px"/> <br />  <br />
		<input type="submit" name="Valider" value="Connexion" id="btn_submit"/><br />
		</span></form><br /> <br />
		
		<?php } else { ?><!-- Connexion déjà active -->
	
			<div class="message_erreur">Vous êtes déjà connecté. <br/>
			<a href="?user">Accès utilisateur</a> / <a href="?admin">Administration</a></div>

		<?php } ?>
	</form>
	<span id="logo">
</body>
</html>