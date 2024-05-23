<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if MeetingID is set
if(isset($_REQUEST['MeetingID'])) {
    $Mid = $_REQUEST['MeetingID']; // Corrected variable name
    
    // Prepare and execute SELECT statement to retrieve meetings details
    $stmt = $connection->prepare("SELECT * FROM meetings WHERE MeetingID = ?");
    $stmt->bind_param("i", $Mid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['MeetingID'];
        $y = $row['ProjectID']; // Corrected column name
        $v = $row['MeetingName']; // Corrected column name
        $z = $row['Description']; // Corrected column name
        
        $w = $row['StartTime']; // Corrected column name
        $a = $row['EndTime']; // Corrected column name
        $b= $row['Location']; // Corrected column name
    } else {
        echo "Meeting not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Meeting</title>
 <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update meetings form -->
    <h2><u>Update meetings form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
    <label for="MeetingID">MeetingID:</label>
        <input type="number" name="MeetingID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>


        <label for="ProjectID">ProjectID:</label>
        <input type="number" name="ProjectID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        
        <label for="MeetingName">MeetingName:</label>
        <input type="text" name="MeetingName" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>


          <label for="Description">Description:</label>
        <input type="text" name="Description" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        
        <label for="StartTime">StartTime:</label>
        <input type="Time" name="StartTime" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>

         <label for="EndTime">EndTime:</label>
        <input type="Time" name="EndTime" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>

         <label for="Location">Location:</label>
        <input type="text" name="Location" value="<?php echo isset($b) ? $b : ''; ?>">
        <br><br>
        
        <input type="submit" name="up" value="Update">
        
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from meetings
    $MeetingID = $_POST['MeetingID'];
    $ProjectID = $_POST['ProjectID'];
    $MeetingName = $_POST['MeetingName'];
    $Description = $_POST['Description'];
    $StartTime = $_POST['StartTime']; // Corrected variable name
    $EndTime = $_POST['EndTime'];
    $Location = $_POST['Location']; // Corrected variable name

    // Update the meeting in the database
    $stmt = $connection->prepare("UPDATE meetings SET ProjectID=?,MeetingName=?, Description=?, StartTime=?, EndTime=?,Location=? WHERE MeetingID=?");
    $stmt->bind_param("isssssi", $ProjectID, $MeetingName,$Description, $StartTime, $EndTime, $Location, $MeetingID);
    
    if ($stmt->execute()) {
        // Redirect to meetings.php after successful update
        header('Location: meetings.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating meeting: " . $stmt->error;
    }
}
?>
