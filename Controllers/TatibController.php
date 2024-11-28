<?php
require_once '../Models/Tatib.php';
require_once '../Models/Sanksi.php';

function ReadTatib() {
    global $connect, $sqlt;
    try {
        $stmt = $connect->prepare($sqlt);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
function ReadSanksi() {
    global $connect, $sqls;
    try {
        $stmt = $connect->prepare($sqls);
        $stmt->execute();
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $data;
    } catch(PDOException $e) {
        echo "Error: " . $e->getMessage();
        return false;
    }
}
?>