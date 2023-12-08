<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>

<style>
        .cardProduct{

        width: calc(100% - 320px);
        margin-top: 6px;
        margin-left: 310px;
        display:inline-block;
        background: rgb(245, 245, 245);
        }

        .updateOngoingForm{
        padding:15px;
        padding-top:40px;
        padding-bottom: 65px;
        overflow: hidden;
        text-align: center;

        }
        form {
        display: inline-block;
        width: 500px;
        border: 1px solid #000;
        padding: 10px;
        text-align: center;
        border-radius: 10px;
        }
        label{
        font-weight: bold;
        font-size:medium;
        }
        input{
        font-size: medium;
        }

        select, input {
        display: inline-block;
        margin-bottom: 10px;
        }

        select, input[type="text"], input[type="number"] {
        text-align: center;
        width: 43%;
        padding: 5px;
        font-size: 15px;
        line-height: 1.5;
        }

        .updateButton {
        background-color: rgb(255,215,0);
        border: 2px solid black;
        border-radius: 5px;
        color: black;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        }

    </style>
<?php
// Include the database connection file
include_once('../includes/connection.php');

// Define the RentalUpdater class responsible for updating rental status
class RentalUpdater {
    private $db;

    // Constructor to initialize the RentalUpdater with a database connection
    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    // Method to update the status of an ongoing rental
    public function updateRentalStatus($ongoingID, $dateReturned, $penalty, $status) {
        // SQL query to update the rental status, dateReturned, and penalty
        $query = "UPDATE rentals SET status = ?, dateReturned = ?, penalty = ? WHERE rentalId = ?";
        // Prepare the query
        $stmt = $this->db->prepare($query);
        // Bind parameters
        $stmt->bind_param("ssii", $status, $dateReturned, $penalty, $ongoingID);

        // Execute the update query
        $updateResult = $stmt->execute();

        // Close the prepared statement
        $stmt->close();

        // Return the result of the update operation
        return $updateResult;
    }
}

// Check if the request method is POST and the 'updateButton' is set in the POST data
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    // Retrieve the ongoing rental ID, dateReturned, penalty, and status from the POST data
    $ongoingID = $_POST['ongoingID'];
    $dateReturned = $_POST['dateReturned'];
    $penalty = $_POST['penalty'];
    $status = $_POST['status'];

    // Create a new database connection instance
    $dbConnection = new DbConnection();
    // Create a new RentalUpdater instance with the database connection
    $rentalUpdater = new RentalUpdater($dbConnection);

    // Update the ongoing rental status, dateReturned, and penalty and get the result
    $updateResult = $rentalUpdater->updateRentalStatus($ongoingID, $dateReturned, $penalty, $status);

    // Check the result of the update operation
    if ($updateResult) {
        // Display a success message
        echo '<script>alert("Update Successful");</script>';
        exit();
    } else {
        // Display a failure message
        echo '<script>alert("Update Failed");</script>';
    }
}
?>

<!-- Form to update Ongoing to completed -->
<!-- Start of updateOngoing -->
<div class="cardProduct">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">UPDATE STATUS</a>
            </li>
        </ul>
    </div>
        <?php
        $rentalId = isset($_GET['rentalId']) ? $_GET['rentalId'] : null;
        ?>
    <div class="updateOngoingForm">
        <form method="POST">
            <label for="ongoingID">Ongoing ID:</label><br>
            <input type="number" name="ongoingID" value="<?php echo $rentalId; ?>" readonly>
            <br>

            <label for="dateReturned">Date Returned:</label><br>
            <input type="date" id="dateReturned" name="dateReturned" required>
            <br>

            <label for="penalty">Penalty:</label><br>
            <input type="number" id="penalty" name="penalty" value="0" required>
            <br>

            <label for="status">Status:</label><br>
            <input type="text" id="status" name="status" value="completed" readonly>
            <br>

            <button class="updateButton" type="submit" name="updateButton">UPDATE</button>
        </form>
    </div>
</div>
</div>
    <!-- End of newOngoing -->


    
<?php
include'../includes/footer.php';
?>