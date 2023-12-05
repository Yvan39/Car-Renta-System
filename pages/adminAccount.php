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

    public function __construct($db)
    {
        $this->db = $db;
    }

    public function getAdminAccounts()
    {
        $selectQuery = "SELECT admin_id, username, password FROM admin_accounts";
        $result = $this->db->query($selectQuery);

        return $result;
    }
}

$dbConnection = new DbConnection();
$db = $dbConnection->getConnection();

$adminAccountManager = new AdminAccountManager($db);

$adminAccounts = $adminAccountManager->getAdminAccounts();
?>
    <!-- Main Table to show list of accounts -->
    <!-- Start of adminAccount -->
    <div class="cardProduct">
    <div class="card shadow mb-4">
            <div class="card-header py-3" id="ad-head">
                <h4 class="m-2 font-weight-bold">Admin Account(s)</h4>
                <a class="add-btn"  href="add_Account.php">
                    <i class="fa-solid fa-user-plus fa-2xl" id="add-user" style="color: #ffd700;"></i>
                </a>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th>Action</th>
                            </tr>
                        </thead>
                    <tbody>
                    <?php
                    if ($adminAccounts->num_rows > 0) {
                        while ($row = $adminAccounts->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>{$row['admin_id']}</td>";
                            echo "<td>{$row['username']}</td>";
                            echo "<td>{$row['password']}</td>";
                            echo "<td><a href='edit_account.php?id={$row['admin_id']}' class='btn btn-primary'>Edit</a></td>";
                            echo "</tr>";
                        }
                    } else {
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