<?php /*

********* PROJET CDI **********

TRAITEMENT MODIFY EXE...

Description : Ce fichier reçois les informations des
différents formulaire auquel il est rattaché et 
envoie des nouvelles données dans la BDD 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/

if (isset($_POST['prix'], $_POST['refE'], $_POST['etat'], $_POST['dacqui'])) {
	$refE = Securite::bdd($_POST['refE']);
	$prix = Securite::bdd($_POST['prix']);
	$etat = Securite::bdd($_POST['etat']);
	$date = Securite::bdd($_POST['dacqui']);

	$dispo = (isset($_POST['dispo']));
	
	try 
		{
			$reqUpdateExePure = $bdd->prepare('UPDATE exemplaires SET dacquisition_exemplaire=:date, prix_exemplaire=:prix,rmq_exemplaire=:etat, dispo_exemplaire=:dispo WHERE num_exemplaire=:refE ');
			$reqUpdateExePure->execute(array('date' => $date, 'prix' => $prix, 'etat' => $etat, 'dispo' =>$dispo, 'refE' =>$refE ))or die(print_r($reqUpdateExePure->errorInfo()));;
			header('Location: ?admin=media&message=1');
		}
		catch ( exception $e)
		{
			$page['erreur'] = ' Problème';
		}
}
