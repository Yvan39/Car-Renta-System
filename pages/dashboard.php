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

    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    public function countRentalsByStatus($status) {
        $query = "SELECT COUNT(*) as count FROM rentals WHERE status = ?";
        $stmt = $this->db->prepare($query);

        if ($stmt) {
            $stmt->bind_param("s", $status);
            $stmt->execute();

            $result = $stmt->get_result();
            $row = $result->fetch_assoc();

            $stmt->close();

            return $row['count'];
        } else {
            error_log("Prepare Statement Error: " . $this->db->error);
            return 0;
        }
    }

    public function calculateOverallGrossIncome() {
        $query = "SELECT SUM(price + penalty) as total FROM rentals";
        $result = $this->db->query($query);

        if ($result) {
            $row = $result->fetch_assoc();
            return $row['total'];
        } else {
            error_log("SQL Error: " . $this->db->error);
            return 0;
        }
    }
}

$dbConnection = new DbConnection();
$rentalManager = new RentalManager($dbConnection);

$ongoingCount = $rentalManager->countRentalsByStatus('ongoing');
$completedCount = $rentalManager->countRentalsByStatus('completed');
$overallGrossIncome = $rentalManager->calculateOverallGrossIncome();
?>


    <!-- card for ongoing rental/s, total completed rentals, total gross income-->
    <!-- Start of Dashboard -->
            <div class="card bg-c-blue order-card">
            <div class="card-block">
                    <h5 class="m-b-20">ONGOING RENTALS</h5>
                    <h2 class="text-right"><i class="fa-solid fa-clock" style="color: #ffffff;"></i><span><?php echo $ongoingCount; ?></span></h2>
                </div>
            </div>

            <div class="card2 bg-c-green order-card">
                <div class="card-block">
                    <h5 class="m-b-20">COMPLETED RENTALS</h5>
                    <h2 class="text-right"><i class="fa-solid fa-circle-check" style="color: #ffffff;"></i></i><span><?php echo $completedCount; ?></span></h2>
                </div>
            </div>

            <div class="card2 bg-c-yellow order-card">
                <div class="card-block">
                    <h5 class="m-b-20">TOTAL GROSS INCOME</h5>
                    <h2 class="text-right"><i class="fa-solid fa-sack-dollar" style="color: #ffffff;"></i></i><span><?php echo isset($overallGrossIncome) ? $overallGrossIncome : 0; ?></span></h2>
                </div>
            </div>

            </div>
                <img id="carPic" src="../icons/loginCar.png" alt="Logo" width="57%" height="auto">
            <div>
    <!-- End of Dashboard -->


    
<?php
include'../includes/footer.php';
?>