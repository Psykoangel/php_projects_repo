<?php /* 

********* PROJET CDI **********

**********TRAITEMENT C	**********

Description : Cette page cloture une réservation.
Elle passe l'état à 3, terminer_reservation à true
& remet tous les exemplaires de la reservations disponible

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

 */

 if(isset($_POST['IDR']))
 {
	$ValidResaC = $bdd->prepare('UPDATE reservations SET id_etat= 3, terminer_reservation=true WHERE id_reservation= :IDR');
	$ValidResaC->execute(array("IDR"=> Securite::bdd($_POST['IDR'])));
	$reqDispoC = $bdd->prepare('UPDATE exemplaires SET dispo_exemplaire=true WHERE num_exemplaire = :IDE');
	
	for ($i=1; $i<4; $i++)
	{
		if (isset($_POST['Ex'.$i.''])) 
		{
			$reqDispoC->execute(array("IDE"=> Securite::bdd($_POST['Ex'.$i.''])));
		}
	}
	header('Location: ?admin=media&message=5');
}

