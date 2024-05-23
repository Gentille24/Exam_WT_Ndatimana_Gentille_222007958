<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>expenses Form</title>
    <style>
        /* Add CSS for table styling */
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
        footer {
            background-color: teal;
            text-align: center;
            width: 100%;
            color: white;
            font-size: 25px;
            position: fixed;
            bottom: 0;
            padding: 10px 0;
        }
        button a {
            color: white;
            text-decoration: none;
        }
    </style>
     <!-- JavaScript validation and content load for insert data-->
        <script>
            function confirmInsert() {
                return confirm('Are you sure you want to insert this record?');
            }
        </script>
</head>
<body>
<header>
    <section>

        <form class="forms" role="search" action="search.php">
      <input  type="text" placeholder="Search" aria-label="Search"name="query">
      <button  type="submit">Search</button>
    </form>
     <body bgcolor="darkgray">
        <h1><u>expenses Form</u></h1>

        <form method="post" action="expenses.php" onsubmit="return confirmInsert();">
            <label for="ExpenseID">ExpenseID:</label>
            <input type="number" id="ExpenseID" name="ExpenseID"><br><br>

            <label for="BudgetID">BudgetID:</label>
            <input type="number" id="BudgetID" name="BudgetID"><br><br>

            <label for="Amount">Amount:</label>
            <input type="number" id="Amount" name="Amount" required><br><br>

            <label for="ExpenseDate">ExpenseDate:</label>
            <input type="date" id="ExpenseDate" name="ExpenseDate" required><br><br>
            <input type="submit" name="add" value="Insert">
        </form>

        <?php
        include('dbconnection.php'); // Include your database connection file

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Prepare and bind parameters for expenses insertion
            $stmt = $connection->prepare("INSERT INTO expenses (ExpenseID, BudgetID, Amount, ExpenseDate) VALUES (?, ?, ?, ?)");
            $stmt->bind_param("iiss", $ExpenseID, $BudgetID, $Amount, $ExpenseDate);

            // Set parameters from form data
            $ExpenseID = $_POST['ExpenseID'];
            $BudgetID = $_POST['BudgetID'];
            $Amount = $_POST['Amount'];
            $ExpenseDate = $_POST['ExpenseDate'];

            // Execute the statement
            if ($stmt->execute() === TRUE) {
                echo "New record has been added successfully";
            } else {
                echo "Error: " . $stmt->error;
            }

            // Close the statement
            $stmt->close();
        }

        $sql = "SELECT * FROM expenses";
        $result = $connection->query($sql);
        ?>

        <h2>Table of expenses</h2>
        <table>
            <tr>
                <th>ExpenseID</th>
                <th>BudgetID</th>
                <th>Amount</th>
                <th>ExpenseDate</th>
                <th>Delete</th>
                <th>Update</th>
            </tr>
            <?php
            // Output data from the expenses table
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    $ExpenseID = $row['ExpenseID'];
                    echo "<tr>
                            <td>" . $row['ExpenseID'] . "</td>
                            <td>" . $row['BudgetID'] . "</td>
                            <td>" . $row['Amount'] . "</td>
                            <td>" . $row['ExpenseDate'] . "</td>
                            <td><a href='delete_expenses.php?ExpenseID=$ExpenseID'>Delete</a></td>
                            <td><a href='update_expenses.php?ExpenseID=$ExpenseID'>Update</a></td>
                        </tr>";
                }
            } else {
                echo "<tr><td colspan='6'>No data found</td></tr>";
            }
            // Close the database connection
            $connection->close();
            ?>
        </table>
        <center><button><a href="home.html">Back Home</a></button></center>
    </section>
</header>

<b>UR CBE BIT &copy; 2024 &reg;, Designed by: @Ndatimana Gentille</b>


</body>
</html>
