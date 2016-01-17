<?php

	$data['path'] = $path['ressources'] . 'global-user/';

	//setJQuery();
	//$data['liensJS']->add('global-user', 'script01.js');

	// Fil d'Ariane --
	$data['navi']->add('?user', 'Espace utilisateur');
	
// -- Emprunts --

	require_once $path['models'] . 'Media.php';

	$page['empruntsFixes'] = ModelMedia::getEmprunts($visiteur['id']);
	$number = count($page['empruntsFixes']);
	
	$page['empruntsSession'] = array();
	for($i = 0; $i < 3; $i++)
	{
		if(isset($_SESSION['el'. ($i + 1)])) 
		{
			$id = intval($_SESSION['el'. ($i + 1)]);
			$emprunt = ModelMedia::getAll($id);
			if(empty($emprunt))
			{
				echo "Ce média n'existe pas !";
			}
			else
			{
				$last = ModelMedia::getLastFreeMediaId($id);
				if(empty($last))
				{
					echo "Aucun exemplaire de libre pour ce média!";
				}
				else
				{					
					if($number < 3)
					{
						array_push($page['empruntsSession'],$emprunt[0]);
						$number++;
					}
					else
					{
						echo "Trop d'emprunts !";
					}
				}
			}
		}
	}
	// echo '<pre>';
	//print_r($page['empruntsFixes']);
	// print_r($page['empruntsSession']);
	//print_r($_SESSION);
	// echo '</pre>';

