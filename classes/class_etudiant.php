<?php
class Student {

    public function getAllStudents() {
        $db = Database::getInstance()->getConnection();
        
        $stmt = $db->prepare("SELECT * FROM users WHERE role = :role");
        $stmt->bindParam(':role', $role);
        $role = 2; 
        $stmt->execute();
        
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
    // Exemple d'ajout dans la classe Student

    public function getTotalStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getActiveStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students WHERE statut = 'active' AND MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }

    public function getNewStudents() {
        $db = Database::getInstance()->getConnection();

        $sql = "SELECT COUNT(*) FROM students WHERE MONTH(date_creation) = MONTH(CURRENT_DATE())";
        $stmt = $db->prepare($sql);
        $stmt->execute();
        return $stmt->fetchColumn();
    }
}

?>
