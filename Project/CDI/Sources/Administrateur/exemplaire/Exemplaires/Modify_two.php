<?php /*

********* PROJET CDI **********

MODIFY_TWO 

Description : Génération d'un formulaire et le PHP 
va remplir les différentes entrées provenant de la BDD. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ ?>

<form class='Media' method=POST action="?admin=exemplaire&AMP;action=modifier">
	<label for="Reference">Reference Exemplaire  :  </label><input type="text" name="refE" class='InputText' value='<?php echo $IDExem ; ?>' /> <br />  <br />
	<label for="Date d'acquisition">Date d'acquisition : </label><input type="text" name="dacqui" class='InputText'value='<?php  echo $dacqui ; ?>'/> <br /> <br />
	<label for="Prix :">Prix :  </label><input type="text" name="prix" class='InputText' value='<?php  echo $prix ; ?>' /> <br />  <br />
	<label for="Etat">Etat  :  </label><input type="text" name="etat" class='InputText' value='<?php  echo $etat; ?>' /> <br />  <br />
	<label for="Disponible">Disponible :  </label><input type="checkbox" name="dispo" <?php  if ($dispo == 1){ echo' checked=checked' ;} else { echo "";} ?> /> <br />  <br />
	<input type="submit" value="Enregistrer"/> 
</form> 