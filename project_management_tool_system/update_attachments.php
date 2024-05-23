<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if AttachmentID is set
if(isset($_REQUEST['AttachmentID'])) {
    $cid = $_REQUEST['AttachmentID'];
    
    // Prepare and execute SELECT statement to retrieve attachments details
    $stmt = $connection->prepare("SELECT * FROM attachments WHERE AttachmentID = ?");
    $stmt->bind_param("i", $aid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['AttachmentID'];
        $y = $row['TaskID']; // Corrected column name
        $z = $row['FileName']; // Corrected column name
        $v = $row['FilePath']; // Corrected column name
        $w = $row['UploadDate']; // Corrected column name
       
    } else {
        echo "attachments not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update attachments</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update attachments form -->
    <h2><u>Update attachments form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="AttachmentID">AttachmentID:</label>
        <input type="number" name="AttachmentID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>

        <label for="TaskID">TaskID:</label>
        <input type="number" name="TaskID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>

        <label for="FileName">FileName:</label>
        <input type="text" name="FileName" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="FilePath">FilePath:</label>
        <input type="text" name="FilePath" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        
        <label for="UploadDate">UploadDate:</label>
        <input type="date" name="UploadDate" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

      
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from form
    $AttachmentID = $_POST['AttachmentID'];
    $TaskID = $_POST['TaskID'];
    $FileName = $_POST['FileName'];
    $FilePath = $_POST['FilePath'];
    $UploadDate = $_POST['UploadDate'];

    // Check if TaskID exists in the tasks table
    $checkStmt = $connection->prepare("SELECT TaskID FROM tasks WHERE TaskID = ?");
    $checkStmt->bind_param("i", $TaskID);
    $checkStmt->execute();
    $checkResult = $checkStmt->get_result();

    if($checkResult->num_rows > 0) {
        // Update the attachments in the database
        $stmt = $connection->prepare("UPDATE attachments SET TaskID=?, FileName=?, FilePath=?, UploadDate=? WHERE AttachmentID=?");
        $stmt->bind_param("ssssi", $TaskID, $FileName, $FilePath, $UploadDate, $AttachmentID);
        
        if ($stmt->execute()) {
            // Redirect to attachments.php after successful update
            header('Location: attachments.php');
            exit(); // Ensure that no other content is sent after the header redirection
        } else {
            echo "Error updating attachments: " . $stmt->error;
        }
    } else {
        echo "Error: TaskID does not exist in the tasks table.";
    }
}
?>
