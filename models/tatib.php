<?php
require_once 'config/database.php';

class Tatib
{
    private $conn;

    public function __construct()
    {
        $database = new Database();
        $this->conn = $database->getConnection();

        // Check for successful connection
        if ($this->conn->connect_error) {
            die("Connection failed: " . $this->conn->connect_error);
        }
    }

    public function getTatibByTingkat($tingkat = null)
    {
        $query = "SELECT * FROM tatatertib";

        if ($tingkat) {
            $query .= " WHERE tingkat = ?";
            $stmt = $this->conn->prepare($query);
            if ($stmt === false) {
                die("Query preparation failed: " . $this->conn->error);
            }

            $stmt->bind_param("s", $tingkat);
            if (!$stmt->execute()) {
                die("Query execution failed: " . $stmt->error);
            }

            $result = $stmt->get_result();
            $stmt->close();
        } else {
            $result = $this->conn->query($query);
            if ($result === false) {
                die("Query execution failed: " . $this->conn->error);
            }
        }

        // Fetch all results
        return $result->fetch_all(MYSQLI_ASSOC);
    }
}
