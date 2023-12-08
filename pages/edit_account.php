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



        .editAccountForm{
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
    <!-- Form to edit or change password -->
    <!-- Start of editAccount -->
    <?php

class Database {
    // Method to update the password for a given adminId
    public function updatePassword($adminId, $newPassword) {

        // Establish a PDO connection to the database
        $pdo = new PDO("mysql:host=localhost;dbname=car_rental_system", "root", "");

        // Hash the new password before updating
        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        // SQL query to update the password for the specified adminId
        $sql = "UPDATE admin_accounts SET password = :password WHERE admin_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $adminId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        // Execute the query and return success or failure
        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}

class AccountEditor {
    private $adminIdFromUrl;

    // Constructor to initialize the adminIdFromUrl property
    public function __construct() {
        // Check if 'id' is set in the GET parameters
        if (isset($_GET["id"])) {
            $this->adminIdFromUrl = $_GET["id"];
        } else {
            $this->adminIdFromUrl = 0;
        }
    }

    // Method to handle form submission
    public function handleFormSubmission() {
        // Check if the form has been submitted using the POST method
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Get the admin_id and new password from the POST parameters
            $adminId = $_POST["admin_id"];
            $newPassword = $_POST["newPassword"];

            // Call the updateAccount method with the obtained values
            $this->updateAccount($adminId, $newPassword);
        }
    }

    // Method to display the admin ID in the form
    public function displayAdminId() {
        echo '<label for="admin_id">ID:</label><br>';
        echo '<input type="text" name="admin_id" readonly value="' . $this->adminIdFromUrl . '">';
        echo '<br>';
    }

    // Method to update the account using the Database class
    public function updateAccount($adminId, $newPassword) {

        // Create an instance of the Database class
        $db = new Database();

        // Check the result of the update operation and display an alert
        if ($db->updatePassword($adminId, $newPassword)) {
            echo "<script>alert('Account updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update account!');</script>";
        }
    }
}

// Create an instance of the AccountEditor class
$accountEditor = new AccountEditor();

// Call the handleFormSubmission method to process the form data
$accountEditor->handleFormSubmission();
?>

<!-- Form to edit or change password -->
<div class="cardProduct">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs">
            <li class="nav-item">
                <a class="nav-link active" aria-current="true" style="color: white; background-color: rgb(25,25,112); font-weight: bold;">EDIT ACCOUNT</a>
            </li>             
        </ul>
    </div>
    <div class="editAccountForm">
        <form method="POST">
            <?php
                $accountEditor->displayAdminId();
            ?>
            <label for="newPassword">New Password:</label><br>
            <input type="text" id="newPassword" name="newPassword" required>
            <br>     
            
            <button class="updateButton" type="submit" name="updateButton">UPDATE</button>
        </form>
    </div>
</div>

    <!-- End of editAccount -->


    
<?php
include'../includes/footer.php';
?>