<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if TeamMemberID is set
if(isset($_REQUEST['TeamMemberID'])) {
    $TeamMemberID = $_REQUEST['TeamMemberID'];
    
    // Prepare and execute SELECT statement to retrieve TeamMembers details
    $stmt = $connection->prepare("SELECT * FROM TeamMembers WHERE TeamMemberID = ?");
    $stmt->bind_param("i", $TeamMemberID);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['TeamMemberID'];
        $y = $row['TeamID'];
        $v = $row['UserID'];
        $z = $row['Role'];
    } else {
        echo "TeamMembers not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update TeamMembers</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update TeamMembers form -->
    <h2><u>Update TeamMembers form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="TeamMemberID">TeamMemberID</label>
        <input type="number" name="TeamMemberID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>
        <label for="TeamID">TeamID:</label>
        <input type="number" name="TeamID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="UserID">UserID:</label>
        <input type="number" name="UserID" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="Role">Role::</label>
        <input type="text" name="Role" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from TeamMembers
    $TeamMemberID= $_POST['TeamMemberID'];
    $TeamID = $_POST['TeamID'];
    $UserID = $_POST['UserID'];
    $Role = $_POST['Role'];

    // Update the TeamMembers in the database
    $stmt = $connection->prepare("UPDATE TeamMembers SET TeamID=?, UserID=?, Role=? WHERE TeamMemberID=?");
    $stmt->bind_param("iisi", $TeamID, $UserID, $Role, $TeamMemberID);
    
    if ($stmt->execute()) {
        // Redirect to TeamMembers.php after successful update
        header('Location: TeamMembers.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating TeamMembers: " . $stmt->error;
    }
}
?>
