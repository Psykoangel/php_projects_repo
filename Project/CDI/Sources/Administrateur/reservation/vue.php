<?php if(isset($page['erreur'])) { ?>
	<div class="message_erreur"><?php echo $page['erreur']; ?></div>
<?php } else if(isset($page['info'])) { ?>
	<div class="message_info"><?php echo $page['info']; ?></div>
<?php } 

//Affichage de la page demandée --
	
if($page['keyAction'] == 'cloturer')
{
	include 'Cloture_Resa.php';
}

else if($page['keyAction'] == 'valider')
{
	include 'Valid_Resa.php';
}
?>