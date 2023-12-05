<!-- Start of Login Page -->
<!--require session-->

<!DOCTYPE html>
<html>
    <head>

        <title>Car Rental Login</title>
        
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">

        <link rel="stylesheet" href="../css/login.css">

    </head>
    <body>
        <header id="header">
            <div>
                <p id = "layco">LAYCO'S CAR RENTAL SERVICES</p>
            </div>
            <div id = "location">
                <h4>Brgy. Dagatan, Lipa City</h4>
            </div>
        </header>
    <br>
    </br>

        <div id ="rental_text">
            <h2>LAYCO'S CAR RENTAL LOGIN</h2>
        </div>

        <div class="login_container">
        <form action=" " method="post">
            <p class="admin-login">Admin</p>

            <input type="text" id="username" name="username" placeholder="Username" required><br>

            <input type="password" id="password" name="password" placeholder="Password" required><br>

            <button type="submit" name="login_user" id="login-button">Login</button>

        </form>
        </div>
            <img id="spartanLlogo" src="../icons/loginCar.png" alt="Logo" width="30%" height="auto" style=" margin:0;">
        <div>

        </div>

    </body>
</html>
<?php
include_once('../includes/connection.php');

class AdminLogin {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function login($username, $password) {
        if (empty($username) || empty($password)) {
            return "Please enter both username and password.";
        }
    
        $query = "SELECT * FROM admin_accounts WHERE username = ?";
        $stmt = $this->db->prepare($query);
    
        $stmt->bind_param("s", $username);
    
        $stmt->execute();

        $result = $stmt->get_result();
        $user = $result->fetch_assoc();

        $stmt->close();

        if ($user && password_verify($password, $user['password'])) {
            return true;
        } else {
            return "Invalid username or password.";
        }
    }
}

$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST["username"];
    $password = $_POST["password"];

    $adminLogin = new AdminLogin($db);
    $loginResult = $adminLogin->login($username, $password);

    if ($loginResult === true) {
        header("Location: dashboard.php");
        exit();
    } else {
        echo $loginResult;
    }
}
?>


<!-- End of Login Page -->


    
