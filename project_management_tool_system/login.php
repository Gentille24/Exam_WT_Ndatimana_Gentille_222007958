<?php
session_start();
// Include the file that contains the database connection
include "dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Ensure that Email and password are set in the POST request
    if (isset($_POST['Email'], $_POST['Password'])) {
        $email = $_POST['Email'];
        $password = $_POST['Password'];
        
        // Validate inputs
        if (empty($email) || empty($password)) {
            echo "Invalid Email or password.";
            exit();
        }

        // Use prepared statements to prevent SQL injection
        $stmt = $connection->prepare("SELECT * FROM users WHERE Email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();
        $result = $stmt->get_result();
        
        if ($result->num_rows == 1) {
            $row = $result->fetch_assoc();
            // Verify the password
            if (password_verify($password, $row['Password'])) {
                $_SESSION['UserID'] = $row['UserID'];
                header("Location: Home.html");
                exit();
            } else {
                echo "Invalid Email or password.";
            }
        } else {
            echo "Invalid Email or password.";
        }
        // Close the statement
        $stmt->close();
    } else {
        echo "Invalid Email or password.";
    }
}
?>
