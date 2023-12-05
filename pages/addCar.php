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

        .addCar{
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
    <!-- Form to add new CAR -->
    <!-- Start of addCar -->
    <div class="cardProduct">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">ADD CAR</a>
                </li>             
            </ul>
        </div>
        <div class="addCar">
            <form method="POST">

                <label for="carName">Car Name:</label><br>
                <input type="text" id="carName" name="carName" required>
                <br>

                <label for="brand">Brand:</label><br>
                <input type="text" id="brand" name="brand" required>
                <br>

                <label for="model">Car Model:</label><br>
                <input type="text" id="model" name="model" required>
                <br>

                <label for="year">Year Model:</label><br>
                <input type="text" id="year" name="year" required>
                <br>

                <label for="color">Color:</label><br>
                <input type="text" id="color" name="color">
                <br>
                
                <button class="addButton" type="submit" name="addButton">ADD</button>
            </form>
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
        
            public function addCar($carName, $brand, $model, $year, $color)
            {
                $insertQuery = "INSERT INTO cars (carName, brand, model, yearModel, color) VALUES (?, ?, ?, ?, ?)";
                $stmt = $this->db->prepare($insertQuery);
                $stmt->bind_param("sssss", $carName, $brand, $model, $year, $color);
        
                $addSuccess = $stmt->execute();
        
                $stmt->close();
        
                return $addSuccess;
            }
        }
        
        $dbConnection = new DbConnection();
        $db = $dbConnection->getConnection();
        
        $carManager = new CarManager($db);
        
        if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addButton"])) {
            $carName = $_POST["carName"];
            $brand = $_POST["brand"];
            $model = $_POST["model"];
            $year = $_POST["year"];
            $color = $_POST["color"];
        
            $addSuccess = $carManager->addCar($carName, $brand, $model, $year, $color);
        
            if ($addSuccess) {
                echo "<script>alert('Car added successfully!');</script>";
            } else {
                echo "<script>alert('Failed to add car');</script>";
            }
        }
        ?>
    <!-- End of addCar -->


    
<?php
include'../includes/footer.php';
?>