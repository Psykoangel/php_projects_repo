<?php

	$data['namepage'] = "Inscription";
	
// -- Traitement des Donnees recues --

	if(isset($_POST['pseudo'], $_POST['passe'], $_POST['confirmation'], $_POST['mail'], $_POST['nom']))
	{
		// Gros paquet de vérifications de base --
		if(empty($_POST['pseudo']))
		{ 
			$page['erreur'] = "Pseudo non-spécifié !"; 
		}
		else if(empty($_POST['passe']))
		{ 
			$page['erreur'] = "Mot de passe non-spécifié !"; 
		}
		else if(empty($_POST['confirmation']))
		{ 
			$page['erreur'] = "Confirmation du mot de passe non-spécifiée !"; 
		}
		else if($_POST['passe'] != $_POST['confirmation'])
		{ 
			$page['erreur'] = "La confirmation du mot de passe ne correspond pas."; 
		}
		else if(empty($_POST['mail']))
		{ 
			$page['erreur'] = "Mail non-spécifié !"; 
		}
		else if(!preg_match("#^[a-zA-Z0-9\._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$#", $_POST['mail']))
		{ 
			$page['erreur'] = "Mail invalide. "; 
		}
		else if(strlen($_POST['pseudo']) > 20)
		{ 
			$page['erreur'] = "Pseudo trop long, il ne doit pas faire plus de 20 caractères."; 
		}
		else
		{
			// -- Verifications poussées --
			
			$formulaire = array();
			$formulaire['pseudo'] = Securite::bdd($_POST['pseudo']); 
			$mot_de_passe = Securite::bdd($_POST['passe']);
			$formulaire['passe'] = sha1($mot_de_passe);
			$formulaire['nom'] = Securite::bdd($_POST['nom']); 
			//$formulaire['mail'] = $_POST['mail'];
			
			// -- Traitement du pseudo --
			
			$requete =  $bdd->prepare('SELECT COUNT(*) AS nb_pseudo FROM Administrateurs WHERE login_admin = :pseudo');
			$requete->bindParam(':pseudo', trim($formulaire['pseudo']), PDO::PARAM_STR);
			$requete->execute();
			$nombre = $requete->fetch();
				
			if ($nombre['nb_pseudo'] > 0)
			{ 
				$page['erreur'] = 'Ce pseudo est déja pris ou bien vous êtes déja inscrit...'; 
			}
			else // Le pseudo n'existe pas déjà, on peut continuer --
			{						
				/* $requete = $bdd->prepare('SELECT COUNT(*) AS nb_mail FROM membres WHERE mail = :mail');
				$requete->bindParam(':mail', $formulaire['mail'], PDO::PARAM_STR);
				$requete->execute();
				$nombre = $requete->fetch(); */
				
				if (false)//$nombre['nb_mail'] > 0)
				{ 
					$page['erreur'] = "Cette adresse mail est déjà prise !"; 
				}
				else
				{
					/* Explications : Si on arrive à ce Else, on a :
					 *  - Toutes les cases remplies et la charte cochée
					 *  - Un mail valide
					 *  - Un pseudo inutilisé
					 *  - Traité les données pour qu'elle ne soient pas une faille */
					
					$requete = $bdd->prepare('INSERT INTO Administrateurs(login_admin, mdp_admin, nom_admin) VALUES(:pseudo, :passe, :nom)');
					$requete->execute($formulaire);

					$page['info'] = "Inscription effectuée." ;
				}
			}
		}
	}
	
	$page['value Pseudo'] = (isset($_POST['pseudo'])) ? Securite::html($_POST['pseudo']) : '';
	$page['value Nom'] = (isset($_POST['nom'])) ? Securite::html($_POST['nom']) : '';
	$page['value Passe'] = (isset($_POST['passe'])) ? Securite::html($_POST['passe']) : '';
	$page['value Confirmation'] = (isset($_POST['confirmation'])) ? Securite::html($_POST['confirmation']) : '';
	$page['value Mail'] = (isset($_POST['mail'])) ? Securite::html($_POST['mail']) : '';
?>
