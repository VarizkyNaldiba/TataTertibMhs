<?php
require_once '../config.php';

class Users {
    private $connect;
    private $sql = "SELECT * FROM mahasiswa UNION ALL SELECT * FROM dosen";

    public function __construct() {
        global $connect;
        $this->connect = $connect;
    }

    public function getAllUsers() {
        try {
            $stmt = $this->connect->prepare($this->sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
        } catch(PDOException $e) {
            echo "Error: " . $e->getMessage();
            return false;
        }
    }
}
?>
