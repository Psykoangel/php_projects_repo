<?php /*

********* PROJET CDI **********

SEARCH 

Description :Generation d'un SELECT asscenceur qui 
affiche les différents médias

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<label for="Titre_Media">Titre du média concerné :  </label> <SELECT name="Titre_Media"class='InputText' >   

<?php 

	$reqSELECT = $bdd->query("SELECT titre_media FROM medias ");
	while($donnees = $reqSELECT->fetch(PDO::FETCH_ASSOC))
	{
		if ($donnees['titre_media'] != '')
		{
			echo '<OPTION VALUE ="'.$donnees['titre_media'].'">'.$donnees['titre_media'].'</OPTION>'; 
		}
	}
	
$reqSELECT->closeCursor();
?> 

</SELECT><br /> <br />