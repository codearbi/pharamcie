<?php 
require_once 'model/modelConn.php';
require_once 'model/modelStk.php';
require_once 'model/modelVent.php';
require_once 'db.php';
class contVent{
    public $modConn;
    public $modstk;
    public $modV;
    public function __construct($db){
    $this->modConn = new modConn($db); 
    $this->modstk = new stock($db); 
    $this->modV = new Vent($db);
     }
    public function histV(){ //historique vent 1 mois
        if (isset($_SESSION['nom'])) {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $this->modV->id_m=htmlspecialchars(strip_tags($_POST['cab']));
                $E_V=$this->modV->exist();// medicament vendu ou nn
                if (!empty($E_V)) {
                    $Tot_V=$this->modV->totV(); //totale chiffres vente d un medicament
                    $D=$Tot_V/1000;  //vente en dinars
                    $Q_T=$this->modV->histV(); // total quantité vendu d un medicament
                }else {
                    $error='medicament non vendu';
                }
            }include_once 'view/vent/histV.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
    public function histVA(){//histrique 1 ans
        if (isset($_SESSION['nom'])) {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $this->modV->id_m=htmlspecialchars(strip_tags($_POST['cab']));
                $E_V=$this->modV->exist();// medicament vendu ou non
                if (!empty($E_V)) {
                    $Tot_V=$this->modV->totVA();
                    $D=$Tot_V/1000;
                    $Q_T=$this->modV->histVA();//quantité vendu
                }else{$error= 'medicament non vendu';}
            }include_once 'view/vent/histVA.php';
        }else {
            echo 'vous n avez pas le droit de se connecter';
        }
    }
 
 public function ventM(){ //fonction vente
        if (isset($_SESSION['nom'])) {
            if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['prevu'])) {//prevoir le prix
                $cab=$this->modV->id_m = (filter_input(INPUT_POST,'cab', FILTER_VALIDATE_INT));
                $qte=$this->modV->qte= filter_input(INPUT_POST,'qte',FILTER_VALIDATE_INT);
                $nom=$this->modV->nom_m=filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING);
                $this->modstk->cab= $cab;
                $this->modstk->quantite= $qte;
                $Stock=$this->modstk->exist(); //fonction de mettre les valeur de medicament en variable s 'il existe 
                if($Stock!==false){//verifier medicament existe ou nn
                        if($nom == $Stock['nom']){//verifier que le saisie est correcte
                            if ($Stock['quantite']>$qte) {//verifier la quantité existante suffisante
                               $this->modV->vent_T= ($qte * $Stock['prix']);//calcul le champ prix total
                               $D= $this->modV->vent_T/1000;//change le prix en dinars
                               $prevu=[
                               'cab' => $cab,
                               'nom'=> $nom,
                               'qte'=> $qte,
                               'prix_T'=>$D,
                           ] ; //mettre les donnés dans session
                           }
                           else{$error= 'stock '.$Stock['nom'].' insuffisant, stock disponible est '
                            .$Stock['quantite'].' piece(s)';}
                        }else{$error='donné incorrect';}
                }else{$error = 'medicament inexistant';}     
            }
            if ($_SERVER['REQUEST_METHOD']=='POST'&& isset($_POST['confirmer'])) {
                $cab=$this->modV->id_m = filter_input(INPUT_POST,'cab', FILTER_VALIDATE_INT);
                $qte=$this->modV->qte= filter_input(INPUT_POST,'qte',FILTER_VALIDATE_INT);
                $nom=$this->modV->nom_m= htmlspecialchars(strip_tags(
                filter_input(INPUT_POST,'nom',FILTER_SANITIZE_STRING)));
                $this->modV->matricule= htmlspecialchars($_SESSION['matricule']);
                $this->modstk->cab= $this->modV->id_m;
                $this->modstk->quantite= $this->modV->qte;
                $Stock=$this->modstk->exist(); //fonction de mettre les valeur de medicament en variable s 'il existe 
                if(isset($Stock)){
                    if($this->modV->nom_m == $Stock['nom']){
                       if ($Stock['quantite']>$this->modV->qte) {
                               $this->modV->vent_T= ($this->modV->qte * $Stock['prix']);//calcul le champ prix total
                               $D= $this->modV->vent_T/1000;
                               $this->modV->ventM(); //fonction d ajout le vent a la base de donné
                               $this->modstk->updateV();//fonction de mis a jour le stock
                               $_SESSION['vente']= $this->modV->qte.' piece(s) '.$this->modV->nom_m.
                               ' vendu avec succée à '.$D.' dinars';
                               header('location: index.php?action=ventM');
                               exit(); }else
                        {$error= 'stock inferieur à '.$this->modV->qte.' pieces, disponible : '.$Stock['quantite'];} 
                    }else{$error = 'verifier votre medicament';}
                }else{$error= 'article inexistant';}
            } require_once 'view/vent/vent.php'; 
        }else {echo 'vous n avez pas le droit de se connecter';}
    } 
    public function Pvendu(){ //le plus vendu 
        if (isset($_SESSION['nom'])){
            if ($_SERVER['REQUEST_METHOD']=='GET') {
                $plusvendu= $this->modV->MPVA();
            }include 'view/vent/plusV.php';
        }
    }
    public function ca(){//chiffre d affaire de jour / fontionnaire
        if (isset($_SESSION['role'])&& $_SESSION['role']=='admin') {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $matricule= filter_input(INPUT_POST,'matricule', FILTER_VALIDATE_INT);
                $this->modConn->matricule=$this->modV->matricule=$matricule;
                $fonct=$this->modConn->exist();
                $caM=$this->modV->caF();
                if (!empty($fonct)) {
                    if($caM!==false){
                        $caD=$caM/1000;
                    }else{$error='0000 dinars';}
                }else{$error ='fonctionnaire inexistant';}
            }include_once 'view/vent/ca.php';
        }
    }
    public function getChiffreTest($date){
                $today=date('Y-m-d');
                $this->modV->date=htmlspecialchars($date);
                if(empty($date)){
                    return ['error'=>'champ date vide'];
                }
                if($date>$today){
                    return ['error'=>'date erroné'];
                }
                $caj=$this->modV->ca_Jour();
                if (empty($caj)) {
                    return ['error'=>'journée '.$date.' inexistant'];
                }
               return ['msg'=> 'chiffre d affaire de '.$date.' est '.$caj.' millimes'];
    }
    public function ca_J(){//chiffre d affaire de pharmacie /jour 
        $result=[];
        if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
            if ($_SERVER['REQUEST_METHOD']=='POST') {
                $date=htmlspecialchars($_POST['date']);
                $result=$this->getChiffreTest($date);
                }      // Passer les résultats à la vue
                if (isset($result['error'])) {
                    $error = $result['error'];
                }
                if (isset($result['msg'])) {
                    $msg = $result['msg'];
                }
                include_once 'view/vent/ca_Jour.php';
        } }
        public function ca_P(){//chiffre d affaire par periode
            if (isset($_SESSION['role']) && $_SESSION['role']=='admin') {
                if ($_SERVER['REQUEST_METHOD']=='POST') {
                    $date=htmlspecialchars(strip_tags($_POST['date']));
                    $dateF=htmlspecialchars(strip_tags($_POST['dateF']));
                    $this->modV->date=$date;
                    $this->modV->dateF=$dateF;
                    $caP=$this->modV->ca_P();
                    if($caP!==false){
                        $msg=$caP/1000;
                    }else{$error='0000 dinars';}
                }include_once 'view/vent/CaPeriode.php';
            }
        }
     }
    