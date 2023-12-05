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
    public function updatePassword($adminId, $newPassword) {

        $pdo = new PDO("mysql:host=localhost;dbname=car_rental_system", "root", "");

        $hashedPassword = password_hash($newPassword, PASSWORD_DEFAULT);

        $sql = "UPDATE admin_accounts SET password = :password WHERE admin_id = :id";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $adminId, PDO::PARAM_INT);
        $stmt->bindParam(':password', $hashedPassword, PDO::PARAM_STR);

        if ($stmt->execute()) {
            return true; 
        } else {
            return false; 
        }
    }
}

class AccountEditor {
    private $adminIdFromUrl;

    public function __construct() {
        if (isset($_GET["id"])) {
            $this->adminIdFromUrl = $_GET["id"];
        } else {
            $this->adminIdFromUrl = 0;
        }
    }

    public function handleFormSubmission() {
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $adminId = $_POST["admin_id"];
            $newPassword = $_POST["newPassword"];

            $this->updateAccount($adminId, $newPassword);
        }
    }

    public function displayAdminId() {
        echo '<label for="admin_id">ID:</label><br>';
        echo '<input type="text" name="admin_id" readonly value="' . $this->adminIdFromUrl . '">';
        echo '<br>';
    }

    public function updateAccount($adminId, $newPassword) {

        $db = new Database();

        if ($db->updatePassword($adminId, $newPassword)) {
            echo "<script>alert('Account updated successfully!');</script>";
        } else {
            echo "<script>alert('Failed to update account!');</script>";
        }
    }
}

$accountEditor = new AccountEditor();
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