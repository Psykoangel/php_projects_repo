<?php
global $bdd;

try
{
    $bdd = new PDO('mysql:host=localhost;dbname=test', 'root', '');
}
catch (Exeption $e)
{
    die('Erreur: '.$e->getCode() . ' ' . $e->getMessage());
}

