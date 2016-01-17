<?php

// -- Systèmes additionnel de liens --

	require $path['class'] .'Lien.php';
	
	$data['liensCSS'] = new LienCSS();
	$data['liensJS'] = new LienJS();
	
// -- Pré-sets de liens --

	global $ressources;
	$ressources = array(
		'JQuery' => $path['ressources'] . 'jquery/'
	);
	
	function setJQuery()
	{
		static $locked = false;
		global $data;
		
		if(!$locked)
		{
			//$data['liensJS']->add('jquery', 'jquery-1.7.2.js');
			$data['liensJS']->add('jquery', 'jquery-1.7.2.min.js');
			$data['liensJS']->add('jquery', 'jquery-ui-1.8.21.custom.min.js');
			
			$locked = true;
		}
	}

// -- Initialisation Navigateur --

	require $path['class'] .'Navigateur.php';
	
	$data['navi'] = new Navigateur();
	$data['navi']->add('index.php', 'Index');
	
// -- Compteur --

	function compteur($nom)
	{
		$fichier = 'Noyau/compteur.txt';
		$compteurs = unserialize(file_get_contents($fichier));
		
		if(array_key_exists($nom, $compteurs))
		{
			$compteurs[$nom]++;
			$renvoi = $compteurs[$nom];	
		}
		else
		{
			$compteurs[$nom] = 1;
			$renvoi = $compteurs[$nom];
		}
		
		file_put_contents($fichier, serialize($compteurs));
		return $renvoi;	
	}
	
	