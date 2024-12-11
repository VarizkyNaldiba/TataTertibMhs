<?php
require_once '../config.php';

class News {
    private $connect;

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getAllNews() {
        try {
            $stmt = $this->connect->prepare("SELECT * FROM NEWS");
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>