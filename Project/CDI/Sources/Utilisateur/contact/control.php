<?php

	$pack = 'contact-user';
	$data['liensCSS']->add($pack, 'style03.css');
	$page['path'] = $path['ressources'] . $pack . '/';
	$data['namepage'] = 'Contact';
        
	// Fil d'Ariane --
	$data['navi']->add('?user=contact', 'Contacts');
	
	
	
if(isset($_POST['nom']) && isset($_POST['prenom']) && isset($_POST['email']) && isset($_POST['message']))
{
	require $path['class'] . 'Mail.php';
	
    $mail = new Mail();
	$mail->setTo('elouan_p_c@yahoo.fr', 'Admin');
	$mail->setTo($_POST['email'], $_POST['prenom'] .' '. $_POST['nom']);
	$mail->setMessage($_POST['message']);
	$mail->envoyer();
}