<?php
/*
******** PROJET CDI *********

****** CHECK AUTEURS ********

Description :Cette page verifie si l'auteur existe dans la BDD
Si oui, il retourne un ID a ajouté par l'user 

EN ATTENTE DE TEST 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 
*/


	// Préparation de la requête 
	$requete = $bdd->prepare("SELECT id_auteur, nom_auteur FROM auteurs");
	$requete->execute();
	// Initialisation du tableau qui contiendra la table auteur
	$tableau = array();
	
	// On récupère la table auteur et on va inverser les colones. La clé va être nom_auteur et id_auteur en sera le résultat.
	// Grace à fetch_assoc, on ne récupère que l'essentiel 
	while ($resultat = $requete->fetch(PDO::FETCH_ASSOC))
	{
		$tableau[$resultat["nom_auteur"]] = $resultat['id_auteur'];
	}
	
	// On transpose le tableau pour qu'il soit comprhénsible en JS grace à un foreach 	
	$stringTab = '';
	$i = 0;
	foreach($tableau as $id => $nom)
	{
		if($i != 0) $stringTab .= ",";
		$stringTab .= "\"". $id ."\":\"".  $nom. "\"";
		$i++;
	}
	
	// A partir d'ici, le PHP va génèrer du JavaScript. Dans un premier temps, on va récupèrer le tableau associatif et ensuite, on compare si le nom 
	//saisie par l'user est trouvé dans le tableau, qui est, je le rappelle, une copie de la table auteur. 	
	$data['liensJS']->addScript("
	
	function VerifyAuteur(iday)
{
	var tableau = {". $stringTab ."};
	var nom = iday.value;
	for(cle in tableau)
	{
		if ( nom == cle)
		{
			alert(tableau[nom]);
			iday.setAttribute('value',tableau[nom]);
		}
		
	}
}
");
