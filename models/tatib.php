<?php
class Tatib
{
    private $conn;

    public function __construct()
    {
        $this->conn = new mysqli("localhost", "username", "password", "nama_database");
        if ($this->conn->connect_error) {
            die("Koneksi gagal: " . $this->conn->connect_error);
        }
    }

    public function getTatibByTingkat($tingkat)
    {
        $query = "SELECT * FROM tatatertib";
        if ($tingkat) {
            $query .= " WHERE tingkat = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bind_param("s", $tingkat);
            $stmt->execute();
            $result = $stmt->get_result();
        } else {
            $result = $this->conn->query($query);
        }
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
