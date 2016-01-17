<?php /*
********* PROJET CDI **********

****** DEL EXEMPLAIRES ******

Description : Page PHP qui génère un formulaire pour 
supprimer un exemplaire de la BDD 
Lien vers Search_M 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class="Media" method=POST action="?admin=exemplaire&amp;action=supprimer&amp;suite">
<h3> Suppression d'exemplaire </h3>
	 <?php include('Exemplaires/Search_M.php'); ?>
	<input type="submit" value="Enregistrer">
</form>