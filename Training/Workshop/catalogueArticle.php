<?php
    include_once 'member.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <link rel="stylesheet" href="style.css" />
        <title></title>
    </head>
    <body>
        <?php
//        Ne fonctionne que si connecter n'est pas activer ...
        try
        {
            $bdd = new PDO('mysql:host=localhost;dbname=storedb', 'root', '');
        }
        catch(Exception $e)
        {
            die('Erreur : '.$e->getMessage());
        }
        if(!isset($_SESSION['pseudo']))
        {
            if(isset($_POST['pseudoIN']) && isset($_POST['modepassIN']))
            {
                $membreIN = new Member();
                $membreIN->setPseudo(strip_tags($_POST['pseudoIN']));
                $membreIN->setMdp($_POST['modepassIN']);

                $test = false;
                $req = $bdd->prepare('SELECT id_membre FROM membre WHERE login = :nom');
                $req->execute(array('nom' => $membreIN->getPseudo()));
                $per = $req->fetch();
                if($per)
                {
                    $test = true;
                }

                    if($membreIN->getPseudo() != '' && $membreIN->getMdp() != '')
                    {
                        if(!$test)
                        {
                            session_start();
                            $req = $bdd->prepare('INSERT INTO membre (login, mdp) VALUES(:nom, :modepass)');
                            $req->execute(array('nom' => $membreIN->getPseudo(), 'modepass' => $membreIN->getMdp()));
                            $_SESSION['pseudo'] = $membreIN->getPseudo();
                            echo 'Bonjour ' . $membreIN->getPseudo() . ' !!';
                        }
                        else
                        {
                            echo 'Login déjà existant !!';
                            echo '<a href="index.php">Retour</a>';
                        }

                    }
                    else
                    {
                        echo 'Login ou Mot de passe manquant !';
                        echo '<a href="index.php">Retour</a>';
                    }            
            }   

    //          ne fonctionne pas ... 
            if(isset($_POST['pseudoCO']) && isset($_POST['modepassCO']))
            {
                $membreCO = new Member();      
                $membreCO->setPseudo(strip_tags($_POST['pseudoCO']));
                $membreCO->setMdp(strip_tags($_POST['modepassCO']));

                $test = false;
                $req = $bdd->prepare('SELECT id_membre FROM membre WHERE login = :nom AND mdp = :mdpass');
                $req->execute(array('nom' => $membreCO->getPseudo(), 'mdpass' => $membreCO->getMdp()));
                $per = $req->fetch();
                if($per)
                {
                    $test = true;
                }

                    if($membreCO->getPseudo() != '' && $membreCO->getMdp() != '')
                    {
                        if($test)
                        {
                            session_start();
                            $_SESSION['pseudo'] = $membreCO->getPseudo();
                            echo 'Bonjour ' . $membreCO->getPseudo() . ' !!';
                        }
                        else
                        {
                            echo 'mdp ou login incorrect !!';
                            echo '<a href="index.php">Retour</a>';
                        }
                    }
                    else
                    {
                        echo 'Login ou Mot de passe manquant !!';
                        echo '<a href="index.php">Retour</a>';
                    }
            }            
        }
        else
        {
            header('Location:index.php');
        }
        
        ?>
    </body>
</html>
