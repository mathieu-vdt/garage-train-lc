<?php
require_once '../../controllers/vehiclesController.php';
require_once('../../models/Vehicle.php');
require_once('../../database/db.php');
$db = connectDB();

$vehiclesController = new VehiclesController($db);

$vehicles = $vehiclesController->listVehicles();
?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <title>Garage train</title>
    <link rel="stylesheet" href="../../assets/bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../assets/css/styles.min.css">

    <!-- Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.3.0/font/bootstrap-icons.css">
</head>
<body class="bg-light container">
<h1 class="pt-5">Vehicle List</h1>
<a href="create.php" class="btn btn-success mb-2">Add Vehicle</a>
<table border="1" class="table table-striped">
    <tr>
        <th>ID</th>
        <th>BRAND</th>
        <th>Model</th>
        <th>Year</th>
        <th>Client ID</th>
        <th>License Plate</th>
        <th>Actions</th>
    </tr>
    <?php foreach ($vehicles as $vehicle): ?>
        <tr>
            <td><?= $vehicle['id'] ?></td>
            <td><?= $vehicle['marque'] ?></td>
            <td><?= $vehicle['modele'] ?></td>
            <td><?= $vehicle['annee'] ?></td>
            <td><?= $vehicle['client_id'] ?></td>
            <td><?= $vehicle['plaque_immatriculation'] ?></td>
            <td class="row">
                <div class="col-2">
                    <a href="edit.php?id=<?= $vehicle['id'] ?>"><i class="bi bi-pencil-fill"></i></a>
                </div>
                <div class="col-2">
                <a href="delete.php?id=<?= $vehicle['id'] ?>" onclick="return confirm('Are you sure?')"><i class="bi bi-trash-fill text-danger"></i></a>
                </div>
            </td>
        </tr>
    <?php endforeach; ?>
</table>
</body>
</html>