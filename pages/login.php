<!-- Start of Login Page -->
<!--require session-->

<!DOCTYPE html>
<html>
    <head>

        <title>Car Rental Login</title>
        
        <!-- Bootstrap CSS -->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <!-- Custom CSS -->
        <link rel="stylesheet" href="../css/login.css">

    </head>
    <body>
        <!-- Header Section -->
        <header id="header">
            <div>
                <p id="layco">LAYCO'S CAR RENTAL SERVICES</p>
            </div>
            <div id="location">
                <h4>Brgy. Dagatan, Lipa City</h4>
            </div>
        </header>
        <br></br>

        <!-- Rental Text Section -->
        <div id="rental_text">
            <h2>LAYCO'S CAR RENTAL LOGIN</h2>
        </div>

        <!-- Login Container Section -->
        <div class="login_container">
            <form action=" " method="post">
                <p class="admin-login">Admin</p>

                <!-- Input fields for username and password -->
                <input type="text" id="username" name="username" placeholder="Username" required><br>
                <input type="password" id="password" name="password" placeholder="Password" required><br>

                <!-- Login Button -->
                <button type="submit" name="login_user" id="login-button">Login</button>
            </form>
        </div>
        <!-- Spartan Logo Section -->
        <img id="spartanLlogo" src="../icons/loginCar.png" alt="Logo" width="30%" height="auto" style="margin:0;">
        <div>
        </div>
    </body>
</html>

<?php
// Include the connection file
include_once('../includes/connection.php');

// Class for Admin Login functionality
class AdminLogin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    // Method to validate and perform admin login
    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            return "Please enter both username and password.";
        }
    
        // SQL query to retrieve admin account
        $query = "SELECT * FROM admin_accounts WHERE username = ?";
        $stmt = $this->db->prepare($query);
    
        $stmt->bind_param("s", $username);
    
        $stmt->execute();

        // Fetch user information from the result set
        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();

        // Validate username and password
        if ($user && password_verify($password, $user['password'])) {
            return true; // Successful login
        } else {
            return "Invalid username or password."; // Failed login
        }
    }
}

// Create a new instance of the DbConnection class
$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

// Check if the login form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    // Create a new instance of AdminLogin class
    $adminLogin = new AdminLogin($db);

    // Perform admin login
    $loginResult = $adminLogin->login($username, $password);

    // Redirect to the dashboard if login is successful
    if ($loginResult === true) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo $loginResult; // Display error message if login fails
    }
}
?>


<!-- End of Login Page -->


    
