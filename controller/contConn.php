<?php 
require_once 'model/modelConn.php';
require_once 'model/modelStk.php';
require_once 'model/modelVent.php';
require_once 'db.php';

class contConn{
    public $modConn;
    public $modstk;
    public $modV;
    public function __construct($db){
    $this->modConn = new modConn($db); 
    $this->modstk = new stock($db); 
    $this->modV = new Vent($db);
     }
    public function connect(){ //connexion fonctionnaire 
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            if (!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'],
             $_POST['csrf_token'])) {
                session_regenerate_id(true);//Cette fonction régénère l'ID de la session courante. 
                //En passant true comme argument, elle supprime l'ancienne session,
                // garantissant ainsi que l'ancienne ID de session ne soit plus valide.
                $error = 'Requête invalide.';
                $_SESSION['error'] = $error;
                include 'view/login.php';
                exit();
            }           
            $this->modConn->matricule= htmlspecialchars(strip_tags($_POST['matricule']));
            $this->modConn->password=htmlspecialchars(strip_tags($_POST['pwd']));
            $this->modConn->role=htmlspecialchars(strip_tags($_POST['role']));
            $fonctionnaire=$this->modConn->exist();
            if (isset($fonctionnaire)&&!empty($fonctionnaire)) {
                if (password_verify($this->modConn->password, $fonctionnaire['password'])
                && $this->modConn->role==$fonctionnaire['role']) {
                    session_regenerate_id(true);
                        $_SESSION['nom']=$fonctionnaire['n_prenom'];
                        $_SESSION['role']=$fonctionnaire['role'];
                        $_SESSION['matricule']=$fonctionnaire['matricule'];
                        header('location: index.php?action=accueil');
                        exit();   
                }else{$error= 'donnés incorrect';}
            }else{$error= 'fonctionnaire inexistant';}
        }
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        } include 'view/login.php';
    }
    public function addF(){ //ajout fonctionnaire
      if (isset($_SESSION)&& $_SESSION['role']=='admin') {
        if ($_SERVER['REQUEST_METHOD']=='POST') { 
        if(!isset($_POST['csrf_token']) || !hash_equals($_SESSION['csrf_token'],
        $_POST['csrf_token'] )){
            session_regenerate_id(true);
            $error = 'requete invalide';
            include 'view/fonctionnaire/ajouterF.php';
            exit(); 
        }
        $pwd=htmlspecialchars(strip_tags($_POST['pwd']));
        $pwd1=htmlspecialchars(strip_tags($_POST['pwd1']));
            if ($pwd===$pwd1) {
            $this->modConn->n_prenom= $_POST['nom'];
            $this->modConn->password= $pwd1;
            $this->modConn->role= $_POST['role'];
            if($this->modConn->addF()){
                header('location: index.php?action=ajoutF');
                $_SESSION['msg']=$this->modConn->n_prenom.' ajouté avec succés';
                exit();  }
        }else{$error= 'mot de passe non confondu';}
      }
      if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token']= bin2hex(random_bytes(32));
      }
      include 'view/fonctionnaire/ajouterF.php'; 
    }else{echo 'veuillez contacter le directeur pour vous creer un compte admin';}
   }

   public function suppF(){ //suppression d un fonctionnaire
    if(isset($_SESSION['role']) && $_SESSION['role']=='admin'){
    if ($_SERVER['REQUEST_METHOD']== 'POST') {
        if(!isset($_SESSION['csrf_token']) || !hash_equals($_SESSION['csrf_token'],
        $_POST['csrf_token'])){
            session_regenerate_id(true);
            $error = 'requete invalide';
            include 'view/fonctionnaire/supF.php';
            exit();
        }
        $this->modConn->matricule= $_POST['matricule'];
        if($this->modConn->exist()){
            $f= $this->modConn->exist();
        if($f['role']!== 'admin'){
        if ($this->modConn->supF()) {
            $_SESSION['message']= $f['n_prenom'].' supprimé avec succés';
        }else {
            $error = 'probleme de suppression';
        } }else { $error = 'vous pouvez pas supprimer un admin';
        }
        }else {  $error = 'matricule inexistante';}
    } 
    if(empty($_SESSION['csrf_token'])){
        $_SESSION['csrf_token']=bin2hex(random_bytes(32));
    }
    require_once 'view/fonctionnaire/supF.php';
  
   }}
   public function bloqF(){ //fonction blocage d un fonctionnaire
    if (isset($_SESSION)&&$_SESSION['role']=='admin') {
        if ($_SERVER['REQUEST_METHOD']=='POST') {
            $this->modConn->matricule= htmlspecialchars(strip_tags($_POST['matricule']));
            if ($this->modConn->exist()) {
                $f=$this->modConn->exist();
                if($f['role'] !== 'admin'){
                    if ($f['password']==NULL) {
                    $error = 'Fonctionnaire déja bloqué';
                    }else{
                        if ($this->modConn->bloqF()) {
                        $_SESSION['msg']=$f['n_prenom'].' bloqué avec succé';
                        header('location: index.php?action=bloqF');
                        exit();
                        }else{$error='erreur lors de blocage';}
                    }
                }else{$error= 'vous pouvez pas bloqué un admin';}
          }else{$error='matricule inexistante';}
        }require_once 'view/fonctionnaire/blaqueF.php';
    }
}
        public function afficheF(){ //affiche fonctionnaire
            if (isset($_SESSION['role'])) {
                if (isset($_SERVER['REQUEST_METHOD'])== 'GET') {
                    $f=$this->modConn->affF();
                }include_once 'view/fonctionnaire/afficherF.php';
            }
        }

   public function out(){ //fonction de deconnxion
    session_destroy();
    header('location: index.php?action=login');
   }
   public function accueil(){ //afiche l acceuil
    if(isset($_SESSION['nom'])){
        include_once 'view/acceuil.php';
    }else {
        echo 'vous n avez pas le droit de se connecter';
    }
   }
}