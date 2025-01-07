# Gestion des Véhicules - Garage Train

Ce projet permet de gérer les véhicules dans une application de gestion de garage. Il inclut des fonctionnalités pour créer, lire, mettre à jour et supprimer des véhicules, ainsi que des tests unitaires pour vérifier le bon fonctionnement de ces fonctionnalités.

## Prérequis

- PHP 7.4 ou supérieur
- MySQL
- Composer

## Installation

1. Clonez le dépôt

2. Installez les dépendances avec Composer :
    ```bash
    composer install
    ```

3. Configurez la base de données dans le fichier [db.php](https://github.com/mathieu-vdt/garage-train-lc/blob/main/database/db.php)

4. Créez la base de données à partir du fichier [import.sql](https://github.com/mathieu-vdt/garage-train-lc/blob/main/import.sql)

## Fonctionnalités

### Création de Véhicule

Le formulaire de création de véhicule se trouve dans [create.php](https://github.com/mathieu-vdt/garage-train-lc/blob/main/views/vehicles/create.php). Il permet de saisir les informations suivantes :
- Marque
- Modèle
- Année
- Plaque d'immatriculation (format : AB-123-CD)
- Client (optionnel)

### Lecture de Véhicules

La liste des véhicules se trouve dans [list.php](https://github.com/mathieu-vdt/garage-train-lc/blob/main/views/vehicles/list.php). Elle affiche les informations suivantes pour chaque véhicule :
- ID
- Marque
- Modèle
- Année
- Client ID
- Plaque d'immatriculation

### Mise à Jour de Véhicule

Le formulaire de mise à jour de véhicule se trouve dans [edit.php](https://github.com/mathieu-vdt/garage-train-lc/blob/main/views/vehicles/edit.php). Il permet de modifier les informations d'un véhicule existant.

### Suppression de Véhicule

La suppression de véhicule est gérée par la méthode `deleteVehicle` dans le modèle `Vehicle`. Elle supprime également les rendez-vous associés au véhicule.

## Tests Unitaires

Les tests unitaires sont écrits avec PHPUnit et se trouvent dans [VehicleTest.php](https://github.com/mathieu-vdt/garage-train-lc/blob/main/tests/VehicleTest.php). Ils couvrent les opérations CRUD pour les véhicules.

### Exécution des Tests

Pour exécuter les tests, utilisez la commande suivante :
```bash
vendor/bin/phpunit --bootstrap vendor/autoload.php tests/VehicleTest.php