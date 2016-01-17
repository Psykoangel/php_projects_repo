<?php

	$pack = 'historique-user';
	//$data['liensCSS']->add($pack, 'style02.css');
	$page['path'] = $path['ressources'] . $pack . '/';
	$data['namepage'] = 'Historique';
	//$id_media = $_GET['id']; 
	
	// Fil d'Ariane --
	$data['navi']->add('?user=historique', 'Historique');
	
	$page['medias'] = ModelMedia::getTrace($visiteur['id']);
	
