<?php 
ini_set('session.cookie_httponly', 1);//Cette directive configure le paramètre session.cookie_httponly de PHP, qui détermine si le cookie de session doit être accessible uniquement via le protocole HTTP et non via JavaScrip
ini_set('session.use_only_cookies', 1);//Cette directive configure le paramètre session.use_only_cookies de PHP, qui force l'utilisation des cookies pour stocker l'ID de session, empêchant l'utilisation d'autres mécanismes tels que les paramètres d'URL
ini_set('display_errors', 1);//Cette directive configure le paramètre display_errors de PHP, qui détermine si les erreurs PHP doivent être affichées directement dans la sortie (typiquement le navigateur).
ini_set('display_startup_errors', 1);//Cette directive configure le paramètre display_startup_errors de PHP, qui détermine si les erreurs survenues lors du démarrage de PHP doivent être affichées.
error_reporting(E_ALL);//Cette fonction définit le niveau de rapport d'erreurs de PHP. E_ALL signifie que toutes les erreurs, avertissements et notices seront rapportés.
if (session_status() == PHP_SESSION_NONE ) {
    session_start();
}
$error= '';
require_once 'controller/contConn.php';
require_once 'controller/contStock.php';
require_once 'controller/contVent.php';
require_once 'controller/route.php';
$conn= new contConn($db);
$conS= new contStock($db);
$conV= new contVent($db);
// Récupérer l'action depuis l'URL, sinon par défaut 'login'
$action = (isset($_GET['action']) ? $_GET['action'] : 'login');
$router = new Router;
//tableau routeur associatif
$routes = [
    'login' => [$conn, 'connect'],
    'ajoutF' => [$conn, 'addF'],
    'affiF' =>[$conn, 'afficheF'],
    'supF' => [$conn, 'suppF'],
    'bloqF' => [$conn,'bloqF'],
    'ajoutM' =>[$conS, 'ajoutM'],
    'ajoutS' =>[$conS, 'ajoutS'],
    'accueil' =>[$conn, 'accueil'],
    'voirM' =>[$conS, 'voirM'],
    'TM' =>[$conS, 'tousMM'],
    'TMN' =>[$conS, 'tousMM'],
    'voirN' =>[$conS, 'voirN'],
    'voirC'=>[$conS, 'voirC'],
    'ventM'=>[$conV, 'ventM'],
    'PV'=>[$conV, 'Pvendu'],
    'histV'=>[$conV, 'histV'],
    'histVA'=>[$conV, 'histVA'],
    'ca'=>[$conV, 'ca'], 
    'ca_J'=>[$conV, 'ca_J'],
    'venteP'=>[$conV, 'ca_P'],
    'alertS'=>[$conS, 'alertS'],
    'out'=>[$conn, 'out'],
];
$router->setRoutes($routes);
$router->dispatch($action);
?>