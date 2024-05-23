<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if CommentID is set
if(isset($_REQUEST['CommentID'])) {
    $CommentID = $_REQUEST['CommentID'];
    
    // Prepare and execute SELECT statement to retrieve taskcomments details
    $stmt = $connection->prepare("SELECT * FROM taskcomments WHERE CommentID = ?");
    $stmt->bind_param("i", $CommentID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['CommentID'];
        $y = $row['TaskID'];
        $v = $row['UserID'];
        $z = $row['CommentText'];
    } else {
        echo "taskcomments not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update taskcomments</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update taskcomments form -->
    <h2><u>Update taskcomments form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="CommentID">CommentID</label>
        <input type="number" name="CommentID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>
        <label for="TaskID">TaskID:</label>
        <input type="number" name="TaskID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="CommentText">CommentText::</label>
        <input type="text" name="CommentText" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from taskcomments
    $CommentID= $_POST['CommentID'];
    $TaskID = $_POST['TaskID'];
    $UserID = $_POST['UserID'];
    $CommentText = $_POST['CommentText'];

    // Update the taskcomments in the database
    $stmt = $connection->prepare("UPDATE taskcomments SET TaskID=?, UserID=?, CommentText=? WHERE CommentID=?");
    $stmt->bind_param("iisi", $TaskID, $UserID, $CommentText, $CommentID);
    
    if ($stmt->execute()) {
        // Redirect to taskcomments.php after successful update
        header('Location: taskcomments.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating taskcomments: " . $stmt->error;
    }
}
?>
