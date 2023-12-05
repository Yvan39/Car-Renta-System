# Car-Rental-System

**OVERVIEW**

The **Car Rental Management System** is a web-based application designed to streamline car rental business operations. It offers a comprehensive dashboard for quick insights, user authentication for security, and various features such as ongoing and completed rentals, advance booking, car listing, and account management.

**TECHNOLOGIES USED**

- **Frontend**: HTML, CSS, JavaScript
- **Backend**: Php for server-side scripting
- **Database**: MySQL
- **Version Control**: Git for efficient version management

**USER AUTHENTICATION**

The system includes a login feature to enhance security. Only authorized users can access the admin functionalities. Follow the steps below to log in:

1. Open the application in your web browser.
2. You will be redirected to the login page.
3. Enter your username and password (Default login: username-admin, password-admin).
4. Click the "Login" button.

**DASHBOARD**

The dashboard provides a quick overview of the rental business with the following sections:

- **Ongoing Rental/s**: Displays details of ongoing rentals, including customer name, car information, borrow date, return date, price, fine per day, status, and actions (e.g., input returned date, penalty, update status).

- **Completed Rentals**: Presents a table of transaction history for completed rentals, including customer name, car details, borrow date, return date, price, fine per day, date returned, penalty, gross income, and status.

- **Gross Income**: Offers an overview of the total gross income generated from completed rentals.

**RENTALS**

- **Advance Booking**: Features a table with details of advance bookings, including transaction number, date, customer name, car information, borrow date, return date, price, fine per day, status, and actions (e.g., edit, update status, cancel).

- **Ongoing Rental/s**: Displays a table with ongoing rentals, showing transaction number, customer name, car information, borrow date, return date, price, fine per day, status, and actions (e.g., input returned date, penalty, update status).

 **TRANSACTION HISTORY** 
 
 A searchable table providing details such as transaction number, customer name, car details, borrow date, return date, price, fine per day, date returned, penalty, gross income, and status.

**CAR SECTION**

- **Car Listing**: Displays a table listing all available cars for rentals, including car name, brand, model, year model, color, and actions (e.g., delete).

- **Add Car**: Form for adding a new car to the listing with fields for car name, brand, model, year model, and color.

**ACCOUNTS**

- **Admin Account Management**: Table listing admin accounts with columns for username and actions (e.g., edit password).

- **Edit Account**: Form for editing an admin account, allowing changes to the password.

- **Add Account**: Form for adding a new admin account with fields for username and password.

**FORMS**

- **New Transaction**: Fields for date, customer name, car selection (dropdown list), borrow date, return date, price, fine per day, and status (upcoming or ongoing).

- **Advance Booking (Edit, Update Status, Cancel)**:
  - Edit Form: Displays details based on the table for modifications.
  - Update Form: Fields for transaction number, status, and an update button.
  - Cancel Form: Fields for transaction number and a cancel button (clears data).

- **Ongoing Rental (Update Status)**: Fields for transaction number, returned date, penalty, and an update status button.

- **Car Section (Add Car)**: Fields for car name, brand, model, year model, color, and an add car button.

- **Accounts (Edit, Add Account)**:
  - Edit Form: Fields for account number, username, and a new password.
  - Add Account Form: Fields for username and password.

**USAGE**

1. **Dashboard**: Navigate for an overview of ongoing rentals, completed rentals, and gross income.

2. **Rentals**: Manage advance bookings, ongoing rentals, and view transaction history.

3. **Car Section**: Add, edit, or delete cars available for rentals.

4. **Accounts**: Manage admin accounts, edit passwords, and add new admin accounts.
