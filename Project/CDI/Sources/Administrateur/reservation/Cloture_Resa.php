<?php /* 

********* PROJET CDI **********

********** CLOTURE RESA**********

Description : 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<h3> Cloturation de Réservation</h3>
<?php 
	$req = $bdd->prepare('SELECT * FROM reservations WHERE id_etat=2');
	$req->execute();
	while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<div class="blocR">';
		echo '<form class="form" method=POST action="?admin=reservation&amp;action=cloturer">';
		echo " <div class='titreR' > Réservation N° :  ".$donnees['id_reservation'].' </div> <br />';
		echo '<input type="hidden" name="IDR" value="'.$donnees["id_reservation"].'" />';
		$ID_Uti = $donnees['id_admin'];
		$reqUti = $bdd->prepare('SELECT nom_admin FROM administrateurs WHERE id_admin = :IDU');
		$reqUti->execute(array('IDU' => $ID_Uti));
		$nomUtiTB = $reqUti->fetch(PDO::FETCH_ASSOC);
		$nom_Uti = $nomUtiTB['nom_admin'];
		echo '<div class="divR" >Utilisateur : '.Securite::html($nom_Uti).'<br />';
		echo' Date de début : '.$donnees['debut_reservation'].'<br />';
		echo 'Date de fin : '.$donnees['fin_reservation'].'</div><br />';
		$reqEx = $bdd->prepare('SELECT num_exemplaire FROM concerner WHERE id_reservation=:IDR');
		$reqEx->execute(array('IDR' => $donnees['id_reservation']));
		$compt = 0;
		echo ' <div class="Liste"><div class= "titreListe"> Liste des emprunts </div>  ';
		while ($donnees2 = $reqEx->fetch(PDO::FETCH_ASSOC))
		{
			$compt++;
			
			//echo ' Exemplaire '.$compt.': '.$donnees2['num_exemplaire'];
			echo '<br />';
			echo '<input type="hidden" name ="Ex'.$compt.'" value="'.$donnees2["num_exemplaire"].'"/>';
			$reqEx2 = $bdd->prepare('SELECT id_media, prix_exemplaire, rmq_exemplaire FROM exemplaires WHERE num_exemplaire=:IDE');
			$reqEx2->execute(array('IDE' => $donnees2['num_exemplaire']));
			$donnees3 = $reqEx2->fetch(PDO::FETCH_ASSOC);
			$ID_Media = $donnees3['id_media'];
			$reqMe = $bdd->prepare('SELECT titre_media FROM medias WHERE id_media=:IDM');
			$reqMe->execute(array('IDM' => $ID_Media));
			$donnees4 = $reqMe->fetch(PDO::FETCH_ASSOC);
			//echo ' Titre du média : ' .$donnees4['titre_media'].'<br />';
			echo '<div class="test"> <div class="InfoM">'.$donnees4['titre_media'].'</div> ';
			echo '<div class="InfoE"> Reference exemplaire :'.$donnees2['num_exemplaire'].' Prix :'.$donnees3['prix_exemplaire'].'<br /> Remarque :'.$donnees3['rmq_exemplaire'].'</div> </div>';
			
			
		}
		echo '</div>';
		echo ' <input type=submit value="Valider" class="SubmitRes"/>';
		echo '</form>';
		echo '</div>';
	}
		
		
?>