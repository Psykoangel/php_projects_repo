<?php /*
********* PROJET CDI **********

*****MODIFY-EXEMPLAIRE******

Description : Génération d'un ascensceur qui liste les 
reference disponibles en fonction du média choisit. 

@Author : Despendo 
Copyright 2012 pour eXia.Cesi Strasbourg 

*/ 

	if (isset($_POST['Titre_Media']))
		{
			
			echo '<form class="Exemplaire" method=POST action="?admin=exemplaire&amp;action=modifier&amp;suite">';
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
		
	if (isset($_POST['Ref']))
	{
		
		$Ref = $_POST["Ref"];
		
		$reqRecupIDExe = $bdd->prepare('SELECT num_exemplaire FROM exemplaires WHERE num_exemplaire = :ref');
		$reqRecupIDExe->execute(array('ref' => $Ref));
		$donnees = $reqRecupIDExe->fetch(PDO::FETCH_ASSOC);
		$IDExem = $donnees['num_exemplaire']; // Contient l'ID 
		
		if ($IDExem != '')
		{
			$reqRecupModifyExe = $bdd->prepare('SELECT * FROM exemplaires WHERE num_exemplaire= :exemplaire');
			$reqRecupModifyExe->execute(array('exemplaire' =>$IDExem));
			while ($donnees = $reqRecupModifyExe->fetch())
			{
				$dacqui = $donnees['dacquisition_exemplaire'];
				$prix= $donnees['prix_exemplaire'];
				$etat = $donnees['rmq_exemplaire'];
				$dispo = $donnees['dispo_exemplaire'];
				
				require('Exemplaires/Modify_two.php');
			}
		}
		else {
			print_r (' Cet exemplaire n\'exsiste pas !');
		}
			
	}
?>