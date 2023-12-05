<?php
include_once('../includes/connection.php');

if (isset($_GET['carId'])) {
    $carIdToDelete = $_GET['carId'];

    $dbConnection = new DbConnection();
    $db = $dbConnection->getConnection();

    $deleteCarQuery = "DELETE FROM cars WHERE carId = ?";
    $stmt = $db->prepare($deleteCarQuery);
    $stmt->bind_param("i", $carIdToDelete);

    $deleteSuccess = $stmt->execute();

    $stmt->close();
    $db->close();

    if ($deleteSuccess) {
        header("Location: cars.php");
        exit;
    } else {
        echo "Failed to delete car.";
    }
}
?>