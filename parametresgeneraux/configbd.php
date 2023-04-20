<?php
     try{
             $bdd = new PDO('mysql:host=localhost;dbname=meteoredatabase','root',''); }   
 
             catch (Exception $e)
    {
      die('Erreur : ' . $e->getMessage());
    }
 ?>