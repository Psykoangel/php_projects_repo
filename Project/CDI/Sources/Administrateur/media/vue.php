<?php if(isset($page['erreur'])) { ?>
	<div class="message-erreur"><?php echo $page['erreur']; ?></div>
<?php } else if(isset($page['info'])) { ?>
	<div class="message-info"><?php echo $page['info']; ?></div>
<?php } 

//Affichage de la page demandée --
	
if($page['keyAction'] == 'ajouter')
{
	include 'views/AddMedia.php';
}

else if($page['keyAction'] == 'modifier')
{
	include 'views/ModifyMediaBase.php';
}

else if($page['keyAction'] == 'supprimer')
{
	include 'views/DelMedia.php';
}
else
{
?>
	<h2> Centralisation des actions administratives </h2>
	<div id='left'> <h2> Média </h2>
            <h3> <a href='?admin=media&amp;action=ajouter' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Add_media.png'/>  Ajouter un média </a></h3>
		<h3> <a href='?admin=media&amp;action=modifier' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Mod_Media.png'/>  Modifier un média </a></h3>
		<h3> <a href='?admin=media&amp;action=supprimer' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Del_media.png'/>  Supprimer un média </a></h3>
	</div>
	<div id="right"> <h2> Exemplaire  </h2>
		<h3> <a href='?admin=exemplaire&amp;action=ajouter' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Add_exemplaire.png'/>  Ajouter un exemplaire </a></h3>
		<h3> <a href='?admin=exemplaire&amp;action=modifier' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Mod_exemplaire.png'/>  Modifier un exemplaire </a></h3>
		<h3> <a href='?admin=exemplaire&amp;action=supprimer' style="color: black; text-decoration: none;">
			<img src='<?php echo $page['path']; ?>Del_exemplaire.png'/>  Supprimer un exemplaire </a></h3>
	</div> 
	<div id="bottom"> <h2> Réservation </h2>
	<h3> <a href="?admin=reservation&amp;action=valider"  >
		<img src='<?php echo $page['path']; ?>valid.png'/> Demande de réservations </a></h3>
	<h3> <a href="?admin=reservation&amp;action=cloturer"  >
		<img src='<?php echo $page['path']; ?>clot.png'/> Cloturation de réservations </a></h3>
	</div>
<?php
}
?>