<?php
// Call the file that contains the database connection
include "dbconnection.php";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $UserID = $_POST['UserID'];
    $Username = $_POST['Username'];
    $Password = $_POST['Password'];
    $Email = $_POST['Email'];
    $Role = $_POST['Role'];
    
    // Hash the password
    $hashedPassword = password_hash($Password, PASSWORD_DEFAULT);

    $sql = "INSERT INTO users (UserID, Username, Password, Email, Role) VALUES ('$UserID', '$Username', '$hashedPassword', '$Email', '$Role')";
    $result = $connection->query($sql);
    if (!$result) {
        echo "Error: " . $sql . "<br>" . $connection->error;
    } else {
        echo "Data Inserted Successfully";
        header("location: login.html");
        exit();
    }
}
?>
