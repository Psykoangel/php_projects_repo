<?php/* 

********* PROJET CDI **********

**********VALID RESA	**********

Description : Cette page récupère les 
reservations users pour les valider

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<h3> Demande de réservations </h3>
<?php 

	// On recherche les reservations non validées 
	$req = $bdd->prepare('SELECT * FROM reservations WHERE id_etat=1');
	$req->execute();
	// Génération des petites étiquettes (des divs)
	while ($donnees = $req->fetch(PDO::FETCH_ASSOC))
	{
		echo '<div class="blocR">'; // div qui contient l'ensemble de l'étiquete
		echo '<form class="form" method=POST action="?admin=reservation&amp;action=valider">';
		echo " <div class='titreR' > Réservation N° :  ".$donnees['id_reservation'].' </div> <br />'; // Div Titre 
		echo '<input type="hidden" name="IDR" value="'.$donnees["id_reservation"].'" />';
		// Avec l'ID admin, on récupère son nom pour l'afficher 
		$ID_Uti = $donnees['id_admin'];
		$reqUti = $bdd->prepare('SELECT nom_admin FROM administrateurs WHERE id_admin = :IDU');
		$reqUti->execute(array('IDU' => $ID_Uti));
		$nomUtiTB = $reqUti->fetch(PDO::FETCH_ASSOC);
		$nom_Uti = $nomUtiTB['nom_admin'];
		// Ouverture d'une div qui contient les éléments généraux de la table réservations
		echo '<div class="divR" >Utilisateur : '.Securite::html($nom_Uti).'<br />';
		echo' Date de début : '.$donnees['debut_reservation'].'<br />';
		echo 'Date de fin : '.$donnees['fin_reservation'].'</div><br />';
		$reqEx = $bdd->prepare('SELECT num_exemplaire FROM concerner WHERE id_reservation=:IDR');
		$reqEx->execute(array('IDR' => $donnees['id_reservation']));
		$compt = 0;
		// Ensuite, on va générer une mise en forme pour chaque exemplaire. On aura la div gauche qui contient
		// les infos sur le media (juste le titre) et a droite les infos de l'exemplaire précis. 
		// On utilise un compteur pour les input cachés 
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