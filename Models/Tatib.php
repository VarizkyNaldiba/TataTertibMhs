<?php
require_once '../config.php';

class Tatib {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getAllTatib() {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM TATA_TERTIB");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>