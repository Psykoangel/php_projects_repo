<?php 

if (isset($_POST['titreC']))
{
	$emprunt_media = (isset($_POST['empruntC'])) ? true : false;

	try 
	{
		$img = $_FILES["img"];
		move_uploaded_file($img['tmp_name'],'Ressources/images/tmp'.$img['name']);
		require('Classes/Img.php');
		IMG::creerMin('Ressources/images/tmp'.$img['name'],"Ressources/images/miniatures", $img['name'], 260,180);
		IMG::creerMin('Ressources/images/tmp'.$img['name'],"Ressources/images", $img['name'], 800,600);
		unlink('Ressources/images/tmp'.$img['name']);
		if (substr($img['name'], -3) == 'png') {
			$img['name'] = str_replace('png', 'jpg', $img['name']);
			
		}
		echo substr($img['name'], 0, -3);
		$reqUpdateMediaPure = $bdd->prepare('UPDATE medias SET titre_media=:titre_media, isbn_media=:isbn_media, resume_media=:resume_media, nom_image=:nom_image, empruntable_media=:empruntable_media WHERE id_media = :ID_media;');
		$reqUpdateMediaPure->execute(array(
			'titre_media' => Securite::bdd($_POST ['titreC']), 
			'isbn_media' => Securite::bdd($_POST ['isbnC']), 
			'resume_media' => Securite::bdd($_POST ['resumeMediaC']), 
			'nom_image' =>($img['name']), 
			'empruntable_media' => Securite::bdd($emprunt_media), 
			'ID_media' => Securite::bdd($_POST['IDC'])));
		header("Location: ?admin=media&message=1");
	}
	catch ( exception $e)
	{
		$page['erreur'] = 'Problème !';
	}
}

if (isset($_POST['titre']))
{
	
	$titre_media = $_POST["titre"];
	
	$reqRecupIDMedia = $bdd->prepare('SELECT id_media FROM medias WHERE titre_media= :media');
	$reqRecupIDMedia->execute(array('media' => $titre_media));
	$donnees = $reqRecupIDMedia->fetch(PDO::FETCH_ASSOC);
	$IDMedia = $donnees['id_media']; // Contient l'ID 
	
	if ($IDMedia != '')
	{
		$reqRecupDelMedia = $bdd->prepare('SELECT * FROM medias WHERE titre_media= :media');
		$reqRecupDelMedia->execute(array('media' =>$titre_media))or die(print_r($reqRecupDelMedia->errorInfo()));
		
		$page['medias'] = array();
		while ($donnees = $reqRecupDelMedia->fetch())
		{
			$nouveau = array();
			$nouveau['titre'] =  Securite::html($donnees['titre_media']);
			$nouveau['isbn'] = Securite::html($donnees['isbn_media']);
			$nouveau['resume'] = Securite::html($donnees['resume_media']);
			$nouveau['emprunt'] = Securite::html($donnees['empruntable_media']);
			$nouveau['image'] = Securite::html($donnees['nom_image']);
			$nouveau['id_type'] = Securite::html($donnees['id_type']);
			$nouveau['id_categorie'] = Securite::html($donnees['id_categorie']);
			$nouveau['id_admin'] = Securite::html($donnees['id_admin']);
			$nouveau['id'] = Securite::html($donnees['id_media']);
			array_push($page['medias'], $nouveau);
		}
	}
	else {
		$page['erreur'] = "Ce media n'existe pas !";
	}
		
}