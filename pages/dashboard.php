<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
    <style>
        .card{
        margin-top: 40px;
        margin-left: 34%;
        display:inline-block;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        }

        .card2{
        margin-top: 40px;
        margin-left: 20px;
        display:inline-block;
        border-radius: 5px;
        -webkit-box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        box-shadow: 0 1px 2.94px 0.06px rgba(4,26,55,0.16);
        border: none;
        margin-bottom: 30px;
        -webkit-transition: all 0.3s ease-in-out;
        transition: all 0.3s ease-in-out;
        }

        .card .card-block {
            padding: 25px;
        }

        .card2 {
            padding: 25px;
        }

        .order-card i {
            font-size: 26px;
        }

        .f-left {
            float: left;
        }

        .f-right {
            float: right;
        }

        .order-card {
            color: #fff;
        }

        .bg-c-blue {
            background: linear-gradient(45deg,#4099ff,#73b4ff);
        }

        .bg-c-green {
            background: linear-gradient(45deg,#2ed8b6,#59e0c5);
        }

        .bg-c-yellow {
            background: linear-gradient(45deg,#FFB64D,#ffcb80);
        }

        #carPic{
            margin-top: 5px;
            margin-left: 33%;
            display:inline-block;
        }
        .card-block {
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
        text-align: center;
        }

        .card-block h2 {
        display: flex;
        align-items: center;
        justify-content: space-between;
        }

        .card-block h2 i {
        margin-right: 10px; /* Adjust the margin as needed */
        }

    </style>
<?php
include_once('../includes/connection.php');

class RentalManager {
    private $db;

    // Constructor to initialize the database connection
    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    // Method to count rentals based on their status
    public function countRentalsByStatus($status) {
        // SQL query to count rentals with a specific status
        $query = "SELECT COUNT(*) as count FROM rentals WHERE status = ?";
        $stmt = $this->db->prepare($query);

        // Check if the statement was prepared successfully
        if ($stmt) {
            // Bind parameters and execute the query
            $stmt->bind_param("s", $status);
            $stmt->execute();

            // Get the result set and fetch the count
            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            // Close the prepared statement
            $stmt->close();

            // Return the count of rentals
            return $row['count'];
        } else {
            // Log an error message if preparing the statement fails
            error_log("Prepare Statement Error: " . $this->db->error);
            return 0;
        }
    }

    // Method to calculate the overall gross income from all rentals
    public function calculateOverallGrossIncome() {
        // SQL query to calculate the sum of price and penalty for all rentals
        $query = "SELECT SUM(price + penalty) as total FROM rentals";
        $result = $this->db->query($query);

        // Check if the query was executed successfully
        if ($result) {
            // Fetch the total from the result set
            $row = $result->fetch_assoc();

            // Return the overall gross income
            return $row['total'];
        } else {
            // Log an error message if executing the query fails
            error_log("SQL Error: " . $this->db->error);
            return 0;
        }
    }
}

// Create a database connection
$dbConnection = new DbConnection();
$rentalManager = new RentalManager($dbConnection);

// Get counts and overall gross income from the RentalManager
$ongoingCount = $rentalManager->countRentalsByStatus('ongoing');
$completedCount = $rentalManager->countRentalsByStatus('completed');
$overallGrossIncome = $rentalManager->calculateOverallGrossIncome();
?>


<!-- Card section displaying ongoing rentals, completed rentals, and total gross income -->
<!-- Start of Dashboard -->
<div class="card bg-c-blue order-card">
    <div class="card-block">
        <!-- Title and count for ongoing rentals -->
        <h5 class="m-b-20">ONGOING RENTALS</h5>
        <h2 class="text-right"><i class="fa-solid fa-clock" style="color: #ffffff;"></i><span><?php echo $ongoingCount; ?></span></h2>
    </div>
</div>

<div class="card2 bg-c-green order-card">
    <div class="card-block">
        <!-- Title and count for completed rentals -->
        <h5 class="m-b-20">COMPLETED RENTALS</h5>
        <h2 class="text-right"><i class="fa-solid fa-circle-check" style="color: #ffffff;"></i></i><span><?php echo $completedCount; ?></span></h2>
    </div>
</div>

<div class="card2 bg-c-yellow order-card">
    <div class="card-block">
        <!-- Title and overall gross income -->
        <h5 class="m-b-20">TOTAL GROSS INCOME</h5>
        <h2 class="text-right"><i class="fa-solid fa-sack-dollar" style="color: #ffffff;"></i></i><span><?php echo isset($overallGrossIncome) ? $overallGrossIncome : 0; ?></span></h2>
    </div>
</div>
</div>
<!-- Car image -->
<img id="carPic" src="../icons/loginCar.png" alt="Logo" width="57%" height="auto">
<div>
<!-- End of Dashboard -->



    
<?php
include'../includes/footer.php';
?>