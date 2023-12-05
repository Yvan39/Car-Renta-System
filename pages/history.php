<?php
include'../includes/connection.php';
include'../includes/sidebar.php';
?>

    <style>
        .prodTable{
        width: calc(100% - 320px);
        margin-top: 40px;
        margin-left: 310px;
        display:inline-block;
        background: rgb(245, 245, 245);
        }

        .m-2{
        color: maroon;
        display: inline-block;
        }

        .search-bar {
        max-width: 300px;
        display: inline-block;
        margin-left: 70%;
        }
    </style>

    <!-- main table for transactionHistory, for viewing only-->
    <!-- Start of transactionHistory -->
    <div class="prodTable">
    <div class="card shadow mb-4">
            <div class="card-header py-3">
                <h4 class="m-2 font-weight-bold ">Products</h4>
                <div class = "search-bar">
                    <input type="text" id="searchInput" placeholder="Search Customer Name..." class="form-control">
                </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>

        <script>
        // JavaScript for the search functionality
        document.getElementById("searchInput").addEventListener("input", function () {
            var searchTerm = this.value.toLowerCase();
            var customerNames = document.querySelectorAll("#dataTable tbody tr td:nth-child(2)"); // Assuming customer names are in the second column

            customerNames.forEach(function (name) {
                var nameText = name.textContent.toLowerCase();
                var row = name.closest("tr");

                if (nameText.includes(searchTerm)) {
                    row.style.display = ""; // Show the row
                } else {
                    row.style.display = "none"; // Hide the row
                }
            });
        });
    </script>
            </div>
            <div class="card-body">
              <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0"> 
               <thead>
                   <tr>
                     <th>No.</th>
                     <th>CUSTOMER NAME</th>
                     <th>CAR</th>
                     <th>BORROW DATE</th>
                     <th>RETURN DATE</th>   
                     <th>PRICE</th>
                     <th>FINE P.D</th>
                     <th>DATE RETURNED</th>
                     <th>PENALTY</th>
                     <th>GROSS INC</th>
                     <th>STATUS</th>
                   </tr>
               </thead>
                <tbody>
                <?php
                        include_once('../includes/connection.php');
                        $dbConnection = new DbConnection();
                        $db = $dbConnection->getConnection();
                                $Query = "SELECT rentals.rentalId, customers.name AS customer_name, cars.carName, rentals.borrowDate, rentals.returnDate, rentals.price, rentals.fine_per_day, rentals.status, rentals.dateReturned, rentals.penalty, (rentals.price + rentals.penalty) AS grossIncome
                                FROM rentals
                                INNER JOIN customers ON rentals.customerId = customers.customerId 
                                INNER JOIN cars ON rentals.carId = cars.carId
                                WHERE rentals.status = 'completed'";
                                $result = $db->query($Query);
                        
                                if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) {
                                    echo "<tr>";
                                    echo "<td>{$row['rentalId']}</td>";
                                    echo "<td>{$row['customer_name']}</td>";
                                    echo "<td>{$row['carName']}</td>";
                                    echo "<td>{$row['borrowDate']}</td>";
                                    echo "<td>{$row['returnDate']}</td>";
                                    echo "<td>{$row['price']}</td>";
                                    echo "<td>{$row['fine_per_day']}</td>";
                                    echo "<td>{$row['dateReturned']}</td>";
                                    echo "<td>{$row['penalty']}</td>";
                                    echo "<td>{$row['grossIncome']}</td>";
                                    echo "<td>{$row['status']}</td>";                                                        
                                }
                                } else {
                                echo "<tr><td colspan='9'>No completed rentals found</td></tr>";
                                }
                        ?>
                    </tbody>
                </tbody>
                            
                </table>
                        
               </div>                  
            </div>
                  
    </div>
    </div>
    <!-- End of transactionHistory -->


    
<?php
include'../includes/footer.php';
?>