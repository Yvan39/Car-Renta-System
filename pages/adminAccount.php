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

    #add-user{
    display: inline-block;
    position: absolute;
    left: 225px;
    top: 25px;
    margin: 5px;
    padding: 5px;
    }
    </style>
<?php
include_once('../includes/connection.php');

class AdminAccountManager
{
    private $db;

    // Constructor to initialize the database connection
    public function __construct($db)
    {
        $this->db = $db;
    }

    // Method to retrieve admin accounts from the database
    public function getAdminAccounts()
    {
        // SQL query to select admin accounts
        $selectQuery = "SELECT admin_id, username, password FROM admin_accounts";
        
        // Execute the query and store the result
        $result = $this->db->query($selectQuery);

        // Return the result set
        return $result;
    }
}

// Create a database connection
$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

// Create an instance of the AdminAccountManager class
$adminAccountManager = new AdminAccountManager($db);

// Retrieve admin accounts from the database
$adminAccounts = $adminAccountManager->getAdminAccounts();
?>
<!-- Main Table to show the list of admin accounts -->
<!-- Start of adminAccount -->
<div class="cardProduct">
    <div class="card shadow mb-4">
        <!-- Card header with title and add button -->
        <div class="card-header py-3" id="ad-head">
            <h4 class="m-2 font-weight-bold">Admin Account(s)</h4>
            <!-- Add button linking to add_Account.php -->
            <a class="add-btn" href="add_Account.php">
                <i class="fa-solid fa-user-plus fa-2xl" id="add-user" style="color: #ffd700;"></i>
            </a>
        </div>
        <!-- Card body with a responsive table -->
        <div class="card-body">
            <div class="table-responsive">
                <!-- Table displaying admin account information -->
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <!-- Table header -->
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Username</th>
                            <th>Password</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <!-- Table body with admin account data -->
                    <tbody>
                        <?php
                        // Check if there are admin accounts in the result set
                        if ($adminAccounts->num_rows > 0) {
                            // Loop through each admin account and display its information in a row
                            while ($row = $adminAccounts->fetch_assoc()) {
                                echo "<tr>";
                                echo "<td>{$row['admin_id']}</td>";
                                echo "<td>{$row['username']}</td>";
                                echo "<td>{$row['password']}</td>";
                                // Edit button linking to edit_account.php with the admin_id parameter
                                echo "<td><a href='edit_account.php?id={$row['admin_id']}' class='btn btn-primary'>Edit</a></td>";
                                echo "</tr>";
                            }
                        } else {
                            // Display a message if no admin accounts are found
                            echo "<tr><td colspan='4'>No admin accounts found</td></tr>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

    
    <!-- End of adminAccount -->


    
<?php
include'../includes/footer.php';
?>