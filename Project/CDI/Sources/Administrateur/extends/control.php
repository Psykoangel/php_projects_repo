<?php 

// -- Dépendances --

	require $path['models'] . 'GenMultipleExtend.php';
	require $path['models'] . 'GenSingleExtend.php';
	require $path['class'] . 'Pagination.php';
	
	$data['liensCSS']->add('messages', 'style.css');

// -- Traitements --

	// Vérification --
	
		if(isset($_GET['ext']))
		{
			$page['type'] = 'multiple';
			switch($_GET['ext'])
			{
				case 'keywords':
					$model = new GenMultipleExtends('_media', '_keyword', 'Medias', 'Caracteriser', 'Keywords');
					$page['length'] = 20;
					break;
				case 'editeurs':
					$model = new GenMultipleExtends('_media', '_editeur', 'Medias', 'Publier', 'Editeurs');
					$page['length'] = 30;
					break;
				case 'auteurs':
					$model = new GenMultipleExtends('_media', '_auteur', 'Medias', 'Ecrire', 'Auteurs');
					$page['length'] = 50;
					break;
				case 'roles':
					$model = new GenMultipleExtends('_admin', '_role', 'Administrateurs', 'Occuper', 'Roles');
					$page['length'] = 30;
					break;
				case 'etats':
					$model = new GenSingleExtends('_etat', 'Etats', '_reservation', 'Reservation');
					$page['type'] = 'single';
					$page['length'] = 20;
					break;
				case 'types':
					$model = new GenSingleExtends('_type', 'Types', '_media', '_media');
					$page['type'] = 'single';
					$page['length'] = 30;
					break;
				default:
					header('Location: ?admin') or die();
			}
		}
		else
		{
			header('Location: ?admin') or die();
		}
		
	// -- Initialisation --
		
		$ext = $_GET['ext'];
		
		$exception = -1;
		$page['exception'] = '';
		
		$page['nomExt'] = $ext;
		$page['url'] = "?admin=extends&amp;ext=". $ext;
		$page['colonnes'] = 3;
		$page['form'] = false;
		$page['cible'] = false;
		
		$page['liste'] = array();
	
	// -- Action --
		
		// Détection du cas --
		if(isset($_GET['ajouter'])) { $page['action'] = 'Ajout'; $page['keyAction'] = 'ajouter';}
		else if(isset($_GET['editer'])) { $page['action'] = 'Edition';  $page['keyAction'] = 'editer';}
		else if(isset($_GET['supprimer'])) { $page['action'] = 'Suppression';  $page['keyAction'] = 'supprimer';}
		else if(isset($_GET['lier'])) { $page['action'] = 'Lier';  $page['keyAction'] = 'lier';}
		else if(isset($_GET['delier'])) { $page['action'] = 'Delier';  $page['keyAction'] = 'delier';}
		else { $page['action'] = false;  $page['keyAction'] = false;}

		// -- Cas Single --
		$noSingle = array('lier', 'delier');
		if(in_array($page['keyAction'], $noSingle) && $page['type'] == 'single')
		{
			$page['keyAction'] = false;
		}
		
		// Activation formulaire --
		$requireForm = array('ajouter', 'editer');
		if(in_array($page['keyAction'], $requireForm))
		{
			$page['form'] = true;
			$page['formInput'] = true;
		}
		
		// Vérification extension --
		$requireExt = array('editer', 'supprimer', 'lier', 'delier');
		if(in_array($page['keyAction'], $requireExt))
		{
			$valide = false;
			if(isset($_GET[$page['keyAction']]) && Securite::isInt($_GET[$page['keyAction']]))
			{
				// Vérif existence --
				$retour = $model->getById($_GET[$page['keyAction']]);
				if(!empty($retour))
				{
					$page['id_ext'] = $_GET[$page['keyAction']];
					$valide = true;
				}
			}
			
			if(!$valide) $page['keyAction'] = false; 
		}
		
		// Vérification base --
		$requireExt = array('keywords', 'auteurs', 'editeurs', 'roles');
		if(in_array($ext, $requireExt))
		{
			$valide = false;
			if(isset($_GET['id']) && Securite::isInt($_GET['id']))
			{
				// Vérif existence --
				if($model->parentExists($_GET['id']))
				{
					$page['id'] = $_GET['id'];
					$page['url'] .= "&amp;id=". $page['id'];
					$valide = true;
				}
			}
			
			$requireExt = array('lier', 'delier');
			if(in_array($page['keyAction'], $requireExt) && !$valide)
			{
				$page['keyAction'] = false;
			}
		}
		
	// -- Gestion des exceptions --
	
		if($ext == 'types')
		{
			$page['exception'] = 'type';
			$exception = 1;
		}
		
	// -- Action --
		
		// Suppression --
		if($page['keyAction'] == 'supprimer')
		{
			$model->supprimer($page['id_ext']);
		}
		
		// Liaisons --
		if($page['keyAction'] == 'lier' || $page['keyAction'] == 'delier')
		{
			$model->$page['keyAction']($page['id_ext'], $page['id']);
		}
		
		// Ajout/Edition --
		if($page['keyAction'] == 'editer' || $page['keyAction'] == 'ajouter')
		{
			$fini = false;
			if(isset($_POST['nom'])) // Form. reçu --
			{
				$nom = Securite::bdd($_POST['nom']);
				if(strlen($nom) < $page['length'])
				{
					if($page['exception'] == 'type')
					{
						$duree = (isset($_POST['duree'])) ? intval($_POST['duree']) : 0 ;
						if(isset($page['id_ext']) && $page['keyAction'] == 'editer') 
							$model->editer($nom, $page['id_ext'], $duree);
						else if(isset($page['id']) && $page['keyAction'] == 'ajouter') 
							$model->ajouter($nom, $page['id'], $duree);
						else $model->ajouter($nom, -1, $duree);
					}
					else
					{
						if(isset($page['id_ext']) && $page['keyAction'] == 'editer') $model->editer($nom, $page['id_ext']);
						else if(isset($page['id']) && $page['keyAction'] == 'ajouter') $model->ajouter($nom, $page['id']);
						else $model->ajouter($nom);
					}
					
					$fini = true;
					$page['formInput'] = false;
					$page['formInfo'] = "Element enregistré";
				}
				else
				{
					$page['formErreur'] = "Le nom est trop long.";
				}
			}
			
			if($page['formInput'] && $page['keyAction'] == 'editer') // Form. en attente --
			{
				$element = $model->getById($page['id_ext'], $exception);
				$page['formElement'] = array(
					"id" => Securite::html($element['id']),
					"nom" => Securite::html($element['nom'])
				);
				
				if($exception != -1) $page['formElement']['duree'] = Securite::html($element['duree']);
			}
			else if($page['formInput'])
			{
				$page['formElement'] = array("nom" => '');
			}
			
		}
	
	// -- Liste --
	
	if(!isset($_GET['nolist']))
	{
		if(isset($page['id']))
		{
			$page['liste'] = $model->getAll($page['id']);
			$page['nbElement'] = $model->countAll($page['id']);
			$page['cible'] = true;
			$page['colonnes'] += 2;
		}
		else
		{
			$page['liste'] = $model->getAll();
			$page['nbElement'] = $model->countAll();
		}
	
		// Pagination --
		$page['pagination'] = new Pagination($page['url']);
		$page['pagination']->setNombre($page['nbElement']);
		
		if(isset($_GET['page']) && !is_int($_GET['page'])) // A sécuriser --
		{
			$page['url'] .= '&amp;page='. $_GET['page'];
		}
	}
	
	

