<?php 

/* -- Contrôleur frontal -- */

	// -- Ouverture BDD --

		global $bdd;
		
		try 
		{ 
			$bdd = new PDO('mysql:host=localhost;dbname=projet_cdi', 'root', ''); 
			$bdd->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);
		}
		catch (Exception $e) { die('Erreur BDD : ' . $e->getMessage()); }
		
	// -- Fonctions primaires --
	
		include 'Classes/Securite.php';
	
	// -- NOYAU --
	
		// Definitions --
		
			include('noyau/data.php');
			
		//  Système de sessions --
		
			include('noyau/sessions.php');
			
		//  Systèmes auxiliaires --
		
			include('noyau/sup.php');
			
		// Sélecteur de page --
		
			include('noyau/pages.php');
			
			