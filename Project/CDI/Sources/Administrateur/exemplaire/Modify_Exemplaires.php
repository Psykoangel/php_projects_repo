<?php /*
********* PROJET CDI **********

*****MODIFY-EXEMPLAIRE******

Description :Formulaire qui va permettre de modifier 
les infos d'un exemplaire. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class="Media" method=POST action="?admin=exemplaire&amp;action=modifier&amp;suite">
<h3> Modification d'exemplaire </h3>
	<?php include('Exemplaires/Search_M.php'); ?>
	<input type="submit" name="submitME1" value="Modifier"/>
</form>

	
