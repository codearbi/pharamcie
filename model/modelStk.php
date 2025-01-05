<?php 
class stock{
    private $conn;
    public $cab;
    public $nom;
    public $categorie;
    public $quantite;
    public $prix;
    public function __construct($db){
        $this->conn= $db;
    }
    
    public function ajoutM(){ //ajout medicament
        $stm=$this->conn->prepare('INSERT INTO medic (cab, nom, categorie, quantite, prix)
        VALUE(:cab,:nom, :categ, :quantite, :prix)');
        $stm->bindParam(':cab',$this->cab);
        $stm->bindParam(':nom',$this->nom);
        $stm->bindParam(':categ',$this->categorie);
        $stm->bindParam(':quantite',$this->quantite);
        $stm->bindParam(':prix',$this->prix);
        if ($stm->execute()) {
            return true;
        }
    }
    public function updateS(){ //mis a jour stock lors d approvisionnement
        $stm= $this->conn->prepare('UPDATE medic 
        SET quantite = quantite + :quantite WHERE cab = :cab ');
        $this->cab= htmlspecialchars(strip_tags($this->cab));
        $this->quantite= htmlspecialchars(strip_tags($this->quantite));
        $stm->bindParam(':cab',$this->cab);
        $stm->bindParam(':quantite',$this->quantite);
        if ($stm->execute()){
            return true;
        }
    }
    public function exist(){ //verifier si medicament existe 
        $stm=$this->conn->prepare('SELECT * FROM medic where cab =:cab');
        $stm->bindParam(':cab',$this->cab);
        if($stm->execute()){
            if (!empty($stm)){
                return $stm->fetch(pdo::FETCH_ASSOC); }else{
                    return false;
                }
        }
    }

    public function tousM(){ //voir medicament trier par stock existe
        $stm=$this->conn->prepare('SELECT * FROM medic ORDER BY quantite ASC');
        $stm->execute();
        return $stm->fetchall(PDO::FETCH_ASSOC);
    }
    public function tousMN(){//voir medicament tri par nom
        $stm=$this->conn->prepare('SELECT * FROM medic ORDER BY nom ASC');
        $stm->execute();
        return $stm->fetchall(PDO::FETCH_ASSOC);
    }
    public function recherN(){//rechercher medicament par nom
        $stm=$this->conn->prepare('SELECT * FROM medic WHERE nom=:nom'); 
        $stm->bindParam('nom',$this->nom);
        if ($stm->execute()) {
            return $stm->fetch(PDO::FETCH_ASSOC);
        }else {
            return $error='probleme requete';
        }
    }
    public function recherM(){//rechercher medicament par cab
        $stm=$this->conn->prepare('SELECT * FROM medic WHERE cab=:cab'); 
        $stm->bindParam(':cab',$this->cab);
        if ($stm->execute()) {
            return $stm->fetch(PDO::FETCH_ASSOC);
        }else {
            return $error='probleme requete';
        }
    }
    public function recherC(){//voir le medicament par categorie
        $stm=$this->conn->prepare('SELECT * FROM medic WHERE categorie= :categ');
        $this->categorie= htmlspecialchars(strip_tags($this->categorie));
        $stm->bindParam(':categ',$this->categorie);
        if ($stm->execute()) {
            return $stm->fetchall(pdo::FETCH_ASSOC);
        }
    } 
    public function updateV(){//mis a jour stock suite vente
        $stm= $this->conn->prepare('UPDATE medic SET quantite = quantite-:quantite WHERE cab= :cab');
        $stm->bindParam(':cab',$this->cab);
        $stm->bindParam(':quantite',$this->quantite);
        $stm->execute();
    }
    
}