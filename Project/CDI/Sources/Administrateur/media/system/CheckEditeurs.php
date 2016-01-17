<?php
/*
********* PROJET CDI **********

****** CHECK EDITEURS *******

Description :Cette page verifie si l'editeur exsiste dans la BDD
Si oui, il retourne un ID a ajouté par l'user 

EN ATTENTE DE TEST 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 
*/


	// Préparation de la requête 
	$requeteEditeurs = $bdd->prepare("SELECT id_editeur, nom_editeur FROM editeurs");
	$requeteEditeurs->execute();
	// Initialisation du tableau qui contiendra la table auteur
	$tableauEditeurs = array();
	
	// On récupère la table auteur et on va inverser les colones. La clé va être nom_auteur et id_auteur en sera le résultat.
	// Grace à fetch_assoc, on ne récupère que l'essentiel 
	while ($resultatEditeurs = $requeteEditeurs->fetch(PDO::FETCH_ASSOC))
	{
		$tableauEditeurs[$resultatEditeurs["nom_editeur"]] = $resultatEditeurs['id_editeur'];
	}
	
	// On transpose le tableau pour qu'il soit comprhénsible en JS grace à un foreach 	
	$stringTabEditeurs = '';
	$iEditeurs = 0;
	foreach($tableauEditeurs as $idEditeurs => $nomEditeurs)
	{
		if($iEditeurs!= 0) $stringTabEditeurs .= ",";
		$stringTabEditeurs .= "\"". $idEditeurs ."\":\"".  $nomEditeurs. "\"";
		$iEditeurs++;
	}
	
	// A partir d'ici, le PHP va génèrer du JavaScript. Dans un premier temps, on va récupèrer le tableau associatif et ensuite, on compare si le nom 
	//saisie par l'user est trouvé dans le tableau, qui est, je le rappel, une copie de la table auteur. 	
	$data['liensJS']->addScript("
	
	function VerifyEditeurs(idayEditeurs)
{
	var tableauEditeurs = {". $stringTabEditeurs ."};
	var nomEditeurs = idayEditeurs.value;
	for(cleEditeurs  in tableauEditeurs)
	{
		if ( nomEditeurs == cleEditeurs )
		{
			alert(' L\'éditeur a déjà été inscrit dans la base de donnée.  \\n Son ID est ' + tableauEditeurs[nomEditeurs] + '  \\n Merci de le renseigner dans le champ ');
		}
		
	}
}");

