<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
    <style>
        .cardProduct{

        width: calc(100% - 320px);
        margin-top: 40px;
        margin-left: 310px;
        display:inline-block;
        background: rgb(245, 245, 245);
        }

        #ad-head{
        display: inline-block;
        }

        .m-2{
        color: rgb(25,25,112);
        display; inline;
        }

        #add-car{
        display: inline-block;
        position: absolute;
        left: 185px;
        top: 30px;
        margin: 5px;
        padding: 5px;
        }
    </style>
    <!-- main table for the list of cars for rental-->
    <!-- Start of cars -->
    <div class="cardProduct">
    <div class="card shadow mb-4">
            <div class="card-header py-3" id="ad-head">
                <h4 class="m-2 font-weight-bold">Cars For Rent</h4>
                <a class="add-btn"  href="addCar.php">
                    <i class="fa-solid fa-plus fa-2xl" id="add-car" style="color: #ffd700;"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>Car Name</th>
                                <th>Brand</th>
                                <th>Car Model</th>
                                <th>Year Model</th>
                                <th>Car Model</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                        include_once('../includes/connection.php');
                        $dbConnection = new DbConnection();
                        $db = $dbConnection->getConnection();

                        $selectCarsQuery = "SELECT * FROM cars";
                        $result = $db->query($selectCarsQuery);

                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['carName']}</td>";
                                echo "<td>{$row['brand']}</td>";
                                echo "<td>{$row['model']}</td>";
                                echo "<td>{$row['yearModel']}</td>";
                                echo "<td>{$row['color']}</td>";
                                echo "<td><form method='POST'><input type='hidden' name='carIdToDelete' value='{$row['carId']}'>
                                    <button type='submit' name='deleteButton' class='btn btn-danger' onclick='return confirm(\"Are you sure?\")'>Delete</button></form></td>";
                                echo "</tr>";
                            }
                        } else {
                            echo "<tr><td colspan='6'>No cars found</td></tr>";
                        }

                        $db->close();
                    ?>
                    </tbody>
                    </table>
                </div>
            </div>
        </div>

    </div>
    <?php
include_once('../includes/connection.php');

class CarManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getCars()
    {
        $selectCarsQuery = "SELECT * FROM cars";
        $result = $this->db->query($selectCarsQuery);

        $cars = array();
        while ($row = $result->fetch_assoc()) {
            $cars[] = $row;
        }

        return $cars;
    }

    public function deleteCar($carId)
    {
        $deleteCarQuery = "DELETE FROM cars WHERE carId = ?";
        $stmt = $this->db->prepare($deleteCarQuery);
        $stmt->bind_param("i", $carId);

        $deleteSuccess = $stmt->execute();

        $stmt->close();

        return $deleteSuccess;
    }
}

$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

$carManager = new CarManager($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["deleteButton"])) {
    $carIdToDelete = $_POST["carIdToDelete"];

    echo "<script>
        var confirmDelete = confirm('Are you sure you want to delete this car?');
        if (confirmDelete) {
            window.location.href = 'deleteCars.php?carId=' + $carIdToDelete;
        }
    </script>";
}

$db->close();
?>
    <!-- End of cars -->


    
<?php
include'../includes/footer.php';
?>