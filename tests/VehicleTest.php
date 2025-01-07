<?php
use PHPUnit\Framework\TestCase;

require_once 'models/Vehicle.php';
require_once 'database/db.php';

class VehicleTest extends TestCase {
    private $db;
    private $vehicleModel;

    protected function setUp(): void {
        $this->db = connectDB();
        $this->vehicleModel = new Vehicle($this->db);
    }

    public function testCreateVehicle() {
        $data = [
            'marque' => 'Toyota',
            'modele' => 'Corolla',
            'annee' => 2021,
            'client_id' => null,
            'plaque_immatriculation' => 'AB-123-CD'
        ];
        $this->vehicleModel->createVehicle($data);

        $vehicle = $this->db->query("SELECT * FROM vehicules WHERE plaque_immatriculation = 'AB-123-CD'")->fetch_assoc();
        $this->assertNotNull($vehicle);
        $this->assertEquals('Toyota', $vehicle['marque']);
        $this->assertEquals('Corolla', $vehicle['modele']);
        $this->assertEquals(2021, $vehicle['annee']);
        $this->assertNull($vehicle['client_id']);
        $this->assertEquals('AB-123-CD', $vehicle['plaque_immatriculation']);
    }

    public function testGetVehicleById() {
        $data = [
            'marque' => 'Test',
            'modele' => 'GetById',
            'annee' => 2021,
            'client_id' => null,
            'plaque_immatriculation' => 'XY-123-ZZ'
        ];
        $this->vehicleModel->createVehicle($data);

        $vehicle = $this->db->query("SELECT * FROM vehicules WHERE plaque_immatriculation = 'XY-123-ZZ'")->fetch_assoc();
        $vehicleId = $vehicle['id'];

        $vehicle = $this->vehicleModel->getVehicleById($vehicleId);
        $this->assertNotNull($vehicle);
        $this->assertEquals($vehicleId, $vehicle['id']);
    }

    public function testUpdateVehicle() {
        $data = [
            'marque' => 'Test',
            'modele' => 'Update',
            'annee' => 2021,
            'client_id' => null,
            'plaque_immatriculation' => 'YZ-456-XX'
        ];
        $this->vehicleModel->createVehicle($data);

        $vehicle = $this->db->query("SELECT * FROM vehicules WHERE plaque_immatriculation = 'YZ-456-XX'")->fetch_assoc();
        $vehicleId = $vehicle['id'];

        $updateData = [
            'marque' => 'Honda',
            'modele' => 'Civic',
            'annee' => 2022,
            'client_id' => null,
            'plaque_immatriculation' => 'CD-456-EF'
        ];
        $this->vehicleModel->updateVehicle($vehicleId, $updateData);

        $vehicle = $this->vehicleModel->getVehicleById($vehicleId);
        $this->assertEquals('Honda', $vehicle['marque']);
        $this->assertEquals('Civic', $vehicle['modele']);
        $this->assertEquals(2022, $vehicle['annee']);
        $this->assertNull($vehicle['client_id']);
        $this->assertEquals('CD-456-EF', $vehicle['plaque_immatriculation']);
    }

    public function testDeleteVehicle() {
        $data = [
            'marque' => 'Test',
            'modele' => 'Delete',
            'annee' => 2020,
            'client_id' => null,
            'plaque_immatriculation' => 'ZZ-999-ZZ'
        ];
        $this->vehicleModel->createVehicle($data);

        $vehicle = $this->db->query("SELECT * FROM vehicules WHERE plaque_immatriculation = 'ZZ-999-ZZ'")->fetch_assoc();
        $vehicleId = $vehicle['id'];

        // Create a rendezvous associated with the vehicle
        $stmt = $this->db->prepare("INSERT INTO rendezvous (vehicule_id, date_heure) VALUES (?, ?)");
        $stmt->bind_param('is', $vehicleId, date('Y-m-d H:i:s'));
        $stmt->execute();

        // Now delete the vehicle
        $this->vehicleModel->deleteVehicle($vehicleId);
        $vehicle = $this->vehicleModel->getVehicleById($vehicleId);
        $this->assertNull($vehicle);
    }
}
?>