<?php

// Analyse de la situation --

	$page['keyAction'] = false;
	if(isset($_GET['action']))
	{
		switch($_GET['action'])
		{
			case 'ajouter':
				$page['keyAction'] = 'ajouter';
				break;
			case 'modifier':
				$page['keyAction'] = 'modifier';
				break;
			case 'supprimer':
				$page['keyAction'] = 'supprimer';
				break;
		}
	}
	else
	{
		header('Location: ?admin=media');
	}
	
	$page['url'] = '?admin=exemplaire';
	$data['liensCSS']->add('messages', 'style.css');
	$data['liensCSS']->add('media-admin', 'style.css');
	$page['path'] = $path['ressources'] . 'media-admin/';
	
	// Fil d'Ariane --
	$data['navi']->add($page['url'], 'Gestion des exemplaires');
	
// Traitement --

	if($page['keyAction'] == 'ajouter')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Ajout');
	
		include 'Exemplaires/traitement_AddE.php';
	}
	
	if($page['keyAction'] == 'modifier')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Modification');
		
		include 'Exemplaires/Traitement_ModifyE.php';
	}
	
	if($page['keyAction'] == 'supprimer')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Suppression');
		
		include 'Exemplaires/Traitement_DellE.php';
	}
	
// Finitions --

	if($page['keyAction']) $page['url'] .= '&amp;action='.$page['keyAction'];
	
