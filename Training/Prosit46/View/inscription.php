<!DOCTYPE html>
<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <title>Vous inscrire ?</title>
    </head>
    <body>
        
        <form method="POST" action="inscription.php">
            <input type="text" name="pseudo" placeholder="Votre Pseudo..." />
            <input type="password" name="pswd" placeholder="Votre Mot de Passe..." />
            <input type="password" name="confPswd" placeholder="Retapez votre mot de passe"/>
            <input type="submit" value="S'inscrire !" />
        </form>
        <?php
        
            include_once '../Model/connexion_sql.php';
            $rep = $bdd->prepare('INSERT INTO `user`(`USER_NAME`, `USER_PWD`) VALUES (:newName,:newPswd)');
            
            if(isset($_POST['pseudo']) && isset($_POST['pswd']) 
                    && isset($_POST['confPswd']))
            {
                if($_POST['pseudo'] != '' && $_POST['pswd'] != '' 
                                && ($_POST['pswd'] == $_POST['confPswd']))
                {
                    $newName = strip_tags($_POST['pseudo']);
                    $newPswd = sha1(strip_tags($_POST['pswd']));
                    $rep->execute(array('newName' => $newName,'newPswd' => $newPswd));
                    header('Location: index.php');                
                }
                else
                {
                    echo 'Il y a des erreurs dans votre pseudo ou votre mot de passe !!<br />';
                    echo '<a href="index.php">Retour</a>';
                }

            }
        ?>
    </body>
</html>
