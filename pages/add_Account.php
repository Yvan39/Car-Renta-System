<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>
    <!--Style for add account -->
    <style>
        .cardProduct{

        width: calc(100% - 320px);
        margin-top: 6px;
        margin-left: 310px;
        display:inline-block;
        background: rgb(245, 245, 245);
        }

        .addAccount{
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
        margin-bottom: 0;
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

    <!-- Form to add new ACCOUNT -->
    <!-- Start of addAccount -->
    <div class="cardProduct">
        <div class="card-header">
            <ul class="nav nav-tabs card-header-tabs">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">ADD ACCOUNT</a>
                </li>             
            </ul>
        </div>
        <div class="addAccount">
            <form method="POST">

                <label for="username">Username:</label><br>
                <input type="text" id="username" name="username" required>
                <br>

                <label for="passWord">Password:</label><br>
                <input type="text" id="passWord" name="passWord" required>
                <br>

                <label for="retypePass">Confirm Password:</label><br>
                <input type="text" id="retypePass" name="retypePass" required>
                <br>               
                
                <button class="addButton" type="submit" name="addButton">ADD</button>
            </form>
        </div>

    </div>
    <?php
include_once('../includes/connection.php');

class AccountManager
{
    private $db;

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function addAccount($username, $password)
    {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        $insertQuery = "INSERT INTO admin_accounts (username, password) VALUES (?, ?)";
        $stmt = $this->db->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $hashedPassword);

        $addSuccess = $stmt->execute();

        $stmt->close();

        return $addSuccess;
    }
}

$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

$accountManager = new AccountManager($db);

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addButton"])) {
    $username = $_POST["username"];
    $password = $_POST["passWord"];
    $retypePassword = $_POST["retypePass"];

    if ($password == $retypePassword) {
        $addSuccess = $accountManager->addAccount($username, $password);

        if ($addSuccess) {
            echo "<script>alert('Account added successfully!');</script>";
        } else {
            echo "<script>alert('Failed to add account');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match');</script>";
    }
}
?>
    <!-- End of addAccount -->


    
<?php
include'../includes/footer.php';
?>