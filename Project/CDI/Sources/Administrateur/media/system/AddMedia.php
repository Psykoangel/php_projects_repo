<?php 
/*
********* PROJET CDI **********

******TRAITEMENT ADD MEDIAS*****

Description : Ce fichier va traiter les données du formulaire 'Ajout de médias' 
C'est lui qui se chargera d'associer les élèments de l'IHM aux différents ID's 
De plus, il effectue les différentes requêtes 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 
*/ 

	 
if (isset($_POST["titre"], $_POST["isbn"], $_POST["resumeMedia"], $_POST["Categorie"], $_POST["Type"], $_POST["auteurs"]) && !empty($_POST["titre"]))
{
	// On commence par stocker les variables qui serront envoyé dirrectement dans la BDD
	$titre_media = Securite::bdd($_POST["titre"]);
	$isbn_media = Securite::bdd($_POST["isbn"]);
	$resume_media = Securite::bdd($_POST["resumeMedia"]);
	$img = $_FILES["img"];	
	if (!empty($img['name'])) {
		move_uploaded_file($img['tmp_name'],'Ressources/images/tmp'.$img['name']);
		require('Classes/Img.php');
		IMG::creerMin('Ressources/images/tmp'.$img['name'],"Ressources/images/miniatures", $img['name'], 260,180);
		IMG::creerMin('Ressources/images/tmp'.$img['name'],"Ressources/images", $img['name'], 800,600);
		unlink('Ressources/images/tmp'.$img['name']);
		if (substr($img['name'], -3) == 'png') {
			$img['name'] = str_replace('png', 'jpg', $img['name']);
			
		}
		$nom_image = $img['name'];
	} else {
		$nom_image = 'no_image.jpg';
	}
	
	// Ce premier switch va regarder le choix de l'user et définiera la variable categorie_media en fonction du choix textuel envoyé par le formulaire
	switch($_POST["Categorie"]) 
	{
		case 'Architecture des MI' :
				$categorie_media = 1;
				break;
		case'Langage C' :
				$categorie_media = 2;
				break;
		case'Langage C #' :
				$categorie_media = 3;
				break;
		case'Langage C ++' :
				$categorie_media = 4;
				break;
		case'Reseau' :
				$categorie_media = 5;
				break;
		case'Logiciel' :
				$categorie_media = 6;
				break;
		default :
				$categorie_media = 7;
				break;
	}
	
	// Ce second switch fait de même pour les types. La manière est identique
	
	switch($_POST["Type"])
	{
		case'Livre' :
			$id_type = 1;
			break;
		case'CD/DVD' :
			$id_type = 2;
			break;
		case'Magasine' : 
			$id_type = 3;
			break;
		default :
			$id_type = 4;
			break;
	}
	// Ce isset va regarder si l'user à cocher l'emprunt. Si il l'a cocher, le bool est juste. Si il ne l'a pas coché 
	// la variable de type POST n'exsiste pas et le bool sera faux. 
		if (isset($_POST['emprunt']))
		{
			$emprunt_media = true;
		}
		else 
		{
			$emprunt_media = false;
		}	
	
		
		// Avec le try...catch, on execute la requête. Si une erreur se produit, l'user est redirigé vers le formulaire au bout de 3 secondes. 
		try
		{
			// On prépare la requête SQL qui va ajouter les informations UNIQUEMENT DANS LA TABLE MEDIA !!!
			$reqAjouterMediaPure = $bdd->prepare('INSERT INTO medias (id_categorie, id_type, id_admin, titre_media, isbn_media, resume_media, nom_image, empruntable_media)
			VALUES (:id_cat,:id_type,:id_admin,:titre_media,:isbn_media,:resume_media, :nom_image, :empruntable_media);');
			
			$reqAjouterMediaPure->execute(array( 'id_cat' => $categorie_media, 'id_type' => $id_type, 'id_admin' => $visiteur['id'], 'titre_media' => $titre_media, 'isbn_media' => $isbn_media, 'resume_media' => $resume_media, 'nom_image'=>$nom_image, 'empruntable_media' => $emprunt_media));
			$reqRecupIDMedia = $bdd->prepare('SELECT MAX(id_media) FROM medias');
			$reqRecupIDMedia->execute();
			$donnees = $reqRecupIDMedia->fetch(PDO::FETCH_ASSOC);
			$IDMedia = $donnees['MAX(id_media)'];
			print_r ($IDMedia);
		}
		catch (exception $e)
		{
			$page['erreur'] = 'Problème de requête, redirection en cours ...';
		}
		
		if(!isset($page['erreur']))
		{
		// Récupération des données de l'auteur
		$auteur=$_POST['auteurs'];
		
		$reqVerifID = $bdd->prepare('SELECT id_auteur FROM auteurs WHERE nom_auteur = :nom_auteur');
		$reqVerifID->execute(array('nom_auteur' => $auteur));
		$donnees = $reqVerifID->fetch(PDO::FETCH_ASSOC);
		$IDAuteur = $donnees['id_auteur'];
		
		if (isset($IDAuteur))
		{
			$requAjouterAuteurMedia = $bdd->prepare('INSERT INTO ecrire (id_media,id_auteur) VALUES (:media,:auteur);');
			$requAjouterAuteurMedia->execute(array('media' => $IDMedia, 'auteur' => $IDAuteur ));
		}
		else 
		{
			$requAjouterAuteur = $bdd->prepare('INSERT INTO auteurs (nom_auteur) VALUES (:auteurN);');
			$requAjouterAuteur->execute(array('auteurN' => $auteur));
			$reqRecupIDAuteur = $bdd->prepare('SELECT id_auteur FROM auteurs WHERE nom_auteur= :auteurN');
			$reqRecupIDAuteur->execute(array('auteurN' => $auteur));
			$donneesBis = $reqRecupIDAuteur->fetch(PDO::FETCH_ASSOC);
			$IDAuteur = $donneesBis['id_auteur'];
			
			$requAjouterAuteurMedia = $bdd->prepare('INSERT INTO ecrire (id_media,id_auteur) VALUES (:media,:auteur);');
			$requAjouterAuteurMedia->execute(array('media' => $IDMedia, 'auteur' => $IDAuteur ));
		}
		//****************************************************************************************************************************************************************************************************************************
		// Récupération des données de l'éditeur
		$Editeur=$_POST['editeurs'];
		
		$reqVerifIDE = $bdd->prepare('SELECT id_editeur FROM editeurs WHERE nom_editeur = :nom_editeur');
		$reqVerifIDE->execute(array('nom_editeur' => $Editeur));
		$donnees = $reqVerifIDE->fetch(PDO::FETCH_ASSOC);
		$IDEditeur = $donnees['id_editeur'];
		
		if (isset($IDEditeur))
		{
			$requAjouterEditeurMedia = $bdd->prepare('INSERT INTO publier (id_media,id_editeur) VALUES (:media,:editeur);');
			$requAjouterEditeurMedia->execute(array('media' => $IDMedia, 'editeur' => $IDEditeur ));
		}
		else 
		{
			$requAjouterEditeur = $bdd->prepare('INSERT INTO editeurs (nom_editeur) VALUES (:editeurN);');
			$requAjouterEditeur->execute(array('editeurN' => $Editeur));
			$reqRecupIDEditeur = $bdd->prepare('SELECT id_editeur FROM editeurs WHERE nom_editeur= :editeurN');
			$reqRecupIDEditeur->execute(array('editeurN' => $Editeur));
			$donneesBis = $reqRecupIDEditeur->fetch(PDO::FETCH_ASSOC);
			$IDEditeur = $donneesBis['id_editeur'];
			
			$requAjouterEditeurMedia = $bdd->prepare('INSERT INTO publier (id_media,id_editeur) VALUES (:media,:editeur);');
			$requAjouterEditeurMedia->execute(array('media' => $IDMedia, 'editeur' => $IDEditeur ));
		}
		
		$page['info'] =  ' Ajout du média enregistré avec succès. Redirection. ';
		
		$_SESSION['ID_MEDIA']= $IDMedia;
		header(" Refresh: 3; URL='../Add_Exemplaires.php' ");
		}
		}
	