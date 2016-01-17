<?php /* 

********* PROJET CDI **********

TRAITEMENT DEL EXEMPLAIRE

Description : Ce fichier reçoit les informations des différents
formulaire auquel il est rattaché. Il les traitent et supprime les données 
dans la BDD. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/

if(isset($_POST['Titre_Media'], $_POST['dacqui'], $_POST['prix'], $_POST['etat'], $_POST['refE']))
{
	$titre_media = Securite::bdd($_POST['Titre_Media']);

	$dacqui = Securite::bdd($_POST['dacqui']);
	$prix = Securite::bdd($_POST['prix']);
	$rmq = Securite::bdd($_POST['etat']);
	$ID_E = Securite::bdd($_POST['refE']);
	 /*
	  * NEW 
	  * */

	$reqRecupID_Media = $bdd->prepare("SELECT id_media FROM Medias WHERE titre_media = :titre");
	$reqRecupID_Media->execute(array("titre" => $titre_media));
	$donnees = $reqRecupID_Media->fetch(PDO::FETCH_ASSOC);
	$IDMedia = $donnees['id_media']; // HERE ! ID MEDIA 

	 
	 if (isset($_POST['dispo']))
			{
				$dispo=true;
				echo ($dispo);
			}
			else 
			{
				$dispo=false;
				echo ($dispo);
			}
	 
	  
	 try {
	 
		$reqAddExe = $bdd->prepare('INSERT INTO exemplaires (num_exemplaire, id_media, id_admin, dacquisition_exemplaire, prix_exemplaire, rmq_exemplaire, dispo_exemplaire) VALUES (:ID_E, :ID_M, :ID_A, :date, :prix, :rmq, :dispo);');
		$reqAddExe->execute(array('ID_E' => $ID_E, 'ID_M' => $IDMedia, 'ID_A' => $visiteur['id'], 'date'=> $dacqui, 'prix' => $prix ,'rmq' => $rmq ,'dispo' => $dispo));
		$VerifReq = $bdd->prepare('SELECT MAX(id_media) FROM exemplaires');
		$VerifReq->execute();
		$ValReq = $VerifReq->fetch(PDO::FETCH_ASSOC);
		$IDMediaEx = $ValReq['MAX(id_media)'];

		if ( $IDMediaEx == $IDMedia)
		{
			header('Location: ?admin=media&message=3');
		}
		else 
		{
			$page['erreur'] = ' La requete n\'est pas passée. Redirection ... ';
		}
		}
		catch (exception $e)
		{
			$page['erreur'] = 'Marche pas';
		}
}

 