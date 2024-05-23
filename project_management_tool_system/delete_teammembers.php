<?php
include('dbconnection.php');

// Check if teammembersID is set
if(isset($_REQUEST['TeamMemberID'])) {
    $pid = $_REQUEST['TeamMemberID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM TeamMembers WHERE TeamMemberID=?");
    $stmt->bind_param("i", $tid);
     ?>
    <!DOCTYPE html>
    <html>
    <head>
        <title>Delete Record</title>
        <script>
            function confirmDelete() {
                return confirm("Are you sure you want to delete this record?");
            }
        </script>
    </head>
    <body>
        <form method="post" onsubmit="return confirmDelete();">
            <input type="hidden" name="pid" value="<?php echo $tid; ?>">
            <input type="submit" value="Delete">
        </form>

        <?php
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if ($stmt->execute()) {
        echo "Record deleted successfully.";
    } else {
        echo "Error deleting data: " . $stmt->error;
    }
}
?>
</body>
</html>
<?php

    $stmt->close();
} else {
    echo "TeamMemberID is not set.";
}

$connection->close();
?>
