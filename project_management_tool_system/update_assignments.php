<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if AssignmentID is set
if (isset($_REQUEST['AssignmentID'])) {
    $AssignmentID = $connection->real_escape_string($_REQUEST['AssignmentID']);
    
    // Prepare and execute SELECT statement to retrieve assignments details
    $stmt = $connection->prepare("SELECT * FROM assignments WHERE AssignmentID = ?");
    $stmt->bind_param("i", $AssignmentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AssignmentID'];
        $y = $row['TaskID'];
        $z = $row['UserID'];
    } else {
        echo "Assignment not found.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Update Assignments</title>
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body>
<center>
    <h2><u>Update Assignments Form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="AssignmentID">AssignmentID:</label>
        <input type="number" name="AssignmentID" value="<?php echo isset($x) ? $x : ''; ?>" readonly>
        <br><br>
        <label for="TaskID">TaskID:</label>
        <input type="number" name="TaskID" value="<?php echo isset($y) ? $y : ''; ?>" required>
        <br><br>
        <label for="UserID">UserID:</label>
        <input type="text" name="UserID" value="<?php echo isset($z) ? $z : ''; ?>" required>
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</center>
</body>
</html>

<?php
if (isset($_POST['up'])) {
    // Retrieve updated values from form
    $AssignmentID = $connection->real_escape_string($_POST['AssignmentID']);
    $TaskID = $connection->real_escape_string($_POST['TaskID']);
    $UserID = $connection->real_escape_string($_POST['UserID']);

    // Verify that the TaskID exists in the tasks table
    $stmt = $connection->prepare("SELECT TaskID FROM tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $TaskID);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // Update the assignments in the database
        $stmt = $connection->prepare("UPDATE assignments SET TaskID = ?, UserID = ? WHERE AssignmentID = ?");
        $stmt->bind_param("ssi", $TaskID, $UserID, $AssignmentID);

        if ($stmt->execute()) {
            // Redirect to assignments.php after successful update
            header('Location: assignments.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating assignment: " . $stmt->error;
        }
    } else {
        echo "Error: TaskID does not exist.";
    }
}
$connection->close();
?>
