<?php
require_once '../../controllers/vehiclesController.php';
require_once('../../database/db.php');
require_once '../../models/Client.php';
$db = connectDB();
$clientModel = new Client($db);
$clients = $clientModel->getAllClients();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $vehiclesController = new VehiclesController($db);
    $vehiclesController->createVehicle($_POST);
}
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
    <h1 class="pt-5">Add Vehicle</h1>
        <form method="POST" class="needs-validation" >
        <div class="mb-3">
            <label for="marque" class="form-label">Brand</label>
            <input type="text" class="form-control" id="marque" name="marque" required>
            <div class="invalid-feedback">
                Please provide a brand.
            </div>
        </div>
        <div class="mb-3">
            <label for="modele" class="form-label">Model</label>
            <input type="text" class="form-control" id="modele" name="modele" required>
            <div class="invalid-feedback">
                Please provide a model.
            </div>
        </div>
        <div class="mb-3">
            <label for="annee" class="form-label">Year</label>
            <input type="number" class="form-control" id="annee" name="annee" required>
            <div class="invalid-feedback">
                Please provide a year.
            </div>
        </div>
        <div class="mb-3">
            <label for="plaque_immatriculation" class="form-label">License Plate</label>
            <input type="text" class="form-control" id="plaque_immatriculation" placeholder="AB-123-CD" name="plaque_immatriculation" pattern="[A-Z]{2}-[0-9]{3}-[A-Z]{2}" required>
            <div class="invalid-feedback">
                Please provide a valid license plate (e.g., AB-123-CD).
            </div>
        </div>
        <div class="mb-3">
            <label for="client_id" class="form-label">Client</label>
            <select class="form-select" id="client_id" name="client_id" required>
                <option value=""></option>
                <?php foreach ($clients as $client): ?>
                    <option value="<?= htmlspecialchars($client['id']) ?>"><?= htmlspecialchars($client['nom']) ?></option>
                <?php endforeach; ?>
            </select>
            <div class="invalid-feedback">
                Please select a client.
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>

    <script src="../../assets/bootstrap/js/bootstrap.bundle.min.js"></script>
</body>
</html>