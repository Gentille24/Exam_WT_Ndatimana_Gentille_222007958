<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if customer_id is set
if(isset($_REQUEST['TaskID'])) {
    $cid = $_REQUEST['TaskID'];
    
    // Prepare and execute SELECT statement to retrieve customer details
    $stmt = $connection->prepare("SELECT * FROM tasks WHERE TaskID = ?");
    $stmt->bind_param("i", $Tid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['TaskID'];
        $y = $row['ProjectID']; // Corrected column name
        $z = $row['TaskName']; // Corrected column name
        $v = $row['Description']; // Corrected column name
        $w = $row['AssignedTo']; // Corrected column name
         $t = $row['DueDate']; // Corrected column name
         $a = $row['Priority']; // Corrected column name
         $b = $row['Status']; // Corrected column name
    } else {
        echo "Customer not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update tasks</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update tasks form -->
    <h2><u>Update tasks form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="TaskID">TaskID:</label>
        <input type="number" name="TaskID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="ProjectID">ProjectID:</label>
        <input type="number" name="ProjectID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="TaskName">TaskName:</label>
        <input type="text" name="TaskName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="AssignedTo">AssignedTo:</label>
        <input type="date" name="AssignedTo" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="DueDate">DueDate:</label>
        <input type="date" name="DueDate" value="<?php echo isset($t) ? $t : ''; ?>">
        <br><br>

         <label for="Priority">Priority:</label>
        <input type="text" name="Priority" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

         <label for="Status">Status:</label>
        <input type="text" name="Status" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $TaskID = $_POST['TaskID'];
    $ProjectID = $_POST['ProjectID'];
    $TaskName = $_POST['TaskName'];
    $Description = $_POST['Description'];
    $AssignedTo = $_POST['AssignedTo'];
    $DueDate = $_POST['DueDate'];
    $Priority = $_POST['Priority'];
    $Status = $_POST['Status'];



    // Update the tasks in the database
    $stmt = $connection->prepare("UPDATE tasks SET ProjectID=?, TaskName=?,Description=?, AssignedTo=?, DueDate=?,Priority=?,Status=? WHERE TaskID=?");
    $stmt->bind_param("sssssssi", $ProjectID, $TaskName, $Description, $AssignedTo,$DueDate,$Priority,$Status, $TaskID);
    
    if ($stmt->execute()) {
        // Redirect to tasks.php after successful update
        header('Location: tasks.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating tasks: " . $stmt->error;
    }
}
?>
