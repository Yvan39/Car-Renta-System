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

    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    public function cancelBooking($bookingID) {
        $query = "UPDATE rentals SET status = 'canceled' WHERE rentalId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("i", $bookingID);

        $cancelResult = $stmt->execute();

        $stmt->close();

        return $cancelResult;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['cancelButton'])) {
        $bookingID = $_POST['bookingID'];

        $dbConnection = new DbConnection();
        $bookingCanceler = new BookingCanceler($dbConnection);

        $cancelResult = $bookingCanceler->cancelBooking($bookingID);

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

    <!-- Form to cancel advance booking -->
    <!-- Start of cancelBooking -->
    <div class="cardProduct">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;" href="cancelBooking.php">CANCEL BOOKING</a>
                </li>
            </ul>
        </div>
        <?php
        $rentalId = isset($_GET['rentalId']) ? $_GET['rentalId'] : null;
        $customerName = isset($_GET['customer_name']) ? $_GET['customer_name'] : null ;
        ?>
    <div class="cancelForm">
            <form method="POST">
                <label for="bookingID">Booking ID:</label><br>
                <input type="number" id="bookingID" name="bookingID" value="<?php echo $rentalId; ?>" readonly>
                <br>

                <label for="customerName">Customer Name:</label><br>
                <input type="text" id="customerName" name="customerName" value="<?php echo $customerName; ?>" readonly>
                <br>   

                <label for="status">Status:</label><br>
                <input type="text" id="status" name="status" value="canceled" required>
                <br>
                
                <button class="cancelButton" type="submit" name="cancelButton">OK</button>
            </form>
        </div>

    </div>
    </div>
    <!-- End of cancelBooking -->


    
<?php
include'../includes/footer.php';
?>