<?php /*

********* PROJET CDI **********

TRAITEMENT DEL EXEMPLAIRE

Description : Ce fichier va traiter les données du formulaire 'Del médias' 
C'est lui qui se chargera d'associer les élèments de l'IHM aux différents ID's 
De plus, il effectue les différentes requêtes 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/

if(isset($_POST["Ref"]))
{
	$ref = $_POST["Ref"];	
	
	if ($ref != '')
	{
	$reqDelExemplaire = $bdd->prepare('DELETE FROM exemplaires WHERE num_exemplaire = :IDM ;');
	$reqDelExemplaire->execute(array('IDM' => $ref));
	
	header('Location: ?admin=media&message=2');
	}
	else
	{
		$page['erreur'] = "L'exemplaire recherché n'exsiste pas ";
	}
}

 