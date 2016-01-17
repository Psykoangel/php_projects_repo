<?php 

    require $path['class'] . 'Media.php';
    $pack = 'panier-user';
    //$data['liensCSS']->add($pack, 'style04.css');
    //$page['path'] = $path['ressources'] . $pack . '/';
    $data['namepage'] = 'Panier';
    
	// Fil d'Ariane --
	$data['navi']->add('?user=panier', 'Panier');
        
        if (isset($_POST['valid']))
        {
            if (isset($_POST['finalList']) && count($_POST['finalList']) > 0)
            {
                $mess = ModelMedia::setEmprunts($_POST['finalList']);
                echo $mess['message'];
                $_SESSION['panier'] = array();
            }
        }
        else if (isset($_POST['supp']))
        {
            if (isset($_POST['finalList']) && count($_POST['finalList']) > 0)
            {
                $_SESSION['panier'] = array_diff($_SESSION['panier'], $_POST['finalList']);
            }
        }

	if(isset($_POST['mediaList']) && count($_POST['mediaList']) > 0)
	{                
            $page['panier'] = array();
            if (!(isset($_SESSION['panier'])) && count($_SESSION['panier']) == 0)
            {
                $_SESSION['panier'] = array();
            }
            foreach($_POST['mediaList'] as $idMedia)
            {
                $media = ModelMedia::getAll($idMedia);
                $nouveauMedia = new Media(current($media));
                array_push($page['panier'], $nouveauMedia);
                array_push($_SESSION['panier'], $idMedia);
            }
            if (count($page['panier']) > 0)
            {
                if (count($page['panier']) > 3)
                {
                    $_SESSION['panier'] = array();
                    header('Location:?user=catalogue&err=100');
                }
            }
	}
        
        if (isset($_SESSION['panier']) && count($_SESSION['panier']) > 0)
        {
            $page['panier'] = array();
            foreach($_SESSION['panier'] as $idMedia)
            {
                $media = ModelMedia::getAll($idMedia);
                $nouveauMedia = new Media(current($media));
                array_push($page['panier'], $nouveauMedia);
            }
        }