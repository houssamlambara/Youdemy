<?php

include_once('database.php');

// class tag implements JsonSerializable
// {
//     private $id;
//     private $nom;

//     public function __construct($nom, $id = null)
//     {
//         $this->id = $id;
//         $this->nom = $nom;
//     }

//     public function __toString()
//     {
//         return $this->id . " " . $this->nom;
//     }

//     public function jsonSerialize() :array{
//         return [
//             'id' => $this->id,
//             'nom' => $this->nom
//         ];
//     }

 
//     public function getId()
//     {
//         return $this->id;
//     }

//     public function getNom()
//     {
//         return $this->nom;
//     }

//     public function save()
//     {
//         try {
//             $db = Database::getInstance()->getConnection();

//             $stmt = $db->prepare("INSERT INTO tags (nom) VALUES (:nom)");

//             $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);

//             if ($stmt->execute()) {
//                 $this->id = $db->lastInsertId();
//                 return true;
//             } else {
//                 echo "Erreur lors de l'exécution de la requête : " . $stmt->errorInfo()[2];
//             }

//             return false;
//         } catch (PDOException $e) {
//             throw new Exception("Erreur lors de l'ajout de la catégorie : " . $e->getMessage());
//         }
//     }

//     public static function getAllTags()
//     {
//         $db = Database::getInstance()->getConnection();
//         try {
//             $req = "SELECT id, nom FROM tags";
//             $stmt = $db->prepare($req);
//             $stmt->execute();
//             return $stmt->fetchAll(PDO::FETCH_ASSOC);  
//         } catch (PDOException $e) {
//             echo "Erreur lors de la récupération des tags : " . $e->getMessage();
//             return [];
//         }
//     }


//     public static function delete($id)
//     {
//         try {
//             $db = Database::getInstance()->getConnection();
//             $stmt = $db->prepare("DELETE FROM tags WHERE id = :id");
//             $stmt->bindParam(':id', $id, PDO::PARAM_INT);
//             return $stmt->execute();
//         } catch (PDOException $e) {
//             throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
//         }
//     }
// }



class tag implements JsonSerializable
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

    public function jsonSerialize() : array
    {
        return [
            'id' => $this->id,
            'nom' => $this->nom
        ];
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

    // Pour récupérer uniquement le nom du tag
    public function getTag()
    {
        return $this->nom;
    }

    public function save()
    {
        try {
            $db = Database::getInstance()->getConnection();

            $stmt = $db->prepare("INSERT INTO tags (nom) VALUES (:nom)");

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

    public static function getAllTags()
    {
        $db = Database::getInstance()->getConnection();
        try {
            $req = "SELECT id, nom FROM tags";
            $stmt = $db->prepare($req);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);

            // On crée des objets tag à partir des résultats
            $tags = [];
            foreach ($result as $row) {
                $tags[] = new tag($row['nom'], $row['id']);
            }
            return $tags;
        } catch (PDOException $e) {
            echo "Erreur lors de la récupération des tags : " . $e->getMessage();
            return [];
        }
    }

    public static function afficheTag()
    {
        $tags = self::getAllTags();
        return $tags;
    }

    public static function delete($id)
    {
        try {
            $db = Database::getInstance()->getConnection();
            $stmt = $db->prepare("DELETE FROM tags WHERE id = :id");
            $stmt->bindParam(':id', $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            throw new Exception("Erreur lors de la suppression de la catégorie : " . $e->getMessage());
        }
    }
}



