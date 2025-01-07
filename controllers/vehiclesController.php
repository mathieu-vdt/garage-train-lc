
<?php
require_once '../../models/Vehicle.php';


class VehiclesController {
    private $vehicleModel;

    public function __construct($db) {
        $this->vehicleModel = new Vehicle($db);
    }

    public function listVehicles() {
        return $this->vehicleModel->getAllVehicles();
    }

    public function getVehicleById($id) {
        return $this->vehicleModel->getVehicleById($id);
    }

    public function createVehicle($data) {
        $this->vehicleModel->createVehicle($data);
        header('Location: list.php');
    }

    public function editVehicle($id, $data) {
        $this->vehicleModel->updateVehicle($id, $data);
        header('Location: list.php');
    }

    public function deleteVehicle($id) {
        $this->vehicleModel->deleteVehicle($id);
        header('Location: list.php');
    }
}
?>
