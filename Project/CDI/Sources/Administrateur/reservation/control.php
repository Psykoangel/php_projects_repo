<?php

// Analyse de la situation --

	$page['keyAction'] = false;
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'cloturer':
				$page['keyAction'] = 'cloturer';
				break;
			case 'valider':
				$page['keyAction'] = 'valider';
				break;
		}
	}
	else
	{
		header('Location: ?admin=media');
	}
	
	$page['url'] = '?admin=reservation';
	$data['liensCSS']->add('messages', 'style.css');
	$data['liensCSS']->add('media-admin', 'style.css');
	$page['path'] = $path['ressources'] . 'media-admin/';
	
	// Fil d'Ariane --
	$data['navi']->add($page['url'], 'Gestion des réservations');
	
// Traitement --
		
	if($page['keyAction'] == 'cloturer')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Cloture');
	
		include 'Reservations/TraitementC.php';
	}
	
	if($page['keyAction'] == 'valider')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Validation');
		
		include 'Reservations/TraitementV.php';
	}
	
