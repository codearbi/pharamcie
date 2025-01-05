<?php 
require_once 'model/modelConn.php';
require_once 'model/modelStk.php';
require_once 'model/modelVent.php';
require_once 'db.php';
class contStock{
    public $modConn;
    public $modstk;
    public $modV;
    public function __construct($db){
    $this->modConn = new modConn($db); 
    $this->modstk = new stock($db); 
    $this->modV = new Vent($db);
     }
     public function ajoutM(){ //ajoute un nouveau medicament
        if (isset($_SESSION)) {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $this->modstk->cab= htmlspecialchars(strip_tags($_POST['cab']));
                $this->modstk->nom= htmlspecialchars(strip_tags($_POST['nom']));
                $this->modstk->categorie= htmlspecialchars(strip_tags($_POST['categ']));
                $this->modstk->quantite= htmlspecialchars(strip_tags($_POST['quantite']));
                $this->modstk->prix= htmlspecialchars(strip_tags($_POST['prix']));
                $medic=$this->modstk->exist();
                if(empty($medic)){
                if ($this->modstk->ajoutM()) {
                    $msg= 'medicament '.$this->modstk->nom.' ajouté ';
                 } 
            }else {
                $error= 'medicament existe deja, vous devez accédez au rubrique 
                ajouter stock pour alimenter votre stock ';
            }
            }include_once 'view/stock/ajoutM.php';
       }else {
        echo 'vous n avez pas le droit de se connecter';
    }
    }
    public function ajoutS(){ //ajoute au stock un medicament deja existe
        if (isset($_SESSION['nom'])) {
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $cab=$this->modstk->cab= htmlspecialchars(strip_tags($_POST['cab']));
                $nom=$this->modstk->nom= htmlspecialchars(strip_tags($_POST['nom']));
                $categorie=$this->modstk->categorie= htmlspecialchars(strip_tags($_POST['categ']));
                $quantite=$this->modstk->quantite=htmlspecialchars(strip_tags($_POST['quantite']));
                $medic= $this->modstk->exist();
                if (!empty($medic)) {
                    if($medic['nom']===$nom&&$medic['categorie']===$categorie){
                    if ($this->modstk->updateS()) {
                        $_SESSION['msg']= $this->modstk->quantite.' pieces de '.$medic['nom'].' ajouté avec succés'; 
                        header('location: index.php?action=ajoutS');
                        exit();
                       }else{$error='probleme';}
                    }else{$error='verifier les donnés ';}
                }else{ $error = 'medicament inexistant';}
            }require_once 'view/stock/ajoutS.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
    public function voirM(){ //voir medicament par cab
       if (isset($_SESSION['nom'])) {
        if ($_SERVER['REQUEST_METHOD']== 'POST') {
            $this->modstk->cab= $_POST['search'];
            if ($this->modstk->exist()) {
                $M= $this->modstk->recherM();
            }else{$error= 'medicament inexistant';}
        }include_once 'view/stock/voirM.php';
       }else {
        echo 'vous n avez pas le droit de se connecter';
    }
    }
    public function voirN(){ //chercher medicament par nom
        if (isset($_SESSION['role']) ) {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $this->modstk->nom= htmlspecialchars(strip_tags($_POST['nom']));
                $M=$this->modstk->recherN();
                if (empty($M)) {
                    $error= 'medicament inexistant';
                }
            }include_once 'view/stock/voirN.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
    public function voirC(){ //voir medicament par categorie
        if (isset($_SESSION['nom'])) {
            if ($_SERVER['REQUEST_METHOD']== 'POST') {
                $this->modstk->categorie= $_POST['recherche'];
                $C=$this->modstk->recherC();
                if (empty($C)) {     
                    $error= 'categorie inexistante';
                }
            }include_once 'view/stock/voirC.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
    public function tousMM(){//voir tous les medicaments tri par quantite ou nom
        if (isset($_SESSION['nom'])) {
            if($_SERVER['REQUEST_METHOD']=='GET'){
                if($_GET['action']=='TM'){
                $T=$this->modstk->tousM(); }else{
                $T=$this->modstk->tousMN();}
            }include_once 'view/stock/tousS.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    } 
 
    public function alertS(){//verification les stocks critique
        if (isset($_SESSION['nom'])) {
            $s=$this->modstk->tousM();
            foreach($s as $sm){
                $this->modV->id_m=$sm['cab'];
                $v=$this->modV->histV();
                if(!empty($v)){
                    if (($sm['quantite']/$v)<1) {
                    $info[]=$sm;
                    }else{ $error= 'pas d alert';}
                }    
            }include_once 'view/stock/alertS.php';
    
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
    }