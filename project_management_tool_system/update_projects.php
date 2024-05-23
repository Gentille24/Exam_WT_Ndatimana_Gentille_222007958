<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if customer_id is set
if(isset($_REQUEST['ProjectID'])) {
    $cid = $_REQUEST['ProjectID'];
    
    // Prepare and execute SELECT statement to retrieve projects details
    $stmt = $connection->prepare("SELECT * FROM projects WHERE ProjectID = ?");
    $stmt->bind_param("i", $Pid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ProjectID'];
        $y = $row['ProjectName']; // Corrected column name
        $v = $row['Description']; // Corrected column name
        $z = $row['StartDate']; // Corrected column name
        
        $w = $row['EndDate']; // Corrected column name
        $b = $row['Status']; // Corrected column name
    } else {
        echo "projects not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update projects</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update projects form -->
    <h2><u>Update projects form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="ProjectID">ProjectID:</label>
        <input type="number" name="ProjectID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>


        <label for="ProjectName">ProjectName:</label>
        <input type="text" name="TaskName" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="StartDate">StartDate:</label>
        <input type="date" name="StartDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>

         <label for="EndDate">EndDate:</label>
        <input type="date" name="EndDate" value="<?php echo isset($w) ? $w : ''; ?>">
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
    // Retrieve updated values from projects
    
    $ProjectID = $_POST['ProjectID'];
    $ProjectName = $_POST['ProjectName'];
    $Description = $_POST['Description'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];
    $Status = $_POST['Status'];

    // Update the projects in the database
    $stmt = $connection->prepare("UPDATE projects SET ProjectName=?, Description=?, StartDate=?, EndDate=?, Status=? WHERE ProjectID=?");
    $stmt->bind_param("sssssi", $ProjectName, $Description, $StartDate, $EndDate, $Status, $ProjectID);
    
    if ($stmt->execute()) {
        // Redirect to projects.php after successful update
        header('Location: projects.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating projects: " . $stmt->error;
    }
}
?>
