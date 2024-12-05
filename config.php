<?php
function connectToDatabase($servername, $dbname, $username, $password) {
    try {
        $conn = new PDO("sqlsrv:Server=$servername;Database=$dbname", $username, $password);
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        echo "Koneksi berhasil";
        return $conn;
    } catch(PDOException $e) {
        die("Koneksi gagal: " . $e->getMessage());
    }
}

$connect = connectToDatabase("LAPTOP-VMVSF6A7\PBO", "DiscipLink", "sa", "12345");
?>
