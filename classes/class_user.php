<?php

require_once('database.php');

class User
{
    private $id;
    private $nom;
    private $prenom;
    private $email;
    private $role;
    private $statut;
    private $passwordHash;

    public function __construct($id, $nom, $prenom, $email, $role, $passwordHash = null, $statut = 'En_attente')
    {
        $this->id = $id;
        $this->nom = $nom;
        $this->prenom = $prenom;
        $this->email = $email;
        $this->role  = $role;
        $this->statut = $statut;
        $this->passwordHash = $passwordHash;
    }

    public function __toString()
    {
        return $this->nom . " " . $this->prenom;
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
    public function getPrenom()
    {
        return $this->prenom;
    }
    public function getEmail()
    {
        return $this->email;
    }
    public function getrole()
    {
        return $this->role;
    }
    // Getter pour le statut
    public function getStatut()
    {
        return $this->statut;
    }

    // Setter pour le statut
    public function setStatut($statut)
    {
        $this->statut = $statut;
    }


    // Password hashing method
    private function setPasswordHash($password)
    {
        $this->passwordHash = password_hash($password, PASSWORD_BCRYPT);
    }

    // Save user to the database
    public function save()
    {
        $db = Database::getInstance()->getConnection();
        try {
            if ($this->id) {
                // Update user
                $stmt = $db->prepare("UPDATE users SET nom = :nom, prenom = :prenom, email = :email, role = :role, statut = :statut WHERE id = :id");
                $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':role', $this->role, PDO::PARAM_INT); // Enlevez l'espace après :role
                $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR); // Inclure le statut dans la mise à jour
                $stmt->execute();
            } else {
                // Hash the password before inserting
                if ($this->passwordHash === null) {
                    throw new Exception("Password is required for new users.");
                }

                // Insert new user
                $stmt = $db->prepare("INSERT INTO users (nom, prenom, email, password, role,statut) VALUES (:nom, :prenom, :email, :password, :role, :statut)");
                $stmt->bindParam(':nom', $this->nom, PDO::PARAM_STR);
                $stmt->bindParam(':prenom', $this->prenom, PDO::PARAM_STR);
                $stmt->bindParam(':email', $this->email, PDO::PARAM_STR);
                $stmt->bindParam(':role', $this->role, PDO::PARAM_INT); // Enlevez l'espace après :role
                $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
                $stmt->bindParam(':statut', $this->statut, PDO::PARAM_STR); // Insertion du statut
                $stmt->execute();
                $this->id = $db->lastInsertId(); // Set the new user ID
            }
            return $this->id;
        } catch (PDOException $e) {
            // Log the error message to the error log for debugging
            error_log("Database error: " . $e->getMessage());

            // Throw a new exception with the detailed SQL error message
            throw new Exception("An error occurred while saving the user. SQL error: " . $e->getMessage());
        }
    }
    public function validerEnseignant()
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET statut = 'Actif' WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Search user by name
    public function searchUserByName($name)
    {
        $db = Database::getInstance()->getConnection();

        // Prepare the SQL query
        $stmt = $db->prepare("SELECT * FROM users WHERE nom LIKE :name OR prenom LIKE :name");

        // Bind the parameter for name search (using wildcards for partial match)
        $stmt->bindValue(':name', '%' . $name . '%', PDO::PARAM_STR);

        // Execute the query
        $stmt->execute();

        // Fetch all matching users
        $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

        // Return an array of User objects
        $users = [];
        foreach ($results as $result) {
            $users[] = new User(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['password']
            );
        }

        return $users;
    }

    // Get user by ID
    public function getUserById($id)
    {
        $db = Database::getInstance()->getConnection();

        // Prepare the SQL query
        $stmt = $db->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();

        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User(
                $result['id'],
                $result['nom'],
                $result['prenom'],
                $result['email'],
                $result['password']
            );
        }

        return null; // User not found
    }

    // Static method to search user by email
    public static function findByEmail($email)
    {
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = :email");
        $stmt->bindParam(':email', $email, PDO::PARAM_STR);
        $stmt->execute();
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($result) {
            return new User($result['id'], $result['nom'], $result['prenom'], $result['email'], $result['role'], $result['password'], $result['statut']);
        }

        return null;
    }


    public static function signup($nom, $prenom, $email, $password, $role)
    {
        // Valider le format de l'email
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Format de l'email invalide");
        }

        // Valider la longueur du mot de passe
        if (strlen($password) < 3) {
            throw new Exception("Le mot de passe doit comporter au moins 3 caractères");
        }

        // Assainir les champs de nom
        $nom = htmlspecialchars($nom);
        $prenom = htmlspecialchars($prenom);

        // Vérifier si l'email existe déjà
        if (self::findByEmail($email)) {
            throw new Exception("Cet email est déjà enregistré");
        }

        // Définir le statut en attente pour les enseignants
        $statut = ($role == 3) ? 'En_attente' : 'Actif'; // Supposons que le rôle d'enseignant est 3

        // Créer un nouvel objet utilisateur
        $user = new User(null, $nom, $prenom, $email, $role, null, $statut);
        $user->setPasswordHash($password); // Hacher le mot de passe

        // Sauvegarder l'utilisateur
        return $user->save();
    }

    public static function signin($email, $password)
    {
        // Recherche l'utilisateur par email
        $user = self::findByEmail($email);

        // Si l'utilisateur n'existe pas
        if (!$user) {
            throw new Exception("Email ou mot de passe invalide");
        }

        // Vérification du mot de passe
        if (!password_verify($password, $user->passwordHash)) {
            throw new Exception("Email ou mot de passe invalide");
        }

        // Vérification du statut de l'utilisateur
        if ($user->getStatut() === 'En_attente') {
            throw new Exception("Votre compte est en attente de validation par un administrateur.");
        } elseif ($user->getStatut() === 'Suspendu') {
            throw new Exception("Votre compte est suspendu. Veuillez contacter l'administrateur.");
        }

        // Si l'utilisateur est actif, retourner l'utilisateur pour la connexion
        return $user;
    }



    // Method to change the user's password
    public function changePassword($newPassword)
    {
        $this->setPasswordHash($newPassword); // Hash the new password
        $db = Database::getInstance()->getConnection();
        $stmt = $db->prepare("UPDATE users SET password = :password WHERE id = :id");
        $stmt->bindParam(':password', $this->passwordHash, PDO::PARAM_STR);
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }

    // Méthode pour bannir un utilisateur
    public function banir()
    {
        $db = Database::getInstance()->getConnection();

        $stmt = $db->prepare("UPDATE users SET statut = 'Suspendu' WHERE id = :id");
        $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);
        $stmt->execute();
    }
    public function logout()
    {
        session_start();
        session_destroy();
        header('Location: ../index.php');
        exit();
    }
}
