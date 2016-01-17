<?php

	require $path['class'] . 'Section.php';

	// -- Listes --
	
	$admin = new Section('Administrateur', 'admin', 'administrateur');
	
		$admin->add('test')
			->setPageParDefaut();
	
	$user = new Section('Utilisateur', 'user', 'utilisateur');
	
		$user->add('accueil')
			->setPageParDefaut();
		
		$user->add('emprunt');
		
		$user->add('options');
		
	$login = new Section('Login', 'login');
	$portail = new Section('Portail', 'portail');
		
	$sections = array(&$login, &$user, &$admin, &$portail);

	// -- Autorisations --
	
	if($visiteur['rang'] > 0)
	{
		// -- Accès BDD --
		$requete = $bdd->prepare('SELECT r.nom_role AS role FROM occuper o INNER JOIN roles r ON o.id_role = r.id_role '
									. 'WHERE o.id_admin = :id');
		$requete->bindParam(':id', $visiteur['id'], PDO::PARAM_STR);
		$requete->execute();
		
		// Droits explicites --
		while($retour = $requete->fetch()) { array_push($visiteur['droits'], $retour['id']); }
		
		// Droits implicites --
		array_push($visiteur['droits'], 'administrateur');
		if(in_array('administrateur', $visiteur['droits']) && !in_array('utilisateur', $visiteur['droits']))
		{
			array_push($visiteur['droits'], 'utilisateur');
		}
	}
	
	// -- Analyse de la demande --
	$occurence = false;
	foreach($sections as $section)
	{
		if($section->permitted($visiteur['droits']) && $section->requested())
		{
			$path['page'] = $section->getRequestedPage();
			$path['section'] = $section->getId();
			$occurence = true;
		}
	}
	
	if(!$occurence)
	{
		$path['page'] = '';
		$path['section'] = 'Login';
	}
	
	// -- Contrôleur template global --
		
		$inclusion = 'Sources/'. $path['section'] .'/global/control.php';
		if(file_exists($inclusion)) include $inclusion;
	
	// -- Inclusion contrôleur page --
	
		if(!empty($path['page'])) 
		{
			$chemin = 'Sources/'. $path['section'] .'/'. $path['page'] .'/';
			
			if(file_exists($chemin .'control.php') && file_exists($chemin .'vue.php'))
			{
				include $chemin .'control.php';
				$data['page'] = $chemin .'vue.php';
			}
			else
			{
				$data['page'] = 'Noyau/empty.php';
			}
		}
						
	// -- Inclusion template global --
		
		$inclusion = 'Sources/'. $path['section'] .'/global/vue.php';
		if(file_exists($inclusion)) include $inclusion;		
	