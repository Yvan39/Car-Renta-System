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
include_once('../includes/connection.php');

class RentalUpdater {
    private $db;

    public function __construct(DbConnection $dbConnection) {
        $this->db = $dbConnection->getConnection();
    }

    public function updateRentalStatus($ongoingID, $dateReturned, $penalty, $status){
        $query = "UPDATE rentals SET status = ?, dateReturned = ?, penalty = ? WHERE rentalId = ?";
        $stmt = $this->db->prepare($query);
        $stmt->bind_param("ssii", $status, $dateReturned, $penalty, $ongoingID);
    
        $updateResult = $stmt->execute();
    
        $stmt->close();
    
        return $updateResult;
    }    
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateButton'])) {
    $ongoingID = $_POST['ongoingID'];
    $dateReturned = $_POST['dateReturned'];
    $penalty = $_POST['penalty'];
    $status = $_POST['status'];    

    $dbConnection = new DbConnection();
    $rentalUpdater = new RentalUpdater($dbConnection);

    $updateResult = $rentalUpdater->updateRentalStatus($ongoingID, $dateReturned, $penalty, $status);


    if ($updateResult) {
        echo '<script>alert("Update Successful");</script>';
        exit();
    } else {
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