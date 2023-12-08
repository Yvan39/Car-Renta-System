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
    <!-- Card header with navigation tabs -->
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <!-- Active tab for adding an account -->
                <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">ADD ACCOUNT</a>
            </li>
        </ul>
    </div>

    <!-- Form for adding an account -->
    <div class="addAccount">
        <form method="POST">
            <!-- Username input field -->
            <label for="username">Username:</label><br>
            <input type="text" id="username" name="username" required>
            <br>

            <!-- Password input field -->
            <label for="passWord">Password:</label><br>
            <input type="text" id="passWord" name="passWord" required>
            <br>

            <!-- Confirm Password input field -->
            <label for="retypePass">Confirm Password:</label><br>
            <input type="text" id="retypePass" name="retypePass" required>
            <br>

            <!-- Submit button for adding an account -->
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

    // Method to add an account to the database
    public function addAccount($username, $password)
    {
        // Hash the password before storing it
        $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

        // SQL query to insert account information into the database
        $insertQuery = "INSERT INTO admin_accounts (username, password) VALUES (?, ?)";
        
        // Prepare and bind parameters for the SQL query
        $stmt = $this->db->prepare($insertQuery);
        $stmt->bind_param("ss", $username, $hashedPassword);

        // Execute the query and store the success status
        $addSuccess = $stmt->execute();

        // Close the prepared statement
        $stmt->close();

        // Return the success status
        return $addSuccess;
    }
}

// Establish a database connection
$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

// Create an instance of the AccountManager class
$accountManager = new AccountManager($db);

// Check if the form has been submitted and the add button is clicked
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["addButton"])) {
    // Get input values from the form
    $username = $_POST["username"];
    $password = $_POST["passWord"];
    $retypePassword = $_POST["retypePass"];

    // Check if the entered passwords match
    if ($password == $retypePassword) {
        // Attempt to add the account
        $addSuccess = $accountManager->addAccount($username, $password);

        // Display success or failure messages based on the result
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