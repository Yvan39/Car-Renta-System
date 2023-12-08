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

        .cancelForm{
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

        .cancelButton {
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
include_once('../includes/connection.php');

class BookingCanceler {
    private $db;

    // Constructor to initialize the database connection
    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    // Method to cancel a booking by updating the status to 'canceled'
    public function cancelBooking($bookingID) {
        // SQL query to update the status of the booking to 'canceled'
        $query = "UPDATE rentals SET status = 'canceled' WHERE rentalId = ?";
        
        // Prepare and bind parameters for the SQL query
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $bookingID);

        // Execute the query and store the result
        $cancelResult = $stmt->execute();

        // Close the prepared statement
        $stmt->close();

        // Return the result of the cancellation
        return $cancelResult;
    }
}

// Check if the form has been submitted using the POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the 'cancelButton' is set in the POST data
    if (isset($_POST['cancelButton'])) {
        // Get the bookingID from the POST data
        $bookingID = $_POST['bookingID'];

        // Create a new database connection
        $dbConnection = new DbConnection();
        
        // Create an instance of the BookingCanceler class with the database connection
        $bookingCanceler = new BookingCanceler($dbConnection);

        // Attempt to cancel the booking and get the result
        $cancelResult = $bookingCanceler->cancelBooking($bookingID);

        // Display a success or failure message based on the cancellation result
        if ($cancelResult) {
            echo '<script>alert("Booking canceled successfully.");';
            echo 'window.location.href = "rentals.php";</script>';
        } else {
            echo '<script>alert("Failed to cancel booking.");';
            echo 'window.location.href = "rentals.php";</script>';
        }
    }
}
?>

<!-- Form to cancel an advance booking -->
<!-- Start of cancelBooking -->
<div class="cardProduct">
    <!-- Card header with navigation tabs -->
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <!-- Active tab for canceling a booking -->
                <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;" href="cancelBooking.php">CANCEL BOOKING</a>
            </li>
        </ul>
    </div>
    <?php
    // Get rentalId and customerName from the GET parameters or set them to null
    $rentalId = isset($_GET['rentalId']) ? $_GET['rentalId'] : null;
    $customerName = isset($_GET['customer_name']) ? $_GET['customer_name'] : null;
    ?>
    <div class="cancelForm">
        <!-- Form for canceling a booking -->
        <form method="POST">
            <!-- Booking ID input field with readonly attribute -->
            <label for="bookingID">Booking ID:</label><br>
            <input type="number" id="bookingID" name="bookingID" value="<?php echo $rentalId; ?>" readonly>
            <br>

            <!-- Customer Name input field with readonly attribute -->
            <label for="customerName">Customer Name:</label><br>
            <input type="text" id="customerName" name="customerName" value="<?php echo $customerName; ?>" readonly>
            <br>

            <!-- Status input field with a default value of 'canceled' -->
            <label for="status">Status:</label><br>
            <input type="text" id="status" name="status" value="canceled" required>
            <br>
            
            <!-- Submit button for canceling the booking -->
            <button class="cancelButton" type="submit" name="cancelButton">OK</button>
        </form>
    </div>
</div>
<!-- End of cancelBooking -->



    
<?php
include'../includes/footer.php';
?>