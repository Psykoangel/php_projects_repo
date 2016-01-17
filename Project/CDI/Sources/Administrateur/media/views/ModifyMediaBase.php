<?php /*
********* PROJET CDI **********

********* MOD MEDIA ***********

Description : Page PHP qui génère un formulaire HTML pour
modifier un média dans la BDD. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 
*/ ?>

<form class="Media" method=POST action="<?php echo $page['url']; ?>&amp;action=modifier">
<h3> Modification de média </h3>
	<label for="Titre Média">Titre Média : <input type="text" name="titre" class='InputText'/> 
	<input type="submit" value="Rechercher"/><br /><br /><br />
</form>

<?php if(isset($page['medias'])) include 'ModifyMediaExtend.php'; ?>

