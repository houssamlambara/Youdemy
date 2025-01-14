<?php
require_once ('database.php');

class Cours {
    private $titre;
    private $description;
    private $image_url;
    private $categorie_id;
    private $prix;

    public function __construct($titre, $description, $image_url, $categorie_id, $prix) {
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

}
