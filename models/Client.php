<?php
class Client {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllClients() {
        $query = $this->db->query("SELECT id, nom FROM clients");
        if (!$query) {
            throw new Exception("Database Query Failed: " . $this->db->error);
        }
        $clients = [];
        while ($row = $query->fetch_assoc()) {
            $clients[] = $row;
        }
        return $clients;
    }
}
?>