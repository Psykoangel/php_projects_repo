<?php
	
	/* -- Classe Session -- */
	class Session
	{
	
		// -- Analyse des données --
		public static function analyser()
		{
			$pseudo = '';
			$passe = '';
			$cas = false;
		
			// Demarrage de la session --
			session_start();
			
			
			if(isset($_POST['pseudo'], $_POST['passe'])) // Formulaire de connexion --
			{
				$cas = 'form';
				$pseudo = $_POST['pseudo'];
				$passe = $_POST['passe'];
			}
			else if(isset($_COOKIE['PHPSESSID'])) // Maintien de la session --
			{
				if(isset($_SESSION['pseudo'], $_SESSION['passe']))
				{
					$cas = 'session';
					$data['session'] = true;
				
					$pseudo = $_SESSION['pseudo'];
					$passe = $_SESSION['passe'];
				}
			}
			
			// Réactivation par Cookie de la session --
			if(!$cas and isset($_COOKIE['pseudo'], $_COOKIE['passe']))
			{
				$cas = 'cookie';
				$pseudo = $_COOKIE['pseudo'];
				$passe = $_COOKIE['passe'];
			}
			
			return array("pseudo" => $pseudo, "passe" => $passe, "cas" => $cas);
		}

		// -- Connexion --
		public static function connexion($infos)
		{
			global $bdd;
		
			// Initialisation : Réponse et BDD --
			$retour = array(	'valeur' => false,
								'erreur' => '',
								'message' => '');

			// -- Vérification 1 : Oublis --
			if(!isset($infos['pseudo'], $infos['passe'])) 
			{ 
				$retour['message'] = "Le pseudo et le mot de passe n'ont pas été renseignés correctement."; 
			}
			else
			{
				// -- Sécurisation --
				$pseudo = $infos['pseudo'];
				$passe = Securite::bdd($infos['passe']);

				// Récupération des infos membres --
				$requete = $bdd->prepare("SELECT * FROM membre WHERE login=:pseudo");
				$requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
				$requete->execute();
				$membre_bdd = $requete->fetch(PDO::FETCH_ASSOC) ;
				
				// Vérification 2 : Existance du compte --
				if(!isset($membre_bdd['id_membre']))
				{ 
					$retour['message'] = "Ce compte n'existe pas.";
				}
				else
				{
					// Vérification 3 : Correspondance mot de passe --
					if($passe != $membre_bdd['mdp'])
					{ 
						$retour['message'] = "Le mot de passe est incorrect.";
					}
					else
					{
						// Tout est bon --	
						$retour['valeur'] = true;
						$retour['pseudo'] = $pseudo;
						$retour['passe'] = $passe;
						
						// Création des cookies --
						if(isset($_POST['cookie']))
						{
							$expiration = time() + 365*24*3600; // Un an...
							setcookie('pseudo', $pseudo , $expiration);
							setcookie('passe', $passe , $expiration);
						}
					}
				}
			}

			return $retour;
		}

		// -- Déconnexion --
		public static function deconnexion()
		{
			session_destroy();
		}

		// -- Inscription --
		public static function inscription($infos, $bdd)
		{
			// Initialisation : Réponse et BDD --
			$retour = array(	'valeur' => false,
								'message' => '');

			// -- Vérification 1 : Oublis --
			if(!isset($_POST['pseudo']) && !isset($_POST['passe'])) 
			{ 
				$retour['message'] = "Le pseudo et le mot de passe n'ont pas été renseignés correctement."; 
			}
			else
			{
				// -- Sécurisation --
				$pseudo = Securite::bdd($infos['pseudo']);
				$passe = Securite::bdd($infos['passe']);

				// Récupération des infos membres --
				$requete = $bdd->prepare('SELECT * FROM membre WHERE login = :pseudo');
				$requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
				$requete->execute();
				$membre_bdd = $requete->fetch(PDO::FETCH_ASSOC);

				// Existance du compte --
				if(isset($membre_bdd['id_membre']))
				{ 
					$retour['message'] = "Ce pseudo est déjà pris";
				}
				else
				{
					// -- Enregistrement --
					$requete = $bdd->prepare("INSERT INTO membre(login, mdp) VALUES(:pseudo, :passe)");
					$requete->bindParam(':pseudo', $pseudo, PDO::PARAM_STR);
					$requete->bindParam(':passe', $passe, PDO::PARAM_STR);
					$requete->execute();

					// -- Tout est bon --	
					$retour['valeur'] = true;
					$retour['pseudo'] = $pseudo;
					$retour['passe'] = $passe;
				}
			}
			return $retour;
		}
	}