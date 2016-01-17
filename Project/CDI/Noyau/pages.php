<?php

	require $path['class'] . 'Section.php';

	// -- Listes --
	
	$admin = new Section('Administrateur', 'admin', 'administrateur');
	
		$admin->add('media')
			->setPageParDefaut();
		
		$admin->add('reservation');
		
		$admin->add('exemplaire');
		
		$admin->add('extends');
			
		$admin->add('inscription');
	
	$user = new Section('Utilisateur', 'user', 'utilisateur');
	
		$user->add('accueil')
			->setPageParDefaut();
		
		$user->add('catalogue');
		
		$user->add('historique');
		
		$user->add('panier');
		
		$user->add('contact');
		
	$login = new Section('Login', 'login');
	//$portail = new Section('Portail', 'portail');
		
	$sections = array(&$login, &$user, &$admin);
	
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
	