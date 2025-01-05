<?php 
class Vent{
    private $conn;
    public $id_m;
    public $nom_m;
    public $matricule;
    public $qte;
    public $vent_T;
    public $date;
    public $dateF;
    public function __construct($db){
        $this->conn = $db;
    }
    public function ventM(){ //vente medicament
       $stm=$this->conn->prepare('INSERT INTO vente(id_m, nom_m, matricule, qte, vent_T, date)
       VALUES (:id, :n_m, :matricule, :qte, :prix_T, now())');
       $stm->bindParam(':id',$this->id_m);
       $stm->bindParam(':n_m',$this->nom_m);
       $stm->bindParam(':qte',$this->qte);
       $stm->bindparam(':matricule',$this->matricule);
       $stm->bindParam(':prix_T',$this->vent_T);
       $stm->execute();
    }
    public function histV(){ //historique vente d un medicament durant un mois
        $stm=$this->conn->prepare('SELECT SUM(qte) FROM vente WHERE id_m= :cab 
        AND date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)');
        $stm->bindParam(':cab',$this->id_m);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function histVA(){ //historique vente durant une année
        $stm=$this->conn->prepare('SELECT SUM(qte) FROM vente WHERE id_m= :cab 
        AND date >= DATE_SUB(CURRENT_DATE, INTERVAL 360 DAY)');
        $stm->bindParam(':cab',$this->id_m);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function exist(){//verifier si medicament vendu ou nn
        $stm=$this->conn->prepare('SELECT * FROM vente WHERE id_m= :cab');
        $stm->bindParam(':cab',$this->id_m);
        $stm->execute();
        return $stm->fetch(PDO::FETCH_ASSOC) ?: [];
    }
    public function totV(){ //total vente mensuelle d un medicament
        $stm=$this->conn->prepare('SELECT SUM(vent_T) FROM vente WHERE id_m= :cab
        AND date >= DATE_SUB(CURRENT_DATE, INTERVAL 30 DAY)');
        $stm->bindParam(':cab',$this->id_m);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function totVA(){//total vente annuel
        $stm=$this->conn->prepare('SELECT SUM(vent_T) FROM vente WHERE id_m= :cab
        AND date >= DATE_SUB(CURRENT_DATE, INTERVAL 365 DAY)');
        $stm->bindParam(':cab',$this->id_m);
        $stm->execute();
        return $stm->fetchColumn();
    }
    public function MPVA(){//le 5 mediament le plus vendu / an  
        $stm=$this->conn->prepare('SELECT id_m, nom_m, SUM(qte)AS total_vente
         FROM vente WHERE date >= DATE_SUB(current_DATE, INTERVAL 365 DAY)
         GROUP BY id_m, nom_m ORDER BY total_vente DESC LIMIT 5');
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
    public function caF(){//chiffre d affaire par fonctionnaire /jour
        $stm=$this->conn->prepare('SELECT SUM(vent_T)as ca FROM vente WHERE matricule = :matricule 
        AND date= CURDATE()');
        $stm->bindParam(':matricule',$this->matricule);
        $stm->execute();
        if(!empty($stm)){
            return $stm->fetchColumn();}
            else{return false;}
    }
    public function ca_Jour(){ //chiffre d affaire de jour 
        $stm=$this->conn->prepare('SELECT SUM(vent_T)as ca FROM vente WHERE date= :date');
        $stm->bindParam(':date',$this->date);
        $stm->execute();
            return $stm->fetchColumn();
    }
    public function ca_P(){//chiffre d affaire d une periode
        $stm=$this->conn->prepare('SELECT SUM(vent_T)as ca FROM vente WHERE date BETWEEN :date1 AND :date2');
        $stm->bindParam(':date1',$this->date);
        $stm->bindParam(':date2',$this->dateF);
        $stm->execute();
        return $stm->fetchColumn();
    }
}