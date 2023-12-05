<?php
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

        .newTransacForm{
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
        margin: 0;
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

        .addButton {
        background-color: rgb(255,215,0);
        border: 2px solid black;
        border-radius: 5px;
        color: black;
        padding: 10px 20px;
        border: none;
        cursor: pointer;
        }

    </style>

    <!-- Form to add new transaction or new booking -->
    <!-- Start of newTransaction -->
    <div class="cardProduct">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">ADD BOOKING</a>
                </li>             
            </ul>
        </div>
    <div class="newTransacForm">
            <form method="POST">

                <label for="customerName">Customer Name:</label><br>
                <input type="text" id="customerName" name="customerName" required>
                <br>
                
                <label for="customerNumber">Customer Number:</label><br>
                <input type="number" id="customerNumber" name="customerNumber" required>
                <br>  

                <label for="car">Car:</label><br>
                <select id="car" name="car">
                    <option value="Car 1">Car 1</option>
                    <option value="Car 2">Car 2</option>
                    <option value="Car 3">Car 3</option>
                    <option value="Car 4">Car 4</option>
                </select>
                <br>   

                <label for="borrowDate">Borrow Date:</label>
                <input type="date" id="borrowDate" name="borrowDate" required>
                <br>

                <label for="returnDate">Return Date:</label>
                <input type="date" id="returnDate" name="returnDate" required>
                <br>

                <label for="price">Price:</label><br>
                <input type="number" id="price" name="price" required>
                <br> 

                <label for="fine">Fine P.D:</label><br>
                <input type="number" id="fine" name="fine" required>
                <br>

                <label for="status">Status:</label><br>
                <select id="status" name="status">
                    <option value="upcoming">upcoming</option>
                    <option value="ongoing">ongoing</option>
                </select>
                <br>

                <button class="addButton" type="submit" name="addButton">ADD</button>
            </form>
        </div>

    </div>
    
    <?php
 include_once('../includes/connection.php');

 $dbConnection = new DbConnection();
 $db = $dbConnection->getConnection();
 
 class RentalManager
 {
     private $db;
 
     public function __construct($db)
     {
         $this->db = $db;
     }
 
     public function addBooking($customerName, $customerNumber, $carName, $borrowDate, $returnDate, $price, $finePerDay, $status)
     {
         $insertCustomerQuery = "INSERT INTO customers (name, number) VALUES (?,?)";
         $stmtCustomer = $this->db->prepare($insertCustomerQuery);
         $stmtCustomer->bind_param("si", $customerName, $customerNumber);
 
         $customerInsertSuccess = $stmtCustomer->execute();
 
         $customerId = $this->db->insert_id;
 
         $stmtCustomer->close();
 
         if ($customerInsertSuccess) {
            $selectCarQuery = "SELECT carId FROM cars WHERE carName = ?";
            $stmtCar = $this->db->prepare($selectCarQuery);
            $stmtCar->bind_param("s", $carName);
            $stmtCar->execute();
            $stmtCar->bind_result($carId);

            if ($stmtCar->fetch()) {
                $stmtCar->close();

            $insertRentalQuery = "INSERT INTO rentals (customerId, carId, borrowDate, returnDate, price, fine_per_day, status)
            VALUES (?, ?, ?, ?, ?, ?, ?)";
            $stmtRental = $this->db->prepare($insertRentalQuery);
            $stmtRental->bind_param("iissdss", $customerId, $carId, $borrowDate, $returnDate, $price, $finePerDay, $status);

            $rentalInsertSuccess = $stmtRental->execute();

            $stmtRental->close();

            return $rentalInsertSuccess;
         } else {
             return false;
         }
     }
 }
}
 
 $rentalManager = new RentalManager($db);
 
 if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addButton"])) {
     $customerName = $_POST["customerName"];
     $customerNumber = $_POST["customerNumber"];
     $car = $_POST["car"];
     $borrowDate = $_POST["borrowDate"];
     $returnDate = $_POST["returnDate"];
     $price = $_POST["price"];
     $fine = $_POST["fine"];
     $status = $_POST["status"];
 
     $bookingAdded = $rentalManager->addBooking($customerName, $customerNumber, $car, $borrowDate, $returnDate, $price, $fine, $status);
 
     if ($bookingAdded) {
        echo "<script>alert('Booking added successfully!');</script>";
    } else {
        echo "<script>alert('Failed to add booking');</script>";
    }
 }
    ?>
    <!-- End of newTransaction -->


    
<?php
include'../includes/footer.php';
?>