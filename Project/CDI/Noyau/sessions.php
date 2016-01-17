
﻿<?php 

	$pseudo = '';
	$passe = '';
	$cas = 0;
	$erreur = 0;
	
	// -- Etude du cas présent -- 
	
		session_start();
	
		if(isset($_GET['deco'])) // Déconnexion --
		{
			session_destroy();
			header('Location: ?login&deconnexion');
		}		
		if(isset($_POST['pseudo'], $_POST['passe'], $_GET['connexion'])) // Formulaire --
		{
			$cas = 1;
			$pseudo = $_POST['pseudo'];
			$passe = $_POST['passe'];
		}
		else if(isset($_COOKIE['PHPSESSID']))
		{
			if(isset($_SESSION['pseudo'], $_SESSION['passe'])) // Session --
			{
				$pseudo = $_SESSION['pseudo'];
				$passe = $_SESSION['passe'];
				
				$cas = 2;
			}
		}
		if($cas == 0 && isset($_COOKIE['pseudo'], $_COOKIE['passe'])) // Cookie --
		{
			$cas = 3;
			$pseudo = $_COOKIE['pseudo'];
			$passe = $_COOKIE['passe'];
		}
	
	// La situation est identifiée. Le terrain est préparé, connexion --
	
	if($cas > 0) 
	{
		// Initialisation et sécurisation --
		$erreur = 0;
		$pseudo = Securite::bdd($pseudo);
		$passe =  Securite::bdd($passe);
		
		// Récup. des infos sur ces variables --
		$requete = $bdd->prepare('SELECT id_admin AS id, login_admin AS pseudo, mdp_admin AS passe, nom_admin AS nom FROM administrateurs '
									. 'WHERE login_admin = :pseudo');
		$requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
		$requete->execute();
		$tmembre = $requete->fetch(PDO::FETCH_ASSOC);
		
		// Vérification de la correspondance variable/bdd --
		if(empty($tmembre) || $tmembre['pseudo'] != $pseudo)
		{ 
			$erreur = 1; /* Pseudo inconnu */ 
		}
		else
		{
			if(sha1($passe) != $tmembre['passe'] )
			{
				$erreur = 2; /* Mot de passe incorrect ! */ 
			}
			else // Demande valide -> Connexion --
			{
				// Création des données de session --
				$_SESSION['pseudo'] = $tmembre['pseudo'];
				$_SESSION['passe'] = $passe;
				
				$tmembre['rang'] = 1;
				
				// Création des cookies --
				if(isset($_POST['cookie']))
				{
					$expiration = time() + 365*24*3600; // Un an...
					setcookie('pseudo', $pseudo , $expiration);
					setcookie('passe', $passe , $expiration);
				}
			}
		}
                
                // -- Autorisations --
	
                if($tmembre['rang'] > 0)
                {
                        // -- Accès BDD --
                        $requete = $bdd->prepare('SELECT r.nom_role AS role FROM occuper o INNER JOIN roles r ON o.id_role = r.id_role '
                                                                                . 'WHERE o.id_admin = :id');
                        $requete->bindParam(':id', $tmembre['id'], PDO::PARAM_STR);
                        $requete->execute();

                        // Droits explicites --
                        $tmembre['droits'] = array();
                        while($retour = $requete->fetch()) { array_push($tmembre['droits'], $retour['role']); }

                        // Droits implicites --
                        if(in_array('administrateur', $tmembre['droits']) && !in_array('utilisateur', $tmembre['droits']))
                        {
                                array_push($tmembre['droits'], 'utilisateur');
                        }
                }
		
		// Prise d'effet de la session --		
		if($erreur == 0 && $cas == 1) // Connexion réussie --
		{
                    if(in_array('administrateur', $tmembre['droits']))
                    {
			header('Location: ?admin&connexion='. $erreur);
                    }
                    else if(in_array('utilisateur', $tmembre['droits']))
                    {
                        header('Location: ?user&connexion='. $erreur);
                    }
                    else
                    {
                        header('Location: ?login&connexion');
                    }
		}	
		else if($erreur != 0 && $cas == 1) // Echec connexion  --
		{
			header('Location: ?login&connexion='. $erreur);
		}
		else if($erreur != 0 AND ($cas == 2 OR $cas == 3)) // Echec maintien --
		{
			setcookie('pseudo', '0' , time());
			setcookie('passe', '0' , time());
			
			session_destroy();
			header('Location: ?login&connexion='.$erreur );
		}
		else // Maintien réussi --
		{
			//!\\ Très important : c'est cette instruction qui rend les infos sur le visiteur accessible !
			   //    Autrement, il n'est pas vraiment connecté...
			$protection = array('nom_admin');
			foreach($tmembre as $cle => $element)
			{
				$visiteur[$cle] = $element;
			}
			
			$visiteur['nom'] = Securite::html($visiteur['nom']);
			
			$data['session'] = true;
		}
	}
	
	// Gestion des messages info/erreur du système de connexion --
	if(isset($_GET['connexion']) && !is_int($_GET['connexion'])) 
	{
		switch($_GET['connexion'])
		{
			case 0:
				$data['info'] = "Vous êtes bien connecté. Bonne visite !";
				break;
			case 1:
				$data['erreur'] = "Pseudo inconnu";
				break;
			case 2:
				$data['erreur'] = "Ce n'est pas le bon mot de passe.";
				break;
		}
	}
	else if(isset($_GET['deconnexion']))
	{
		$data['info'] = "Vous êtes bien déconnecté. Merci de votre visite !";
	}