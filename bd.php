<?php
try
{
    $bdd = new PDO('mysql:host=localhost;dbname=exoformulcontact', 'root', '');  

}
catch (Exception $e)      
{
    die('Erreur : ' . $e->getMessage());
}
?>