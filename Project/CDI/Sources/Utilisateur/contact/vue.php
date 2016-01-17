<div style="padding-left: 100px;">
	<h3>Contacter un administrateur</h3>
	<form action="?user=contact" method="POST" >
		<input type="text" name="nom" id="nom" placeholder="Votre nom ..." maxlength="16"/><br />
		<input type="text" name="prenom" id="prenom" placeholder="Votre prénom ..." maxlength="16"/><br />
		<input type="email" name="email" id="email" placeholder="Votre adresse e-mail ..." /><br />
		
		<textarea name="message" id="message" placeholder="Votre message ..." rows="10" cols="50"></textarea><br />
		
		<input type="submit" value="Envoyer" />
	</form>
</div>