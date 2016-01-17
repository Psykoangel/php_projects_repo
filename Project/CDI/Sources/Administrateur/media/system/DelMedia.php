<?php
/*
********* PROJET CDI **********

******TRAITEMENT DEL MEDIAS*****

Description : Ce fichier va traiter les données du formulaire 'Del médias' 
C'est lui qui se chargera d'associer les élèments de l'IHM aux différents ID's 
De plus, il effectue les différentes requêtes 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 
*/

if(isset($_POST["titre"]))
{
	$titre_media = Securite::bdd($_POST["titre"]);
	
	$reqRecupDelMedia = $bdd->prepare('SELECT id_media FROM medias WHERE titre_media= :media');
	$reqRecupDelMedia->execute(array('media' => $titre_media));
	$donnees = $reqRecupDelMedia->fetch(PDO::FETCH_ASSOC);
	$IDMedia = $donnees['id_media']; // Contient l'ID 
	
	print_r ($IDMedia);
	
	if ($IDMedia != '')
	{
		$reqDelMediaAuteur = $bdd->prepare('DELETE FROM ecrire WHERE id_media = :IDM ;');
		$reqDelMediaAuteur->execute(array('IDM' => $IDMedia));
		
		$reqDelMediaEditeur= $bdd->prepare('DELETE FROM publier WHERE id_media = :IDM ;');
		$reqDelMediaEditeur->execute(array('IDM' => $IDMedia));
		
		$reqDelExem = $bdd->prepare('DELETE FROM exemplaires WHERE id_media = :IDM ;');
		$reqDelExem->execute(array('IDM' => $IDMedia));
		
		$reqDelMedia = $bdd->prepare('DELETE FROM medias WHERE id_media = :IDM ;');
		$reqDelMedia->execute(array('IDM' => $IDMedia));
	
		header("Location: ?admin=media&message=2");
	}
	else
	{
		$page['erreur'] = "Le média recherché n'existe pas ";
	}
}

