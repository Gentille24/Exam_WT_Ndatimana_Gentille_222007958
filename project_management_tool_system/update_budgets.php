<?php
include('dbconnection.php'); // Include your database connection file

// Check if BudgetID is set
if(isset($_REQUEST['BudgetID'])) {
    $Bid = $_REQUEST['BudgetID'];
    
    // Prepare and execute SELECT statement to retrieve budgets details
    $stmt = $connection->prepare("SELECT * FROM budgets WHERE BudgetID = ?");
    $stmt->bind_param("i", $Bid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['BudgetID'];
        $a = $row['ProjectID'];
        $y = $row['BudgetName'];
        $v = $row['Amount'];
        $z = $row['StartDate'];
        $w = $row['EndDate'];
    } else {
        echo "Budget not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update Budget</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update Budget form -->
    <h2><u>Update Budget form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <input type="hidden" name="BudgetID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>
        <label for="ProjectID">ProjectID:</label>
        <input type="number" name="ProjectID" value="<?php echo isset($a) ? $a : ''; ?>">
        <br><br>
        <label for="BudgetName">BudgetName:</label>
        <input type="text" name="BudgetName" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="Amount">Amount:</label>
        <input type="number" name="Amount" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="StartDate">StartDate:</label>
        <input type="date" name="StartDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <label for="EndDate">EndDate:</label>
        <input type="date" name="EndDate" value="<?php echo isset($w) ? $w : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from Budget
    $BudgetID = $_POST['BudgetID'];
    $ProjectID = $_POST['ProjectID'];
    $BudgetName = $_POST['BudgetName'];
    $Amount = $_POST['Amount'];
    $StartDate = $_POST['StartDate'];
    $EndDate = $_POST['EndDate'];

    // Update the Budget in the database
    $stmt = $connection->prepare("UPDATE budgets SET ProjectID=?, BudgetName=?, Amount=?, StartDate=?, EndDate=? WHERE BudgetID=?");
    $stmt->bind_param("sssssi", $ProjectID, $BudgetName, $Amount, $StartDate, $EndDate, $BudgetID);
    
    if ($stmt->execute()) {
        // Redirect to budgets.php after successful update
        header('Location: budgets.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating Budget: " . $stmt->error;
    }
}
?>
