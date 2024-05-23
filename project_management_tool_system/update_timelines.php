<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if TimelineIDis set
if(isset($_REQUEST['TimelineID'])) {
    $Eid = $_REQUEST['TimelineID'];
    
    // Prepare and execute SELECT statement to retrieve timelines details
    $stmt = $connection->prepare("SELECT * FROM timelines WHERE TimelineID = ?");
    $stmt->bind_param("i", $Eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['TimelineID'];
        $y = $row['ProjectID'];
        $v = $row['EventName'];
        $z = $row['EventDate'];
    } else {
        echo "Expenses not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update timelines</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update timelines form -->
    <h2><u>Update timelines form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="TimelineID">TimelineID</label>
        <input type="number" name="TimelineID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>
        <label for="ProjectID">ProjectID:</label>
        <input type="number" name="ProjectID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="EventName">EventName:</label>
        <input type="text" name="EventName" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="EventDate">EventDate:</label>
        <input type="date" name="EventDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from timelines
    $TimelineID= $_POST['TimelineID'];
    $ProjectID = $_POST['ProjectID'];
    $EventName = $_POST['EventName'];
    $EventDate = $_POST['EventDate'];

    // Update the timelines in the database
    $stmt = $connection->prepare("UPDATE timelines SET ProjectID=?, EventName=?, EventDate=? WHERE TimelineID=?");
    $stmt->bind_param("idsi", $ProjectID, $EventName, $EventDate, $TimelineID);
    
    if ($stmt->execute()) {
        // Redirect to timelines.php after successful update
        header('Location: timelines.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating timelines: " . $stmt->error;
    }
}
?>
