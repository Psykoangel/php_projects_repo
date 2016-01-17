<?php if(isset($page['erreur'])) { ?>
	<div class="message_erreur"><?php echo $page['erreur']; ?></div>
<?php } else if(isset($page['info'])) { ?>
	<div class="message_info"><?php echo $page['info']; ?></div>
<?php } 

//Affichage de la page demandée --
	
if($page['keyAction'] == 'ajouter')
{
	include 'Add_Exemplaires.php';
}

if($page['keyAction'] == 'modifier')
{
	include (isset($_GET['suite'])) ? 'Modify_Exemplaires2.php' : 'Modify_Exemplaires.php';
}

if($page['keyAction'] == 'supprimer')
{
	include (isset($_GET['suite'])) ? 'Del_Exemplaires2.php' : 'Del_Exemplaires.php';
}
?>