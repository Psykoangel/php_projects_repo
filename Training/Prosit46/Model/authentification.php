<?php 

function authentification($pseudo, $passH)
{
    include_once 'connexion_sql.php';
    global $bdd;
    $rep = $bdd->prepare('SELECT USER_ID FROM user WHERE USER_NAME= :nom AND USER_PWD= :motdepasse');
    $rep->execute(array(
                        'nom' => $pseudo,
                        'motdepasse' => $passH
    ));
    $per = $rep->fetch();
    
    return $per;
}