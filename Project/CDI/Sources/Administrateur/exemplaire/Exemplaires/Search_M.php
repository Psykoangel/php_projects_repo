<?php /*

********* PROJET CDI **********

**********SEARCH M*************

Description : Génération d'un SELECT assenceur qui regroupe
les différents titres MEDIA qui possède au moins
un exemplaire. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

 <label for="Titre_Media">Titre de l'exemplaire concerné :  </label><SELECT name="Titre_Media"class='InputText' > 

<?php 
 
	$reqSELECTM = $bdd->query("SELECT titre_media FROM medias WHERE id_media IN (SELECT id_media FROM exemplaires );");
	while($donneesM = $reqSELECTM->fetch(PDO::FETCH_ASSOC))
	{
	if ($donneesM['titre_media'] != ''){
	echo '<OPTION VALUE ="'.$donneesM['titre_media'].'">'.$donneesM['titre_media'].'</OPTION>'; }
	}
	
$reqSELECTM->closeCursor()
?> 

</SELECT> <br /> <br />