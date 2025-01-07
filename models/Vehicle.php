<?php
class Vehicle {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getAllVehicles() {
        $query = $this->db->query("SELECT * FROM vehicules");
        if (!$query) {
            throw new Exception("Database Query Failed: " . $this->db->error);
        }
        $vehicles = [];
        while ($row = $query->fetch_assoc()) {
            $vehicles[] = $row;
        }
        return $vehicles;
    }

    public function getVehicleById($id) {
        $stmt = $this->db->prepare("SELECT * FROM vehicules WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare Statement Failed: " . $this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        $result = $stmt->get_result();
        if (!$result) {
            throw new Exception("Execute Statement Failed: " . $stmt->error);
        }
        return $result->fetch_assoc();
    }

    public function createVehicle($data) {
        $stmt = $this->db->prepare("INSERT INTO vehicules (marque, modele, annee, client_id, plaque_immatriculation) VALUES (?, ?, ?, ?, ?)");
        if (!$stmt) {
            throw new Exception("Prepare Statement Failed: " . $this->db->error);
        }
        $client_id = empty($data['client_id']) ? null : $data['client_id'];
        $stmt->bind_param('ssiis', $data['marque'], $data['modele'], $data['annee'], $client_id, $data['plaque_immatriculation']);
        $stmt->execute();
        if ($stmt->error) {
            throw new Exception("Execute Statement Failed: " . $stmt->error);
        }
    }

    public function updateVehicle($id, $data) {
        $stmt = $this->db->prepare("UPDATE vehicules SET marque = ?, modele = ?, annee = ?, client_id = ?, plaque_immatriculation = ? WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare Statement Failed: " . $this->db->error);
        }
        $client_id = empty($data['client_id']) ? null : $data['client_id'];
        $stmt->bind_param('ssiisi', $data['marque'], $data['modele'], $data['annee'], $client_id, $data['plaque_immatriculation'], $id);
        $stmt->execute();
        if ($stmt->error) {
            throw new Exception("Execute Statement Failed: " . $stmt->error);
        }
    }

    public function deleteVehicle($id) {
        // Delete associated rendezvous first
        $stmt = $this->db->prepare("DELETE FROM rendezvous WHERE vehicule_id = ?");
        if (!$stmt) {
            throw new Exception("Prepare Statement Failed: " . $this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->error) {
            throw new Exception("Execute Statement Failed: " . $stmt->error);
        }

        // Now delete the vehicle
        $stmt = $this->db->prepare("DELETE FROM vehicules WHERE id = ?");
        if (!$stmt) {
            throw new Exception("Prepare Statement Failed: " . $this->db->error);
        }
        $stmt->bind_param('i', $id);
        $stmt->execute();
        if ($stmt->error) {
            throw new Exception("Execute Statement Failed: " . $stmt->error);
        }
    }
}
?>