<?php if(isset($page['erreur'])) { ?>
	<div class="message_erreur">
		<?php echo $page['erreur']; ?>
	</div>
<?php } if(isset($page['info'])) { ?>
	<div class="message_info">
		<?php echo $page['info']; ?>
	</div>
<?php } else {?>
	<form method="post" action="?admin=inscription">
	
		<label class="label" for="pseudo">Pseudo :</label> 
			<input type="text" id="pseudo" name="pseudo" 
			value="<?php echo $page['value Pseudo']; ?>"/><br/>
			
		<label class="label" for="nom">Nom :</label> 
			<input type="text" id="nom" name="nom" 
			value="<?php echo $page['value Nom']; ?>"/><br/>
			
		<label class="label" for="passe">Mot de passe :</label> 
			<input type="password" id="passe" name="passe"			
			value="<?php echo $page['value Passe']; ?>"/><br/>
			
		<label class="label" for="confirmation">Confirmez-le : </label>
			<input type="password" id="confirmation" name="confirmation" 
			value="<?php echo $page['value Confirmation']; ?>"/><br/>
			
		<label class="label" for="mail">Adresse e-mail : </label>
			<input type="text" id="mail" name="mail" 
			value="<?php echo $page['value Mail']; ?>"/><br/>
			
		<input type="submit" value="Envoyer"/><br/>
	</form>
<?php } ?>

