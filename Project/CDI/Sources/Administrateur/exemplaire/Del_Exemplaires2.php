<?php /*
********* PROJET CDI **********

******ADD-EXEMPLAIRE2*******

Description :Page PHP qui récupère le titre média 
pour lister les exemplaires disponibles et destiner à être 
supprimer

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ 

	if (isset($_POST['Titre_Media']))
	{
		
		echo '<form class="Exemplaire" method=POST action="?admin=exemplaire&amp;action=supprimer">';
		echo "<label for='Ref'>Reference concerné :  </label><SELECT name='Ref' class='InputText' > ";
		$reqRef = $bdd->prepare('SELECT num_exemplaire FROM exemplaires WHERE id_media IN ( SELECT id_media FROM medias WHERE titre_media =:titre)');
		$reqRef->execute(array('titre' => $_POST['Titre_Media']));
		while($donneesR = $reqRef->fetch(PDO::FETCH_ASSOC))
		{
			if ($donneesR['num_exemplaire'] != ''){
			echo '<OPTION VALUE ="'.$donneesR['num_exemplaire'].'">'.$donneesR['num_exemplaire'].'</OPTION>'; }
		}
		$reqRef->closeCursor();
		echo '<input type="submit" value="Enregistrer"/>'; 
		echo '</form>';
	}
	?>