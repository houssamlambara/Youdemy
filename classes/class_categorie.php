<?php

include_once('database.php');

class Categorie
{
    private $id;
    private $nom;

    public function __construct($nom, $id = null)
    {
        $this->id = $id;
        $this->nom = $nom;
    }

    public function __toString()
    {
        return $this->id . " " . $this->nom;
    }

    // Getters
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
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO categories (nom) VALUES (:nom)");

            $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);

            if ($stmt->execute()) {
                $this->id = $db->lastInsertId();  
                return true;
            } else {
                echo "Erreur lors de l'exécution de la requête : " . $stmt->errorInfo()[2];
            }

            return false;
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
        }
    }

    public static function getAll()
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->query("SELECT * FROM categories");
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la récupération des catégories : " . $e->getMessage());
        }
    }

    public static function delete($id)
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM categories WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }
}
