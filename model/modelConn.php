<?php 
class modConn{
    private $conn;
    public $matricule;
    public $n_prenom;
    public $password;
    public $role;
    
    public function __construct($db){
        $this->conn= $db;
    }

    public function exist(){//cherche fonctionnaire
        $stm=$this->conn->prepare('SELECT * FROM fonctionnaire WHERE matricule= :matricule');
        $this->matricule= htmlspecialchars(strip_tags($this->matricule));
        $this->password= htmlspecialchars(strip_tags($this->password));
        $stm->bindParam(':matricule',$this->matricule);
        $stm->execute();
        return $stm->fetch();
    }
    public function addF(){//ajouter fonctionnaire
        $stm= $this->conn->prepare('INSERT INTO fonctionnaire(n_prenom, password, role)VALUE(:n_prenom, :password, :role)');
        $this->n_prenom= htmlspecialchars(strip_tags($this->n_prenom));
        $this->password= htmlspecialchars(strip_tags($this->password));
        $this->password= password_hash($this->password,PASSWORD_DEFAULT);
        $stm->bindParam(':n_prenom',$this->n_prenom);
        $stm->bindParam(':password',$this->password);
        $stm->bindParam(':role',$this->role);
        if($stm->execute()){
            return true;
        }
    }
    public function supF(){//suuprimer fonctionnaire
        $stm=$this->conn->prepare('DELETE FROM fonctionnaire WHERE matricule= :matricule');
        $this->matricule=htmlspecialchars(strip_tags($this->matricule));
        $stm->bindParam(':matricule',$this->matricule);
        if($stm->execute()){
            return true;
        }
    }
    public function bloqF(){//bloquer fonctionnaire
        $stm= $this->conn->prepare('UPDATE fonctionnaire SET password = "" WHERE matricule= :matricule');
        $stm->bindParam(':matricule',$this->matricule);
        return $stm->execute();
    }
    public function affF(){//afficher tous les fonctionnaires
        $stm=$this->conn->prepare('SELECT * FROM fonctionnaire');
        $stm->execute();
        return $stm->fetchAll(PDO::FETCH_ASSOC);
    }
}    