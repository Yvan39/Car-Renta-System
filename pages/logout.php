<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.min.css">
</head>
<body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.3.2/dist/sweetalert2.all.min.js"></script>
<script>
    class LogoutConfirmation {
        constructor() {
            this.button = document.getElementById("btn");
            this.setupListeners();
        }

        setupListeners() {
            this.button.addEventListener("click", () => this.showConfirmation());
        }

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

        logout() {
            Swal.fire('Logged out successfully!', '', 'success');
            window.location.href = 'login.php';
        }
    }
    const logoutConfirmation = new LogoutConfirmation();
</script>
    
</body>
</html>