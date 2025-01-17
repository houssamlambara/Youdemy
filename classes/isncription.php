<?php
class Inscription {
    private $conn;
    private $table = 'inscriptions';

    public $name;
    public $email;
    public $cours_id;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function enregistrerInscription() {
        $query = "INSERT INTO " . $this->table . " (name, email, cours_id) VALUES (?, ?, ?)";
        $stmt = $this->conn->prepare($query);
        $stmt->bind_param("ssi", $this->name, $this->email, $this->cours_id);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
