<?php
include('dbconnection.php');

// Check if MeetingID is set
if(isset($_REQUEST['MeetingID'])) {
    $pid = $_REQUEST['MeetingID'];
    
    // Prepare and execute the DELETE statement
    $stmt = $connection->prepare("DELETE FROM meetings WHERE MeetingID=?");
    $stmt->bind_param("i", $mid);
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
            <input type="hidden" name="pid" value="<?php echo $mid; ?>">
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
    echo "MeetingID is not set.";
}

$connection->close();
?>
