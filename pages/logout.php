<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Logout Confirmation</title>
    
    <!-- Link to the SweetAlert2 CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.min.css">
</head>
<body>

<!-- Script to display a logout confirmation using SweetAlert2 -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.all.min.js"></script>
<script>
    // Class for handling logout confirmation
    class LogoutConfirmation {
        constructor() {
            this.button = document.getElementById("btn");
            this.setupListeners();
        }

        // Set up event listeners
        setupListeners() {
            this.button.addEventListener("click", () => this.showConfirmation());
        }

        // Display SweetAlert2 confirmation dialog
        showConfirmation() {
            Swal.fire({
                title: 'Logout Confirmation',
                text: 'Are you sure you want to log out?',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: 'Yes',
                cancelButtonText: 'No',
            }).then((result) => {
                if (result.isConfirmed) {
                    this.logout();
                } else if (result.dismiss === Swal.DismissReason.cancel) {
                    Swal.fire('Logout canceled', '', 'info');
                }
            });
        }

        // Perform logout action and redirect to login page
        logout() {
            Swal.fire('Logged out successfully!', '', 'success');
            window.location.href = 'login.php';
        }
    }

    // Create an instance of the LogoutConfirmation class
    const logoutConfirmation = new LogoutConfirmation();
</script>
    
</body>
</html>
