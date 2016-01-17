<?php 

	require $path['class'] . 'Media.php';
	
	// Fil d'Ariane --
	$data['navi']->add('?user=catalogue', 'Catalogue');
	
	
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
	/*
	$page['medias'] = array();
	foreach($listeMedia as $media)
	{
            $nouveauMedia = new Media($media);
            array_push($page['medias'], $nouveauMedia);
	}*/
        
        $reqSELECT = $bdd->query("SELECT m.id_media, m.id_categorie, m.id_type, m.id_admin, m.titre_media, m.isbn_media, ".
                                 "m.resume_media, m.empruntable_media, m.nom_image FROM medias m WHERE m.empruntable_media=1");
        $donnees = $reqSELECT->fetchAll();
        $errorNumber = 0;
        $disabled = '';
        if( isset($_GET['err']))
        {
            if(!empty($_GET['err']))
            {
                $errorNumber = intval($_GET['err']);
            }
        }
        
        switch ($errorNumber) {
            case 100:
                break;

            default:
                break;
}
        /*
        echo '<pre>';
        print_r($donnees);
        echo '</pre>';*/
        

	