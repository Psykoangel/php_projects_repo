<?php

include_once '../Model/authentification.php';

if(isset($_POST['pseudo']) && isset($_POST['password']))
{
    $pseudo = strip_tags($_POST['pseudo']);
    $passH = sha1(strip_tags($_POST['password']));
    
    $per = authentification($pseudo, $passH);
    
    if($per)
    {
        session_start();
        $_SESSION['USER_ID'] = $per['id'];
        $_SESSION['USER_PSEUDO'] = $pseudo;
    }  
}

include_once '../View/index.php';
?>


