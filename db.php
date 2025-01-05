<?php 
try {
    $db=new PDO('mysql:host=localhost;dbname=pharmacie;charset=utf8','root','root',
    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION] );

} catch (Exception $e) {
    die('erreur '.$e->getMessage());
}