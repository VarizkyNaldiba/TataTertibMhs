<?php
function connectToDatabase($servername, $dbname) {
    try {
        $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname");
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "con berhasil";
        return $conn;
    } catch(PDOException $e) {
        die("Connection failed: " . $e->getMessage());
    }
}

$connect = connectToDatabase("LAPTOP-CEEMFUHE", "DiscipLink");
?>