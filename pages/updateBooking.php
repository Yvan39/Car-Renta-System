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

        .updateBookingForm{
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
include_once('../includes/connection.php');

class RentalUpdater {
    private $db;

    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    public function updateRentalStatus($bookingID, $status) {
        $query = "UPDATE rentals SET status = ? WHERE rentalId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("si", $status, $bookingID);

        $updateResult = $stmt->execute();

        $stmt->close();

        return $updateResult;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    $bookingID = $_POST['bookingID'];
    $customerName = $_POST['customerName'];
    $status = $_POST['status'];    

    $dbConnection = new DbConnection();
    $rentalUpdater = new RentalUpdater($dbConnection);

    $updateResult = $rentalUpdater->updateRentalStatus($bookingID, $status);


    if ($updateResult) {
        echo '<script>alert("Update Successful");</script>';
        header("Location: rentals.php");
        exit();
    } else {
        echo '<script>alert("Update Failed");</script>';
    }
}
?>
<!-- Form to update (advanceBooking) from upcoming to ongoing -->
<!-- Start of updateBooking -->
<div class="cardProduct">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;" href="updateBooking.php">UPDATE STATUS</a>
            </li>            
        </ul>
    </div>
    <?php
    $rentalId = isset($_GET['rentalId']) ? $_GET['rentalId'] : null;
    $customerName = isset($_GET['customer_name']) ? $_GET['customer_name'] : null ;
    ?>
    <div class="updateBookingForm">
    <form method="POST">
        <label for="bookingID">Booking ID:</label><br>
        <input type="number" id="bookingID" name="bookingID" value="<?php echo $rentalId; ?>" readonly>
        <br>

        <label for="customerName">Customer Name:</label><br>
        <input type="text" id="customerName" name="customerName" value="<?php echo $customerName; ?>" readonly>
        <br>

        <label for="status">Status:</label><br>
        <input type="text" id="status" name="status" value="ongoing" readonly>
        <br>
        
        <button class="updateButton" type="submit" name="updateButton">UPDATE</button>
    </form>
    </div>
</div>
</div>

    <!-- End of updateBooking -->


    
<?php
include'../includes/footer.php';
?>