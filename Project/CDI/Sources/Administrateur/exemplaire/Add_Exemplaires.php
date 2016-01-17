<?php /*
********* PROJET CDI **********

*******ADD-EXEMPLAIRE********

Description :Formulaire d'ajout d'exemplaire 
Contient une page PHP qui récupère dynamiquement les données 
(CF Search.php)

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class="Media" method="post" action="?admin=exemplaire&action=ajouter">
<h3> Ajout d'exemplaire </h3>
	 <?php include('Exemplaires/Search.php'); ?>
	 
<label for="Date d'acquisition">Date d'acquisition : </label><input type="text" name="dacqui" class='InputText'/> <br /> <br />
	<label for="Prix :">Prix :  </label><input type="text" name="prix" class='InputText'/> <br />  <br />
	<label for="Etat">Etat  :  </label><input type="text" name="etat" class='InputText'/> <br />  <br />
	<label for="Reference">Reference Exemplaire  :  </label><input type="text" name="refE" class='InputText'/> <br />  <br />
	<label for="Disponible">Disponible :  </label><input type="checkbox" name="dispo" /> <br />  <br />
	<input type="submit" value="Enregistrer"/> 
</form> 