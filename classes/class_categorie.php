<?php

include_once('database.php');

class categorie
{
    private $id;
    private $nom;


    public function __construct($id, $nom)
    {
        $this->id = $id;
        $this->nom = $nom;
    }
    public function __toString()
    {
        return $this->id . " " . $this->nom;
    }

    public function getId()
    {
        return $this->id;
    }
    public function getNom()
    {
        return $this->nom;
    }

    public function save()
    {
        try{
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO categorie (nom) VALUES (:nom)");
            $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
            $stmt->execute();
            $this->id = $db->lastInsertId(); 


            if ($stmt->execute()) {
                return true;
            }
            return false;
        }catch (PDOException $e){
            throw new Exception("Erreur lors de l'ajout du thème : " . $e->getMessage());
        }
    }
}
