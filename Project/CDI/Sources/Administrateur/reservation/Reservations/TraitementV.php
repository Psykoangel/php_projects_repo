<?php

 if(isset($_POST['IDR']))
 {
	$ValidResa = $bdd->prepare('UPDATE reservations SET id_etat= 2 WHERE id_reservation= :IDR');
	$ValidResa->execute(array("IDR"=> $_POST['IDR']));
	$reqDispo = $bdd->prepare('UPDATE exemplaires SET dispo_exemplaire=false WHERE num_exemplaire = :IDE');
	for ($i=1; $i<4; $i++)
	{
		
		echo $i;
		if (isset($_POST['Ex'.$i.''])) 
		{
			$reqDispo->execute(array("IDE"=> Securite::bdd($_POST['Ex'.$i.''])));
		}
	}
	header('Location: ?admin=media&message=4');
}

