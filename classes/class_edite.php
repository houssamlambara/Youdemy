<?php

class Edite
{
    private $table;
    private $id;
    private $data;

    public function __construct($table, $id, $data)
    {
        $this->table = $table;
        $this->id = $id;
        $this->data = $data;
    }

    public function execute()
    {
        try {
            $db = Database::getInstance()->getConnection();

            $set = '';
            foreach ($this->data as $key => $value) {
                $set .= "$key = :$key, ";
            }
            $set = rtrim($set, ', '); 

            $sql = "UPDATE " . $this->table . " SET " . $set . " WHERE id = :id";
            $stmt = $db->prepare($sql);

            foreach ($this->data as $key => $value) {
                $stmt->bindParam(":$key", $this->data[$key]);
            }
            $stmt->bindParam(':id', $this->id, PDO::PARAM_INT);

            if ($stmt->execute()) {
                return true;
            } else {
                throw new Exception("Erreur lors de la mise à jour de l'enregistrement.");
            }
        } catch (PDOException $e) {
            echo "Erreur PDO : " . $e->getMessage();
            return false;
        } catch (Exception $e) {
            echo "Erreur : " . $e->getMessage();
            return false;
        }
    }
}
?>
