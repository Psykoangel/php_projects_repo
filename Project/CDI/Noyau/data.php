<?php

/* -- Important : Definition des variables globales génériques --
 * Data : regroupe les infos de bases sur le site
 * Visiteur : regroupe les infos sur le visiteur
 * Page : regroupe les infos sur la page demandée
 * Page : regroupe les infos sur les différents chemins du site
 */
	
	global $data;
	$data = array(
		'renvoi' => "http://Devaron/",
		'namesite' => "Projet CDI",
		'varpage' => "accueil",
		'namepage' => "Accueil",
		'pagination' => 15,
		'session' => false
	);
	
	global $visiteur;
	$visiteur['rang'] = 0;
	$visiteur['id_membre'] = 0;
	$visiteur['droits'] = array();
	
	global $page;
	
	global $path;
	$path = array(
		'class' => "Classes/",
		'lib' => "Librairies/",
		'models' => "Modeles/",
		'ressources' => "Ressources/",
		'sources' => "Sources/",
		'noyau' => "Noyau/"
	);
	
	
	