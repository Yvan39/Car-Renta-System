<?php
include_once('../includes/connection.php');

// Check if the 'carId' parameter is set in the GET request
if (isset($_GET['carId'])) {
    // Get the carId to delete from the GET parameters
    $carIdToDelete = $_GET['carId'];

    // Create a new database connection
    $dbConnection = new DbConnection();
    $db = $dbConnection->getConnection();

    // SQL query to delete a car by carId
    $deleteCarQuery = "DELETE FROM cars WHERE carId = ?";
    
    // Prepare and bind parameters for the SQL query
    $stmt = $db->prepare($deleteCarQuery);
    $stmt->bind_param("i", $carIdToDelete);

    // Execute the query and store the result
    $deleteSuccess = $stmt->execute();

    // Close the prepared statement and the database connection
    $stmt->close();
    $db->close();

    // Check the result of the deletion
    if ($deleteSuccess) {
        // Redirect to the 'cars.php' page after successful deletion
        header("Location: cars.php");
        exit;
    } else {
        // Display an error message if the deletion fails
        echo "Failed to delete car.";
    }
}
?>
