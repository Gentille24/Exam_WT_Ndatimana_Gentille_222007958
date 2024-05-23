<?php
// Connection details
include('dbconnection.php'); // Include your database connection file

// Check if ExpenseID is set
if(isset($_REQUEST['ExpenseID'])) {
    $Eid = $_REQUEST['ExpenseID'];
    
    // Prepare and execute SELECT statement to retrieve expenses details
    $stmt = $connection->prepare("SELECT * FROM expenses WHERE ExpenseID = ?");
    $stmt->bind_param("i", $Eid);
    $stmt->execute();
    $result = $stmt->get_result();
    
    if($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $x = $row['ExpenseID'];
        $y = $row['BudgetID'];
        $v = $row['Amount'];
        $z = $row['ExpenseDate'];
    } else {
        echo "Expenses not found.";
    }
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>Update expenses</title>
    <!-- JavaScript validation and content load for update or modify data-->
    <script>
        function confirmUpdate() {
            return confirm('Are you sure you want to update this record?');
        }
    </script>
</head>
<body><center>
    <!-- Update expenses form -->
    <h2><u>Update expenses form</u></h2>
    <form method="POST" onsubmit="return confirmUpdate();">
        <label for="ExpenseID">ExpenseID</label>
        <input type="number" name="ExpenseID" value="<?php echo isset($x) ? $x : ''; ?>">
        <br><br>
        <label for="BudgetID">BudgetID:</label>
        <input type="number" name="BudgetID" value="<?php echo isset($y) ? $y : ''; ?>">
        <br><br>
        <label for="Amount">Amount:</label>
        <input type="number" name="Amount" value="<?php echo isset($v) ? $v : ''; ?>">
        <br><br>
        <label for="ExpenseDate">ExpenseDate:</label>
        <input type="date" name="ExpenseDate" value="<?php echo isset($z) ? $z : ''; ?>">
        <br><br>
        <input type="submit" name="up" value="Update">
    </form>
</body>
</html>

<?php
if(isset($_POST['up'])) {
    // Retrieve updated values from expenses
    $ExpenseID = $_POST['ExpenseID'];
    $BudgetID = $_POST['BudgetID'];
    $Amount = $_POST['Amount'];
    $ExpenseDate = $_POST['ExpenseDate'];

    // Update the expenses in the database
    $stmt = $connection->prepare("UPDATE expenses SET BudgetID=?, Amount=?, ExpenseDate=? WHERE ExpenseID=?");
    $stmt->bind_param("idsi", $BudgetID, $Amount, $ExpenseDate, $ExpenseID);
    
    if ($stmt->execute()) {
        // Redirect to expenses.php after successful update
        header('Location: expenses.php');
        exit(); // Ensure that no other content is sent after the header redirection
    } else {
        echo "Error updating expenses: " . $stmt->error;
    }
}
?>
