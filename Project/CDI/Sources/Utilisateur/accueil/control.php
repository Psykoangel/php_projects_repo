<?php 

	// Fil d'Ariane --
	$data['navi']->add('?user', 'Accueil');
	
	$Requete5 = $bdd->query('SELECT * FROM medias WHERE empruntable_media=1 ORDER BY id_media DESC LIMIT 5');
	$donnees = $Requete5->fetchAll();
	
	
	
