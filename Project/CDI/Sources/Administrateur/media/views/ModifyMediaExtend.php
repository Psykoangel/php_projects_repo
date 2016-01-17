<?php
foreach($page['medias'] as $element) {
	$txt = '';
	if (!isset($element['image']) || empty($element['image'])) {
		$element['image'] = "no_image.jpg";
		$txt = 'Aucune image dans la base de donnée pour ce média !';
	}
?>
<form class='Media' method=POST enctype="multipart/form-data" action='?admin=media&amp;action=modifier'>
	<input type='hidden' name='IDC' value='<?php echo $element['id'] ; ?>'/> 
	<label for='Titre Média'>Titre Média : </label>
	<input type='text' class='InputText' name='titreC' value='<?php echo $element['titre'] ;?>'/> <br /><br />
	<label for='ISBN'>ISBN :  </label><input type="text" name='isbnC'class='InputText' value='<?php echo $element['isbn'] ; ?>'/> <br />
	<label for='Description'>Description :  </label><TEXTAREA rows='3'  name='resumeMediaC'> <?php echo $element['resume'] ; ?></TEXTAREA><br />
	<label for='Empruntable'>Empruntable :  </label>
	<input type='checkbox' class='InputText' name='empruntC' id='mpruntC' <?php echo ($element['emprunt']) ? ' checked=checked' : "";?>/><br />
	<a href="?admin=extends&amp;ext=keywords&id=<?php echo $element['id']; ?>" target="blank">
		Editer les mots-clés</a><br/>
	<a href="?admin=extends&amp;ext=auteurs&id=<?php echo $element['id']; ?>" target="blank">
		Editer les auteurs</a><br/>
	<a href="?admin=extends&amp;ext=editeurs&id=<?php echo $element['id']; ?>" target="blank">
		Editer les éditeurs</a><br/>
	<br />
	<p> <?php echo $txt; ?> </p>
	<img src="Ressources/images/miniatures/<?php echo $element['image']; ?>">
	<br />
	<label for="img">Image :  </label> <input type="file" name="img" /> <br /> <br />
	<input type='submit' value='Enregistrer'/>
</form>

<?php 


}
?>