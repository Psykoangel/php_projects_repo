<?php /*

********* PROJET CDI **********

********* DEL MEDIA ***********

Description : Page PHP qui génère un formulaire HTML pour
supprimer un média dans la BDD. 
Page en PHP car il y'a des requires qui necessite traitement !

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class="Media" method=POST action="<?php echo $page['url']; ?>&amp;action=supprimer">
<h3> Suppression de média </h3>
	Titre Média : <input type="text" name="titre" /> <br />
	<input type="submit" value="Enregistrer">
</form>