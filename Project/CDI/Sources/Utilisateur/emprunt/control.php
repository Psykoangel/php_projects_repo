<?php 

	require $path['class'] . 'Media.php';
	
	// Fil d'Ariane --
	$data['navi']->add('?user=emprunt', 'Emprunts');
	
	
//        SORTIE
        
        $critere = false;
        $recherche = new SearchMedia();
        
        if( isset($_GET['type']))
        {
            $recherche->byType($_GET['type']);
        }
        
        if( isset($_GET['categorie']))
        {
            $recherche->byCat($_GET['categorie']);
        }
        
        if( isset($_GET['nom']))
        {
            $recherche->byName($_GET['nom']);
        }
        
        if( isset($_GET['auteur']))
        {
            $recherche->byAuthor($_GET['auteur']);
        }
        
        if($critere)
        {
            $listeMedia = $recherche->getAll();
        }
        else
        {             
            $listeMedia = ModelMedia::getAll();
        }
	
	$page['medias'] = array();
	foreach($listeMedia as $media)
	{
		$nouveauMedia = new Media($media);
		array_push($page['medias'], $nouveauMedia);
	}
	
//        ENTREE Envoi des emprunts actuels !

	if(isset($_POST['emprunts']))
	{
		$list = array();
		$ids = array('Id1', 'Id2', 'Id3');
		
		// Vérification de l'existence des emprunts --
		foreach($ids as $id)
		{
			if(isset($_POST[$id]) && intval($_POST[$id]) > 0)
			{
				array_push($list, $_POST[$id]);
			}
		}
		
		/* $valide = false;
		foreach($page['empruntsFixes'] as $element)
		{
			if(!in_array($list, $element['id']))
			{	
				$valide = false;
			}
			else
			{
				unset($list[$element['id']]);
			}
		} */
		
		// -- Vidange --
		for($i = 1; $i < 4; $i++)
		{
			if(isset($_SESSION['el'. $i])) unset($_SESSION['el'. $i]);
		}
		
		print_r($_POST);
		$inc = count($page['empruntsFixes']);
		// -- Remplissage --
		for($i = 1; $i < 4; $i++)
		{
			if(isset($_POST['Id'. $i]) && Securite::isInt($_POST['Id'. $i]))
			{
				$id = intval($_POST['Id'. $i]);
				$last = 1;//ModelMedia::getLastFreeMediaId($id);
				if($last != 0 && $inc < 4)
				{
					$_SESSION['el'.$i] = $id;
					$inc++;
				}
				else
				{
					echo 'Impossible';
				}
			}
			else
			{
				echo 'Gnan !';
			}
		}
			
		header('Location: ?user=emprunt');
	}


	