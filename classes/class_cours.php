<?php
require_once('database.php');

class Cours
{
    // private $db;
    private $titre;
    private $description;
    private $image_url;
    private $categorie_id;
    private $prix;

    public function __construct($titre, $description, $image_url, $categorie_id, $prix)
    {
        // $this->db = Database::getInstance()->getConnection();
        $this->titre = $titre;
        $this->description = $description;
        $this->image_url = $image_url;
        $this->categorie_id = $categorie_id;
        $this->prix = $prix;
    }

    public function save()
    {
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO cours (titre, description, image_url, categorie_id, prix) 
                              VALUES (:titre, :description, :image_url, :categorie_id, :prix)");

            $stmt->bindParam(':titre', $this->titre, PDO::PARAM_STR);
            $stmt->bindParam(':description', $this->description, PDO::PARAM_STR);
            $stmt->bindParam(':image_url', $this->image_url, PDO::PARAM_STR);
            $stmt->bindParam(':categorie_id', $this->categorie_id, PDO::PARAM_INT);
            $stmt->bindParam(':prix', $this->prix, PDO::PARAM_STR);

            return $stmt->execute();
        } catch (PDOException $e) {
            echo "Erreur lors de l'ajout du cours : " . $e->getMessage();
            return false;
        }
    }

    public static function showAllcours()
    {
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT * FROM vue_cours";
            $stmt = $db->prepare($req);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des cours : " . $e->getMessage();
            return [];
        }
    }

    public function totalcours()
    {
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT COUNT(*) as total FROM cours";
            $stmt = $db->prepare($req);
            $stmt->execute();
            return $stmt->fetch(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors du comptage des cours : " . $e->getMessage();
            return [];
        }
    }

    public function pagination($page)
    {
        $db = Database::getInstance()->getConnection();
        $parpage = 6;
        $premier = ($page * $parpage) - $parpage;

        try {
            $req = "SELECT * FROM cours LIMIT :premier, :parpage";
            $stmt = $db->prepare($req);
            $stmt->bindParam(':premier', $premier, PDO::PARAM_INT);
            $stmt->bindParam(':parpage', $parpage, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des cours paginés : " . $e->getMessage();
            return [];
        }
    }
}
