<?php
class Database
{
    private $host = "localhost";
    private $username = "root";
    private $password = "";
    private $db_name = "SI_TataTertib";

    public function getConnection()
    {
        $conn = new mysqli($this->host, $this->username, $this->password, $this->db_name);
        if ($conn->connect_error) {
            echo "Connection Failed";
        }
        return $conn;
    }
}
