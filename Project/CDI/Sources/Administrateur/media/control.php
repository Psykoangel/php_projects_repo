<?php
/*
********* PROJET CDI **********

INDEX - CENTRALISATION WORSPACE 

Description :Cette page index contient les liens vers les différentes 
pages du futur Worspace 

Etat d'avancement de la partie Média (Partie logique)
Ajouter : 80% (a venir -> Test / Gestion Erreur / Design)
Supprimer : 80% (a venir -> Test / Gestion Erreur / Design)
Modifier : 10% 

@Author : Despendo, Lifaen
Copyright 2012 pour eXia.Cesi Strasbourg 
*/

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
	else if(isset($_GET['message']))
	{
		switch($_GET['message'])
		{
			case 1:
				$page['info'] = 'Modification enregistrée avec succès.';
				break;
			case 2:
				$page['info'] = 'Suppression enregistrée avec succès.';
				break;
			case 3:
				$page['info'] = 'Ajout enregistré avec succès.';
				break;
			case 4:
				$page['info'] = 'Validation enregistré avec succès.';
				break;
			case 5:
				$page['info'] = 'Cloture enregistré avec succès.';
				break;
		}
	}
	
	$page['url'] = '?admin=media';
	$data['liensJS']->add('media-admin', 'JS_medias.js');
	$data['liensCSS']->add('media-admin', 'style.css');
	$data['liensCSS']->add('messages', 'style.css');
	$page['path'] = $path['ressources'] . 'media-admin/';
	
	// Fil d'Ariane --
	$data['navi']->add($page['url'], 'Gestion des médias');
	
// Traitement --
		
	if($page['keyAction'] == 'ajouter')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Ajout');
		
		// Système JS de recherche --
		include 'system/CheckAuteurs.php';
		include 'system/CheckEditeurs.php';
	
		include 'system/AddMedia.php';
	}
	
	if($page['keyAction'] == 'modifier')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Modification');
		
		include 'system/ModifyMedia.php';
	}
	
	if($page['keyAction'] == 'supprimer')
	{
		// Fil d'Ariane --
		$data['navi']->add($page['url']. '&amp;action='. $page['keyAction'], 'Suppression');
		
		include 'system/DelMedia.php';
	}
	
// Finitions --

	if($page['keyAction']) $page['url'] .= '&amp;action='.$page['keyAction'];
	
