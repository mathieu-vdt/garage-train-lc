<?php
require_once '../../controllers/vehiclesController.php';
require_once('../../database/db.php');
$db = connectDB();
$vehiclesController = new VehiclesController($db);

if (isset($_GET['id'])) {
    $vehiclesController->deleteVehicle($_GET['id']);
}
?>
